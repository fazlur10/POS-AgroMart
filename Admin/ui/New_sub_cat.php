<?php
    include_once("header.php");
    include_once("../lib/c_sub_cat.php");

        $sc=new scat();
        $res=$sc->new_sid();
?>
<script>
    $(document).ready(function(){
        $('#cfrm').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons:{
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            }
        });
    });
</script>
<script type="text/javascript">  
    $(document).ready(function(){
        $.post('../handeler/load_hndl.php',{'txtActMode':'load_drop'},function(data){
            var def='<option>--Select here--</option>';
            var rows = '';
            $("#cate").html('');
            $("#cate").append(def);
                for (var i = 0; i < data.length; i++){
                    var catId = data[i].cat_id;
                    var catName = data[i].cat;
                    rows = '<option value="'+catId+'">'+catName+'</option>';
                    $("#cate").append(rows); 
                }   
        },'Json');
    });
</script>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div class="form-action" align="right">
            <a href="Add product.php"><input type="button" class="btn btn-success" value="Add Product"></a>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h1>New Sub Category</h1>
                                <div class="ibox-tools">
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="#" id="cfrm" name="frm" class="form-horizontal" data-toggle="validator">
                                    <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                    
                                    <div class="form-group" style="display: none;">
                                        <label class="col-lg-2 control-label">Sub Category ID</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="s_c_id" disabled="" class="form-control" value="<?php echo($res); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Select Category</label>
                                        <div class="col-sm-10">
                                            <select id="cate" class="form-control" name="cata">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Sub Category</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="s_c" placeholder="Sub Category" class="form-control" required">
                                        </div>
                                    </div>

                                    <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                    <div class="form-action" align="right">
                                    <br><br>
                                    <input type="button" class="btn btn-primary" id="btn_s" value="Add">
                                    <input type="button" class="btn btn-danger btn-xl" id="btn_r" value="Cancel">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Registered Customers List-->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Sub Category list</h5>
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
                                            <th>Sub Category ID</th>
                                            <th>Sub Category</th>
                                            <th>Category</th>
                                            <th>State</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include_once("../lib/c_sub_cat.php");
                                                $sc=new scat;
                                                $c1=$sc->view_subcat();
                                                    if(!empty($c1)){
                                                        foreach($c1 as $item){
                                                            echo("<tr id='tr_$item->sub_cat_id'>
                                                                <td>$item->sub_cat_id</td>
                                                                <td>$item->sub_cat</td>
                                                                <td>$item->cat</td>
                                                                <td>$item->state</td>
                                                                <td>
                                                                <span class='glyphicon glyphicon-edit text-primary' id=\"btnEdit$item->sub_cat_id\" onclick='edit(\"$item->sub_cat_id\")'>
                                                                </span>

                                                                <span class='glyphicon glyphicon-trash text-danger' title='Delete' onclick='del(\"$item->sub_cat_id\")'>
                                                                </span>

                                                                <span class='glyphicon glyphicon-check text-success' onclick='act(\"$item->sub_cat_id\")'>
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
    $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
    $('#cfrm').data('bootstrapValidator').resetForm();
        $("#btn_s").click(function(){
            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
                if ($('#cfrm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
                    $('#cfrm').bootstrapValidator('validate');//validate again for the confirmation
                        swal({
                            title: 'Please wait...',
                            width: 500,
                            padding: 100,
                            onOpen: function () {
                                swal.showLoading();
                            }
                        });
                        $.ajax({
                            type:"POST",
                            url:"../handeler/sub_cat.hndl.php",
                            data:new FormData($("#cfrm")[0]),
                            processData:false,
                            contentType:false,
                            complete: function(data){
                                if(data.responseText == "DoneDone"){
                                    setTimeout(function() {
                                        swal({
                                            title:'Done!',
                                            text: 'Successfully Added!',
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: "OK"
                                        }, function() {
                                            window.location.href ="New_sub_cat.php";
                                        });
                                    }, 2000);

                                }
                                else {
                                    swal(
                                        'Oops...',
                                        'Something went wrong!',
                                        'error'
                                        );
                                }
                            }
                        });
                }
        });
        $("#btn_r").click(function(){
            $('#cfrm').data('bootstrapValidator').resetForm();
        });
    });
</script>
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
</script>

<script >
    function edit(sub_cat_id) {
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Edit This Customer Information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#CCCC00",
            confirmButtonText: "Yes, Edit it!",
            closeOnConfirm: false
        }, function () {
            window.location.href="update_sub_cat.php?sub_cat_id="+sub_cat_id;
        });
    }

    function del(sub_cat_id){
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Dactivate This Sub Category!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Dactivate it!",
            closeOnConfirm: false
        },function () {
            window.location.href="../handeler/sub_cat_ctrl.php?type=deactive_Scat&sub_cat_id="+sub_cat_id;
        });
    }

    function act(sub_cat_id){
        swal({
            title: "Are you sure?",
            text: "Do You Really Want To Activate This Sub Category!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#00FA9A",
            confirmButtonText: "Yes, Activate it!",
            closeOnConfirm: false
        },function () {
            window.location.href="../handeler/sub_cat_ctrl.php?type=Active_Scat&sub_cat_id="+sub_cat_id;;
        });
        
    }
</script>
<?php 
    include("footer.php");
?>