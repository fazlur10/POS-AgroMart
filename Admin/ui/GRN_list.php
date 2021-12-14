<?php
    include_once("header.php");
?>
<!DOCTYPE html>
<html>
    <head>
    	<title></title>
    </head>
    <body>
        <div class="form-action" align="right">
            <a href="new_order.php"><input type="button" class="btn btn-success" value="New Sale"></a>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>GRN history</h5>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>GRN no</th>
                                            <th>Date</th>
                                            <th>Ref no</th>
                                            <th>Supplier</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Unit price</th>
                                            <th>Selling Price</th>>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            include("../lib/c_grn.php");
                                                $gr=new grn;
                                                $c1=$gr->view_grn();

                                                    if(!empty($c1)){
                                                        foreach ($c1 as $item) {
                                                            echo("<tr id='tr_$item->grn_no'>
                                                                <td>$item->grn_no</td>
                                                                <td>$item->grn_date</td>
                                                                <td>$item->ref_no</td>
                                                                <td>$item->sup_name</td>
                                                                <td>$item->model_number</td>
                                                                <td>$item->qty</td>
                                                                <td>$item->unit_pri</td>
                                                                <td>$item->sel_pri</td>
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
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons:[
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'ExampleFile'},
            {extend: 'pdf', title: 'ExampleFile'},
            {extend: 'print',
                customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');
                    $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
                }
            }
            ]
        });
    });
</script>