<?php
    include("header.php");
    include_once("../lib/c_reports.php");
        $dtm=date('Y-m-d / h:i:s a');

        if(!empty($_POST['start_date']) && !empty($_POST['end_date'])){
        $sdate = $_POST['start_date'];
        $edate = $_POST['end_date'];
        }
        else{
            $sdate = date('Y-m-01' );
            $edate = date('Y-m-t' );
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <!--Available stock-->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Returnes By Date</h5>
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

                            <form method="POST" action="#" id="Search" class="form-horizontal">
                                <div class="form-horizontal">
                                    <label class="col-lg-2 control-label">Start Date:</label>
                                    <div class="col-lg-4"><input type="Date" name="start_date" id="start_date" class="form-control">
                                    </div>
                                </div>

                                <div class="form-horizontal">
                                    <label class="col-lg-2 control-label">End Date:</label>
                                    <div class="col-lg-4"><input type="Date" name="end_date" id="end_date"  class="form-control">
                                    </div>
                                </div>

                                <div align="left">
                                    <input type="submit" class="btn btn-primary" id="btnformsearch" value="Search">
                                </div>
                                <div class="row">
                                    <div align="left" style="margin-left: 25px;"><h3><b><?="Date Range : "."$sdate"." - "."$edate"; ?></b></h3></div><br>
                                </div>
                            </form>
                                                
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Return ID</th>
                                            <th>Item</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include_once("../lib/c_reports.php");
                                                $re=new report;
                                                    $c1=$re->return_by_date($sdate, $edate);
                                                        if(!empty($c1)){
                                                            foreach ($c1 as $item){
                                                                echo("<tr>
                                                                        <td>$item->return_id</td>
                                                                        <td>$item->model_number</td>
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
<script>
    $(document).ready(function(){
        var date = "<?= $dtm;?>";
        $('.dataTables-example').DataTable({//dataTables plugin
            "paging": true,
            "info": false,
            "sort": true,
            "responsive": true,
            "dom": 'Bfrtip',
            "order": [[0,"desc"]],
            "buttons": [
                {extend: 'pdf', title: 'Returnes By Date Report - '+date,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3]
                    }
                },
                {extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3]
                    },
                    text: 'Print',
                    title: ' ',
                    orientation:'Landscape',
                    messageTop:'<img src="img/Header.jpg" width="100%"><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Returnes By Date Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Bright Computer Systems &copy; </p> </div>'
                }
            ]
        });
    });
</script>
<?php
    include_once("footer.php");
?>