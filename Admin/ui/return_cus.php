<?php
	include_once("header.php");
	$dtm=date('Y-m-d / h:i:s a');
		
		if(!empty($_POST['cus'])){
	        $cus=$_POST['cus'];
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

                            <form method="POST" action="Returned_by_cus.php" id="Search" class="form-horizontal">
                                <div class="form-horizontal">
                                    <label class="col-lg-2 control-label">Customer:</label>
                                    <div class="col-lg-4">
                                                <select id="cus" name="cus" class="form-control" required>
                                                    <?php
                                                        include_once("../lib/c_order.php");
                                                            $or=new order();
                                                            $res=$or->load_cus();
                                                    ?>
                                                </select>
                                            </select>
                                    </div>
                                </div>

                                <div align="left">
                                    <input type="submit" class="btn btn-primary" id="btnformsearch" value="Search">
                                </div>
                            </form>
                                                
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Return ID</th>
                                            <th>Order Number</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Order Date</th>
                                            <th>Order Type</th>
                                            <th>Return Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include_once("../lib/c_reports.php");
                                                $re=new report;
                                                    $c1=$re->return_cus();
                                                        if(!empty($c1)){
                                                            foreach ($c1 as $item){
                                                                echo("<tr>
                                                                        <td>$item->return_id</td>
                                                                        <td>$item->cus_ord_no</td>
                                                                        <td>$item->f_name</td>
                                                                        <td>$item->l_name</td>
                                                                        <td>$item->ordate</td>
                                                                        <td>$item->order_type</td>
                                                                        <td>$item->r_date</td>
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
                        columns: [ 0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6]
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
