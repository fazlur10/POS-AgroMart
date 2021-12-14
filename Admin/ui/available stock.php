<?php
    include("header.php");
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
                            <h5>Available stock</h5>
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
                                            <th>Product ID</th>
                                            <th>Product</th>
                                            <th>Total QTY</th>
                                            <th>Re Order QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include("../lib/c_grn.php");
                                                $gr=new grn;
                                                $c1=$gr->view_stock();
                                                    if(!empty($c1)){
                                                        foreach ($c1 as $item){
                                                            echo("<tr id='tr_$item->p_id'>
                                                                      <td>$item->p_id</td>
                                                                      <td>$item->model_number</td>
                                                                      <td>$item->tot_qty</td>
                                                                      <td>$item->re_ord_qty</td>
                                                                        <script>
                                                                            $(document).ready(function () {
                                                                                var idm = '$item->p_id';
                                                                                var quantity = '$item->tot_qty';
                                                                                var qty = parseInt(quantity);
                                                                                var reorder_qty = '$item->re_ord_qty';
                                                                                var reqty = parseInt(reorder_qty);
                                                                                    if(qty <= reqty){
                                                                                       $(\"#tr_\"+idm).css(\"background-color\", \"#FF6666\");  
                                                                                    }
                                                                                    else if(quantity == 'Out of Stock'){
                                                                                        $(\"#tr_\"+idm).css(\"background-color\", \"#FF6666\");
                                                                                    }
                                                                            });
                                                                        </script>
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

