<?php
    include("header.php");
    include_once("../lib/c_charts.php");
    $ch =new charts();
    $year = date('Y');
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div class="wrapper wrapper-content" align="center">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Today</span>
                            <h5>Sales</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">Rs: <?php echo $ch->income_today_tot();  ?></h1>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">Monthly</span>
                            <h5>Sales</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">Rs: <?php echo $ch->income_month_tot(); ?></h1>
                            <div class="stat-percent font-bold text-info"></div>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-6">
                    <div class="tile">
                        <div class="row">
                            <h2 align="center">Yearly Orders</h2><br>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas class="embed-responsive-item" id="mycanvas1"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tile">
                        <div class="row">
                            <h2 align="center">Yearly Sales</h2><br>
                            <input type="text" class="form-control" name="cur_year" id="cur_year" value="<?php echo "$year"; ?>" style="display: none;">
                        </div>
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas class="embed-responsive-item" id="mycanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    include("footer.php");
?>
<script>
    $(document).ready(function () {
        var year = $("#cur_year").val();
        $.ajax({
            type: "POST",
            url: '../handeler/order_hndl.php?type=getMonthWiseSales',
            data: ({year: year}),
            dataType: "json",
            success: function(data) {
                console.log(data);
                var month = [];
                var income = [];

                for(var i in data) {
                    month.push(data[i].month_name);
                    income.push(data[i].Balance);
                }

                var chartdata = {
                    labels: month,
                    datasets : [{
                        label: month,
                        backgroundColor: 'rgba(200, 200, 200)',
                        borderColor: 'rgba(200, 200, 200)',
                        data: income,
                        backgroundColor: [
                            'rgba(255, 99, 132)',
                            'rgba(54, 162, 235)',
                            'rgba(255, 206, 86)',
                            'rgba(75, 192, 192)',
                            'rgba(153, 102, 255)',
                            'rgba(143, 102, 255)',
                            'rgba(153, 122, 255)',
                            'rgba(153, 12, 255)',
                            'rgba(153, 182, 255)',
                            'rgba(153, 122, 255)',
                            'rgba(153, 152, 255)',
                            'rgba(255, 159, 64)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(143, 102, 255, 1)',
                            'rgba(153, 122, 255, 1)',
                            'rgba(153, 12, 255, 1)',
                            'rgba(153, 182, 255, 1)',
                            'rgba(153, 122, 255, 1)',
                            'rgba(153, 152, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                };

                var ctx = $("#mycanvas");

                var barGraph = new Chart(ctx, {
                    type: 'bar',
                    data: chartdata,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    stepSize: 1000000
                                }
                            }]
                        }
                    }
                });
            },
            error: function(data) {
                console.log(data);
            }
        });

        $.ajax({
            type: "POST",
            url: '../handeler/order_hndl.php?type=getMonthWiseOrders',
            data: ({year: year}),
            dataType: "json",
            success: function(data) {
                console.log(data);
                var month = [];
                var orders = [];

                for(var i in data) {
                    month.push(data[i].month_name);
                    orders.push(data[i].No_of_orders);
                }

                var chartdata = {
                    labels: month,
                    datasets : [{
                        label: "No of Orders",
                        backgroundColor: 'rgba(200, 200, 200)',
                        borderColor: 'rgba(200, 200, 200)',
                        data: orders,
                        backgroundColor: [
                            'rgba(255, 99, 132)',
                            'rgba(54, 162, 235)',
                            'rgba(255, 206, 86)',
                            'rgba(75, 192, 192)',
                            'rgba(153, 102, 255)',
                            'rgba(143, 102, 255)',
                            'rgba(153, 122, 255)',
                            'rgba(153, 12, 255)',
                            'rgba(153, 182, 255)',
                            'rgba(153, 122, 255)',
                            'rgba(153, 152, 255)',
                            'rgba(255, 159, 64)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(143, 102, 255, 1)',
                            'rgba(153, 122, 255, 1)',
                            'rgba(153, 12, 255, 1)',
                            'rgba(153, 182, 255, 1)',
                            'rgba(153, 122, 255, 1)',
                            'rgba(153, 152, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                };

                var ctx = $("#mycanvas1");

                var pieGraph = new Chart(ctx, {
                    type: 'pie',
                    data: chartdata,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    stepSize: 40
                                }
                            }]
                        }
                    }
                });
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>

