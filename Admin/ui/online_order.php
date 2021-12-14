<?php
    include_once("header.php");
    $dtm=date('Y-m-d / h:i:s a');
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <!--Online Orders List-->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h1>Online Orders</h1>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a></li>
                                    <li><a href="#">Config option 2</a></li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="onlineOrdTbl">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Grand Total</th>
                                        <th>Discount</th>
                                        <th>Net Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include_once("../lib/c_order.php");
                                    $or=new order();
                                    $c1=$or->online_orders();
                                    if(!empty($c1)){
                                        foreach ($c1 as $item) {
                                            echo("<tr>
                                                    <td>$item->cus_ord_no</td>
                                                    <td>$item->ordate</td>
                                                    <td>$item->f_name</td>
                                                    <td>$item->l_name</td>
                                                    <td>$item->gtot</td>
                                                    <td>$item->dis</td>
                                                    <td>$item->ntot</td>
                                                </tr>");
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
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
    $(document).ready(function(){
        var date = "<?= $dtm;?>";
        $('#onlineOrdTbl').DataTable({//dataTables plugin
            "paging": true,
            "info": false,
            "sort": true,
            "responsive": true,
            "dom": 'Bfrtip',
            "order": [[0,"desc"]],
            "buttons":[
                {extend: 'pdf', title: 'Online Order Report - '+date,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    text: 'Print',
                    title: ' ',
                    orientation:'Landscape',
                    messageTop:'<img src="img/Header.jpg" width="100%"><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Online Order Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Bright Computer Systems &copy; </p> </div>'
                }
            ]
        });
    });
</script>
