<?php
    include_once("header.php");
?>
<!DOCTYPE html>
<html>
    <head>
    	<title></title>
    </head>
    <body>
        <!--Registered Customers List-->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Return history</h5>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Return No</th>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Remark</th>
                                            <th>Reason</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php 
                                            include("../lib/c_return.php");
                                                $re=new return_itm();
                                                $c1=$re->view_return();
                                                    if(!empty($c1)){
                                                        foreach ($c1 as $item){
                                                            echo("<tr id='tr_$item->return_id'>
                                                                    <td>$item->return_id</td>
                                                                    <td>$item->model_number</td>
                                                                    <td>$item->r_date</td>
                                                                    <td>$item->remark</td>
                                                                    <td>$item->reason</td>
                                                                    <td>
                                                                        <span class='btn btn-sm btn-success' onclick='add(\"$item->return_id\")'>Add Item Into Stock</span>
                                                                    </td>
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
    include_once("footer.php");
?>
<script>
    $(document).ready(function(){
    
    });
        function add(return_id) {
            swal({
                title: "",
                text: "Would You Like This Product Add into Stock!",
                showCancelButton: true,
                confirmButtonColor: "#08AAF6",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            },function () {
                window.location.href="return_stock.php?return_id="+return_id;
            });
        }
</script>