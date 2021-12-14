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
        <!--Registered Customers List-->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h1>Registered Customers</h1>
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
                                            <th>Customer ID</th>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Contact number</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        <?php 
                                            include_once("../lib/c_customer.php");
                                                $cus=new customer;
                                                $c1=$cus->view_cus();
                                                    if(!empty($c1)){
                                                        foreach ($c1 as $item) {
                                                            echo("<tr id='tr_$item->cus_id'>
                                                                <td>$item->cus_id</td>
                                                                <td>$item->first_name</td>
                                                                <td>$item->last_name</td>
                                                                <td>$item->email</td>
                                                                <td>$item->address</td>
                                                                <td>$item->contact_no</td>
                                                                <td>$item->user_status</td>
                                                                <td>
                                                                <span class='glyphicon glyphicon-edit text-primary' id=\"btnEdit$item->cus_id\" onclick='edit(\"$item->cus_id\")'>
                                                                </span>

                                                                <span class='glyphicon glyphicon-trash text-danger' title='Delete' onclick='del(\"$item->cus_id\")'>
                                                                </span>

                                                                <span class='glyphicon glyphicon-check text-success' onclick='act(\"$item->cus_id\")'>
                                                                </span>
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

    function edit(cus_id) {
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Edit This Customer Information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#CCCC00",
            confirmButtonText: "Yes, Edit it!",
            closeOnConfirm: false
        },function (){
            window.location.href="update_customer.php?cus_id="+cus_id;
        });
    }

    function del(cus_id){
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Dactivate This Customer!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Dactivate it!",
            closeOnConfirm: false
        },function (){
            window.location.href="../handeler/cus_ctrl.php?type=deactive_cus&cus_id="+cus_id;
          });
    }

    function act(cus_id){
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Activate This Customer!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#00FA9A",
            confirmButtonText: "Yes, Activate it!",
            closeOnConfirm: false
        },function () {
            window.location.href="../handeler/cus_ctrl.php?type=Active_cus&cus_id="+cus_id;
          });
    }
</script>

<?php
    include("footer.php");
?>