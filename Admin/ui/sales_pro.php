<?php
	include_once("header.php");
	$dtm=date('Y-m-d / h:i:s a');
		
		if(!empty($_POST['pro'])){
	        $pro=$_POST['pro'];
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

                            <form method="POST" action="sales_by_pro.php" id="Search" class="form-horizontal">
                                <div class="form-horizontal">
                                    <label class="col-lg-2 control-label">Customer:</label>
                                    <div class="col-lg-4">
                                            <select  id="pro" name="pro" class="form-control">
                                                <option>Select Product</option>
                                                <?php
                                                    include_once("../lib/c_add_product.php");
                                                    $pro=new product();
                                                    $res=$pro->load_mno();
                                                ?>
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
                                            <th>Customer Order Number</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Product</th>
                                            <th>QTY</th>
                                            <th>Order Date</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include_once("../lib/c_reports.php");
                                                $re=new report;
                                                    $c1=$re->sales_pro($pro);
                                                        if(!empty($c1)){
                                                            foreach ($c1 as $item){
                                                                echo("<tr>
                                                                        <td>$item->cus_ord_no</td>
                                                                        <td>$item->f_name</td>
                                                                        <td>$item->l_name</td>
                                                                        <td>$item->model_number</td>
                                                                        <td>$item->itm_qty</td>
                                                                        <td>$item->ordate</td>
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
