<?php
    include_once("header.php");
    include_once("../lib/c_customer.php");
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
                        },
                        fields:{
                            pass:{
                                validators:{
                                    identical:{
                                        field:'pass_confirmation',
                                        message:'Missmatching password'
                                    }
                                }
                            },
                            pass_confirmation:{
                                validators:{
                                    stringLength:{
                                        min:6,
                                        message:'Password should be more than 6 charactors'
                                    }
                                }
                            }
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
                        <h1>Customer Signup<small></small></h1>
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
                        <form method="POST" action="#"  name="cform" id="cfrm" class="form-horizontal" enctype="multipart/form-data" data-toggle="validator">
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">First Name:</label>
                                <div class="col-sm-10"><input type="text" name="fi_name" id="f_name" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid Name" pattern="^([a-zA-Z ]{2,15})$" required/></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Last Name:</label>
                                <div class="col-sm-10"><input type="text" name="la_name" id="l_name" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid Name" pattern="^([a-zA-Z ]{2,20})$" required/> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address:</label>
                                <div class="col-sm-10"><input type="text" name="adr" id="adr" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid address" pattern="[A-Za-z0-9'\.\-\s\,]$" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Contact Number:</label>
                                <div class="col-sm-10"><input type="text" name="con_n" id="con_n" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid contct no" pattern="^([0-9]{10}|[0-9\+\s\-]{12,13})$" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email:</label>
                                <div class="col-sm-10"><input type="text" name="mail" id="mail" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid email address" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password:</label>
                                <div class="col-sm-10"><input type="password" name="pass_confirmation" id="pass_confirmation" class="form-control"data-validation="length" data-validation-length="8-20" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Comfirm Password:</label>
                                <div class="col-sm-10"><input type="password" class="form-control" id="pass" name="pass" required>
                                </div>
                            </div>

                            <div class="form-group" style="display: none;">
                                <label class="col-sm-2 control-label">User Type:</label>
                                <div class="col-sm-10"><input type="text" class="form-control" id="ut" name="ut" value="1">
                                </div>
                            </div>
                            
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input type="button" class="btn btn-primary" id="btn_s" value="Signup">
                                    <input type="reset" class="btn btn-danger btn-xl" id="btn_r" value="Cancel">
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
                        url:"../handeler/cus.hndl.php?type=reg_cus",
                        data:new FormData($("#cfrm")[0]),
                        processData:false,
                        contentType:false,
                        complete: function(data){
                            if(data.responseText =="DoneDone"){
                                setTimeout(function() {
                                    swal({
                                        title:'Done!',
                                        text: 'Successfully Added!',
                                        type: "success",
                                        allowOutsideClick: false,
                                        confirmButtonText: "OK"
                                    }, function() {
                                        window.location.href ="Customer_mng.php";
                                    });
                                }, 2000);

                            }
                            else if(data.responseText='duplicate_email'){
                                swal(
                                    'Oops...',
                                    'Email Already Exists',
                                    'error'
                                    );
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
<?php
    include("footer.php");
?>