<?php
    include_once("header.php");
    include_once("../lib/c_supplier.php");

        if(isset($_GET["sup_id"])){
            $sup_id= $_GET["sup_id"];
            $sup =new supplier();
            $s = $sup->get_sup_byid($sup_id);
        }
?>   
<!DOCTYPE html>
<html>
    <head>
        <title></title>
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
    </head>
    <body>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h1>Update Supplier Details<small></small></h1>
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
                        <form method="POST" action="#" id="cfrm" class="form-horizontal" data-toggle="validator">
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Supplier ID:</label>
                                <div class="col-sm-10"><input type="text" name="sup_id" id="sup_id" class="form-control" readonly="" value='<?= $s["sup_id"]?>'></div>
                            </div>
                                
                            <div class="form-group"><label class="col-sm-2 control-label">Supplier Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="s_n" id="s_n" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid Name" pattern="^([a-zA-Z ]{2,15})$" required value="<?= $s["sup_name"]?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Company Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="c_n" id="c_n" class="form-control"data-bv-regexp="true" data-bv-regexp-message="Please enter a valid Name"  pattern="^([a-zA-Z ]{2,15})$" required value="<?= $s["comp_name"]?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Company Address:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="c_addr" id="c_addr" class="form-control" required value="<?= $s["comp_addr"]?>"/>
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Contact Number:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="con" id="con" class="form-control"data-bv-regexp="true" data-bv-regexp-message="Please enter a valid Name" pattern="^([0-9]{10}|[0-9\+\s\-]{12,13})$" required value="<?= $s["contact"]?>"/>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                                
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input type="button" class="btn btn-primary" id="btnupdate" value="Update">
                                    <input type="button" class="btn btn-danger btn-xl" id="btncancel" value="Cancel">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function(){
        $("#btncancel").click(function(){
            window.location.href = "sup_mng.php";
        });
        $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
        $('#cfrm').data('bootstrapValidator').resetForm();
        $("#btnupdate").click(function(){//when the save button clicked the form data captured to following js variables
            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
                if ($('#cfrm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
                    $('#cfrm').bootstrapValidator('validate');//validate again for the confirmation

                    var supid = $("#sup_id").val();
                    var sname = $("#s_n").val();
                    var cname = $("#c_n").val();
                    var caddr = $("#c_addr").val();
                    var contact = $("#con").val();
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
                                url:"../handeler/sup_ctrl.php?type=update_supplier",
                                data:new FormData($("#cfrm")[0]),
                                processData:false,
                                contentType:false,
                                complete: function(data){
                                    if(data.responseText =="Done"){
                                        setTimeout(function() {
                                            swal({
                                                title:'Done!',
                                                text: 'Supplier Details Was Successfully Updated!',
                                                type: "success",
                                                allowOutsideClick: false,
                                                confirmButtonText: "OK"
                                                }, function() {
                                                    window.location.href ="sup_mng.php";
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
    });
</script>
<?php
    include("footer.php");
?>