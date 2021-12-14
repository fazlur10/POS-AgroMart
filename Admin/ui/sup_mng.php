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
                <a href="GRN.php"><input type="button" class="btn btn-success" value="GRN"></a>
                <a href="Purchese_ord.php"><input type="button" class="btn btn-success" value="Purchese Order"></a>
            </div>
    	<!--Registered Customers List-->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h1>Registered Suppliers</h1>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
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
                                            <th>Supplier ID</th>
                                            <th>Supplier name</th>
                                            <th>Company name</th>
                                            <th>company Address</th>
                                            <th>contact number</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include("../lib/c_supplier.php");
                                                $sup=new supplier;
                                                $c2=$sup->view_sup();

                                                    if(!empty($c2)){
                                                        foreach ($c2 as $item)
                                                        {
                                                            echo("<tr id='tr_$item->sup_id'>
                                                                <td>$item->sup_id</td>
                                                                <td>$item->sup_name</td>
                                                                <td>$item->comp_name</td>
                                                                <td>$item->comp_addr</td>
                                                                <td>$item->contact</td>
                                                                <td>$item->email</td>
                                                                <td>$item->user_status</td>
                                                                <td>
                                                                <span class='glyphicon glyphicon-edit text-primary' onclick='edit(\"$item->sup_id\")'></span>
                                                                <span class='glyphicon glyphicon-trash text-danger' onclick='del(\"$item->sup_id\")'></span>
                                                                <span class='glyphicon glyphicon-check text-success' onclick='act(\"$item->sup_id\")'></span>
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
    function edit(sup_id) {
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Edit This Supplier Information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#CCCC00",
            confirmButtonText: "Yes, Edit it!",
            closeOnConfirm: false
        }, function (){
            window.location.href="sup_update.php?sup_id="+sup_id;
        });
    }

    function del(sup_id){
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Dactivate This Supplier!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Dactivate it!",
            closeOnConfirm: false
        },function () {
            window.location.href="../handeler/sup_ctrl.php?type=deactive_sup&sup_id="+sup_id;
        });
    }

    function act(sup_id){
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Activate This Supplier!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#00FA9A",
            confirmButtonText: "Yes, Activate it!",
            closeOnConfirm: false
        }, function () {
            window.location.href="../handeler/sup_ctrl.php?type=Active_sup&sup_id="+sup_id;
        });  
    }
</script>
<?php
    include_once("footer.php");
?>