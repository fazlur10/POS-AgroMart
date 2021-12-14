<?php
	include("header.php");
	include_once("../lib/c_return.php");

		if(isset($_GET["return_id"])) {
    		$return_id=$_GET["return_id"];

    		$re= new return_itm();
    		$p = $re->get_info_return_back($return_id);
		}
?>
<script>
    $(document).ready(function(){
        $('#cfrm').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
        });
    });
</script>

<!DOCTYPE html>
<html>
    <head>
    <title></title>
    </head>
    <body>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h1>Return To Stock</h1>
                                <div class="ibox-tools">
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form action="#" method="POST" name="cform" id="cfrm" data-toggle="validator" autocomplete="on">
                                    <div class="row">
                                        <div class="form-group col-md-4" style="display:none;">
                                            <label class="col-lg-6 control-label">ono:</label>
                                                <div class="col-lg-6"><input type="text"  id="onu" name="onu" value='<?= $p["cus_ord_no"]?>' required/>
                                                </div>
                                        </div>

                                        <div class="form-group col-md-4" style="display:none;">
                                            <label class="col-lg-6 control-label">product id:</label>
                                                <div class="col-lg-6"><input type="text"  id="p_id" name="p_id" value='<?= $p["p_id"]?>' required/>
                                                </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-lg-4 control-label">product:</label>
                                                <div class="col-lg-6"><input type="text"  id="pro" name="pro"
                                                    value='<?= $p["model_number"]?>' placeholder="" class="form-control" required/>
                                                </div>
                                        </div>

                                        <div class="form-group col-md-3" style="display:none;">
                                            <label class="col-lg-4 control-label">qty:</label>
                                                <div class="col-lg-6"><input type="text" id="qty" name="qty" value="1" placeholder="" class="form-control" required/>
                                                </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="col-lg-4 control-label">Selling Price:</label>
                                                <div class="col-lg-6"><input type="text"  id="sp" name="sp"  placeholder="" class="form-control" required/>
                                                </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <input type="button" class="btn btn-primary" id="btnupdate" value="return Back">
                                    <input type="reset" class="btn btn-danger btn-xl" id="btncancel" value="Cancel">
                                </form>
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
        $("#btncancel").click(function(){
            window.location.href = "return_history.php";
        });
            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
            $('#cfrm').data('bootstrapValidator').resetForm();
            $("#btnupdate").click(function(){//when the save button clicked the form data captured to following js variables
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
                            url:"../handeler/return_hndl.php?type=return_up",
                            data:new FormData($("#cfrm")[0]),
                            processData:false,
                            contentType:false,
                            complete: function(data){
                                if(data.responseText =="Done"){
                                    setTimeout(function() {
                                        swal({
                                            title:'Done!',
                                            text: 'The item Was Successfully Added To Stock!',
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: "OK"
                                        }, function() {
                                            window.location.href ="return_history.php";
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