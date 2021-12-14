    <?php
    include_once("header.php");
    include_once("../lib/c_order.php");
	include_once("../lib/c_customer.php");

    if(isset($_GET["c_id"])){
        $cus_id= $_GET["c_id"];


        $or =new order();
        $c = $or->get_dept_byid($cus_id);
		
    }
    ?>
    <script>
        /*$(document).ready(function(){
            $('#cfrm').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons:{
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            }
        });
        });*/
    </script>
    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
    </head>
    <body>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h1>Update Dept Details<small></small></h1>
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
                        <form name="cform" id="cfrm" class="form-horizontal"  action="../lib/c_dept.php" method="POST">
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Customer ID:</label>
                                <div class="col-sm-10"><input type="text" name="cus_id" id="cus_id" class="form-control" readonly="" value='<?= $c["cus_id"]?>'></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">First Name:</label>
                                <div class="col-sm-10"><input type="text" name="f_name" id="f_name" class="form-control" readonly="" required value="<?= $c["f_name"]?>"></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Last Name:</label>
                                <div class="col-sm-10"><input type="text" name="l_name" id="l_name" class="form-control" readonly="" required value="<?= $c["l_name"]?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Net amount:</label>
                                <div class="col-sm-10"><input type="number" step="0.01" name="ntamt" id="ntamt" class="form-control" readonly=""   value="<?= $c["SUM(tbl_payment.ntot)"]?>" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Balance:</label>
                                <div class="col-sm-10"><input type="number" step="0.01"  name="bal" id="bal" class="form-control" readonly="" value="<?= $c["SUM(tbl_payment.bal)"]?>" required/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Pay Balance:</label>
                                <div class="col-sm-10"><input type="number" step="0.01" name="pay_bal" id="pay_bal" class="form-control"   required/>
                                </div>
                            </div>
                            
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input type="submit" class="btn btn-primary" id="btnupdate" value="Pay Balance">
                                    <input type="reset" class="btn btn-danger btn-xl" id="btncancel" value="Cancel">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> BIT Project &copy; 2017-2018
            </div>
        </div>
    </body>
    </html>
    <script>
    /*
		 $(document).ready(function(){
            $("#btncancel").click(function(){
                window.location.href = "dept_details.php";
            });
            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
            $('#cfrm').data('bootstrapValidator').resetForm();
            $("#btnupdate").click(function(){//when the save button clicked the form data captured to following js variables
                $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
                if ($('#cfrm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
                    $('#cfrm').bootstrapValidator('validate');//validate again for the confirmation

                    var cusid = $("#cus_id").val();
                    var paybal = $("#pay_bal").val();
                    
                    var url = "../handeler/cus_ctrl.php?type=update_dept"; //location of the loading page

                    $.post(url, {cus_id:cusid, pay_bal:paybal}, function(data){
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
                            url:"../handeler/cus_ctrl.php?type=update_dept",
                            data:new FormData($("#cfrm")[0]),
                            processData:false,
                            contentType:false,
                            complete: function(data){
                                if(data.responseText =="Done"){
                                    setTimeout(function() {
                                        swal({
                                            title:'Done!',
                                            text: 'Dept Details Was Successfully Updated!',
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: "OK"
                                        }, function() {
                                            window.location.href ="dept_details.php";
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
                    });
                }
            });
        }); */
    </script>
    <?php
    include("footer.php");
    ?>