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
                        <h5>Current Purchese Orders</h5>
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
                                        <th>PO no</th>
                                        <th>Order Date</th>
                                        <th>Supplier</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include("../lib/c_purchese_ord.php");
                                    $po=new pur;
                                    $c1=$po->view_po();

                                    if(!empty($c1)){
                                        foreach ($c1 as $item) {
                                            echo("<tr id='tr_$item->po_no'>
                                                <td>$item->po_no</td>
                                                <td>$item->po_date</td>
                                                <td>$item->comp_name</td>
                                                <td>
                                                <span class='btn btn-sm btn-warning' onclick='edit(\"$item->po_no\")'>Update</span>
                                                <a class='btn btn-sm btn-success' onclick='grn(\"$item->po_no\")'>GRN</a>
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
    <div class="footer">
        <div>
            <strong>Copyright</strong> Example Company &copy; 2017-2018
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

    function edit(po_no) {
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Edit This purchase order Information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#CCCC00",
            confirmButtonText: "Yes, Edit it!",
            closeOnConfirm: false
        }, function () {
            window.location.href="purchese_ord_update.php?po_no="+po_no;
        });
    }

    function grn(po_no) {
        swal({
            title: "",
            text: "Would You Like to Access GRN Page!",
            showCancelButton: true,
            confirmButtonColor: "#08AAF6",
            confirmButtonText: "Yes",
            closeOnConfirm: false
        },function () {
            window.location.href="pur_grn.php?po_no="+po_no;
        });
    }
</script>