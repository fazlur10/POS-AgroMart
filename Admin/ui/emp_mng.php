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
                            <h1>Employee list</h1>
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
                                            <th>Employee ID</th>
                                            <th>employee name</th>
                                            <th>Designation</th>
                                            <th>Address</th>
                                            <th>Contact Number</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        <?php 
                                            include_once("../lib/c_employee.php");
                                                $emp=new employee;
                                                $c1=$emp->view_emp();

                                                    if(!empty($c1)){
                                                        foreach ($c1 as $item){
                                                            echo("<tr id='tr_$item->emp_id'>
                                                                    <td>$item->emp_id</td>
                                                                    <td>$item->emp_name</td>
                                                                    <td>$item->role_name</td>
                                                                    <td>$item->addr</td>
                                                                    <td>$item->cont</td>
                                                                    <td>$item->user_status</td>
                                                                    <td>
                                                                    <span class='glyphicon glyphicon-edit text-primary' onclick='edit(\"$item->emp_id\")'></span>
                                                                    <span class='glyphicon glyphicon-trash text-danger' onclick='del(\"$item->emp_id\")'></span>
                                                                    <span class='glyphicon glyphicon-check text-success' onclick='act(\"$item->emp_id\")'></span>
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
            buttons: [
            { extend: 'copy'},
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
    function edit(emp_id){
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Edit This Employee Information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#CCCC00",
            confirmButtonText: "Yes, Edit it!",
            closeOnConfirm: false
        }, function () {
            window.location.href="emp_update.php?emp_id="+emp_id;
           });
    }

    function del(emp_id){
        // res  = confirm("Are you sure want to Deactivate??");
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Dactivate This Employee!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Dactivate it!",
            closeOnConfirm: false
        }, function () {
            window.location.href="../handeler/emp_ctrl.php?type=deactive_emp&emp_id="+emp_id;
           });
    }

    function act(emp_id){
        // res  = confirm("Are you sure want to Deactivate??");
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Activate This Employee!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#00FA9A",
            confirmButtonText: "Yes, Activate it!",
            closeOnConfirm: false
        }, function () {
            window.location.href="../handeler/emp_ctrl.php?type=Active_emp&emp_id="+emp_id;
           });   
    }
</script>
<?php
    include_once("footer.php");
?>