<?php
    include_once("../lib/c_employee.php");
        session_start();
            if(isset($_SESSION['user']['emp'])){
                $emp=$_SESSION['user']['emp'];
                $role=$emp->role_name;
                $name=$emp->emp_name;
            }
            elseif(!isset($_SESSION['user']['emp'])){
                // not logged in
                header('Location: ../../index.php');
                exit();
            }
?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--make respnsive-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">

            <title>Admin</title>

            
            <!-- Sweet Alert Style -->
            <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
            <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
            <link href="js/plugins/DataTables/datatables.css" rel="stylesheet">
            <link href="css/animate.css" rel="stylesheet">
            <link href="css/style.css" rel="stylesheet">
            <link href="css/bootstrapValidator.css" rel="stylesheet">



            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

            <!-- Toastr style -->
            <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

            <!-- Gritter -->
            <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

            <link href="css/animate.css" rel="stylesheet">
            <link href="css/style.css" rel="stylesheet">

            <script src="js/jquery-3.1.1.min.js"></script>
            <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
            <script src="js/BootstrapValidator.js"></script>
            <!-- Steps -->
            <script src="js/plugins/steps/jquery.steps.min.js"></script>
            <!--Sweet Alert Plugin-->
            <script src="js/plugins/sweetalert/sweetalert.min.js"></script> 
            <script src="js/bootstrap.js"></script>
        </head>
        <body>
            <div id="wrapper">
                <nav class="navbar-default navbar-static-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul class="nav metismenu" id="side-menu">
                            <li class="nav-header">
                                <div class="dropdown profile-element"><span>
                                    <img alt="image" class="img-circle" src="img/admin.png"/></span>
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <span class="clear"> <span class="block m-t-xs"><strong class="font-bold"><?php echo "$name"; ?>
                                        </strong>
                                        </span> <span class="text-muted text-xs block"><?php echo "$role";?>
                                        <b class="caret"></b></span></span>
                                    </a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                        <li><a href="../../logout.php">Logout</a></li>
                                    </ul>
                                </div>
                                <div class="logo-element">
                                    IN+
                                </div>
                            </li>

                            <li>
                                <a href="Admin.php"><i class="fa fas fa-dashboard fa-2x"></i> <span class="nav-label">Dashboard</span></a>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-archive fa-2x"></i> <span class="nav-label">Stock</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li>
                                        <a href="#" id="damian">Product<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="Add product.php">Add Product</a>
                                            </li>
                                            <li>
                                                <a href="product_list.php">Manage Products</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <ul class="nav nav-second-level collapse">
                                    <li>
                                        <a href="#" id="damian">GRN<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="GRN.php">New GRN</a>
                                            </li>
                                            <li>
                                                <a href="GRN_list.php">View GRN</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <ul class="nav nav-second-level collapse">
                                    <li>
                                        <a href="#" id="damian">Purchese Order<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="Purchese_ord.php">New Purchese Order</a>
                                            </li>
                                            <li>
                                                <a href="view_Purchese_ord.php">History</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <ul class="nav nav-second-level collapse">
                                    <li>
                                        <a href="available stock.php">Available Stock</a>
                                    </li>
                                </ul>

                                <ul class="nav nav-second-level collapse">
                                    <li>
                                        <a href="#" id="damian">Return<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="return.php">Return Item</a>
                                            </li>
                                            <li>
                                                <a href="return_history.php">Return History</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-shopping-cart fa-2x"></i> <span class="nav-label">Sales</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="new_order.php">New Sale</a></li>
									
                                    <li><a href="walk-in_order.php">Walk-in Orders</a></li>
                                    <li><a href="online_order.php">Online Orders</a></li>
									<li><a href="dept_details.php">Dept Details</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-users fa-2x"></i> <span class="nav-label">Customer</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="Customer_reg.php">Add Customer</a></li>
                                    <li><a href="Customer_mng.php">Manage Customers</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-user-circle-o fa-2x"></i> <span class="nav-label">Supplier</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="sup_reg.php">Add Supplier</a></li>
                                    <li><a href="sup_mng.php">Manage Suppliers</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-user fa-2x"></i> <span class="nav-label">Employee</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="reg_emp.php">Add Employee</a></li>
                                    <li><a href="emp_mng.php">Manage Employees</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-file-text-o fa-2x"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level collapse">
                                        
                                        <li>
                                            <a href="#" id="damian">Sales<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="sales_by_date.php">Sales By Date</a>
                                                </li>
                                                <li>
                                                    <a href="sales_pro.php">Sales By product</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="#" id="damian">Purchese Orders<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="po_by_date.php">Purchese By Date</a>
                                                </li>
                                                <li>
                                                    <a href="po_pro.php">Purchese By product</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="#" id="damian">Stock<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="stock_report.php">Available Stock</a>
                                                </li>
                                                <li>
                                                    <a href="product_report.php">Product List</a>
                                                </li>
                                                <li>
                                                    <a href="product_report_by_cat.php">Products By Category</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" id="damian">Return <span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="Returned_by_date.php">By Date</a>
                                                </li>
                                                <li>
                                                    <a href="Returned_pro.php">By Product</a>
                                                </li>
                                                <li>
                                                    <a href="Return_cus.php">By Customers</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" id="damian">Customer<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="active_cus_list.php">Active Customers</a>
                                                </li>
                                                <li>
                                                    <a href="blocked_cus_list.php">Blocked Customers</a>
                                                </li>
                                                <li>
                                                    <a href="deleted_cus_list.php">Deleted Customers</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-wrench fa-2x"></i> <span class="nav-label">Configurations</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="New_role.php">New Employee Role</a></li>
                                    <li><a href="New_cat.php">New Category</a></li>
                                    <li><a href="New_sub_cat.php">New Sub Category</a></li>
                                    <li><a href="new_payment.php">New payment method</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div id="page-wrapper" class="gray-bg dashbard-1">
                    <div class="row border-bottom">
                        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                            <ul class="nav navbar-top-links navbar-right">
                                <li class="dropdown">
                                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                        <i class="fa fa-bell"></i>  <span class="label label-primary" id="notifyCount"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-alerts" id="notify" style="height: 300px; overflow-y: scroll;">
                                        <li style="margin-top: -10px; margin-bottom: -5px;">
                                            <div class='row'>
                                                <div class='col-md-9'>
                                                    <a><div class='name'></div>
                                                        <small class='location'></small></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="../../logout.php">
                                        <i class="fa fa-sign-out"></i> Log out
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <script>
                            $( document ).ready(function() {
                                var url = "../handeler/order_hndl.php?type=getNotifyCount"; //location of the loading page
                                $.post(url, function (data, status) {
                                    if(status=="success") {
                                        var jsonobj = JSON.parse(data);//capture data to json object
                                        $("#notifyCount").text(jsonobj.notify_count);
                                    }
                                });

                                var url = "../handeler/order_hndl.php?type=getNotifyDetails"; //location of the loading page
                                $.post(url, function (data, status) {
                                    $("#notify").find("li:gt(0)").remove();
                                    if(status=="success") {
                                        var jsonobj = JSON.parse(data);//capture data to json object
                                        $.each(jsonobj, function(key,value) {
                                            var ul = document.getElementById("notify");
                                            var li = document.createElement("li");
                                            li.setAttribute("class", "fa fa-envelope well");
                                            li.appendChild(document.createTextNode(" "+value.fname+" "+value.lname+"  has been placed a new order"));
                                            ul.appendChild(li);
                                        });
                                    }
                                });
                            });

                            ! function getCountAutomatically(){
                                getNotificationCount();
                                setTimeout(getCountAutomatically, 15000);
                            }();

                            ! function getNotificationsAutomatically(){
                                $("#notify").find("li:gt(0)").remove();
                                detailsNotification();
                                setTimeout(getNotificationsAutomatically, 15000);
                            }();

                            function detailsNotification() {
                                var url = "../handeler/order_hndl.php?type=getNotifyDetails"; //location of the loading page
                                $.post(url, function (data, status) {
                                    $("#notify").find("li:gt(0)").remove();
                                    if(status=="success") {
                                        var jsonobj = JSON.parse(data);//capture data to json object
                                        $.each(jsonobj, function(key,value) {
                                            var ul = document.getElementById("notify");
                                            var li = document.createElement("li");
                                            li.setAttribute("class", "fa fa-envelope well");
                                            li.appendChild(document.createTextNode(" "+value.fname+" "+value.lname+"  has been placed a new order"));
                                            ul.appendChild(li);
                                        });
                                    }
                                });
                            }

                            function getNotificationCount() {
                                var url = "../handeler/order_hndl.php?type=getNotifyCount"; //location of the loading page
                                $.post(url, function (data, status) {
                                    if(status=="success") {
                                        var jsonobj = JSON.parse(data);//capture data to json object
                                        $("#notifyCount").text(jsonobj.notify_count);
                                    }
                                });
                            }
                        </script>