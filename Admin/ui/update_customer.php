    <?php
    include_once("header.php");
    include_once("../lib/c_customer.php");

    if(isset($_GET["cus_id"])){
        $cus_id= $_GET["cus_id"];


        $cus =new customer();
        $c = $cus->get_cus_byid($cus_id);
    }
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
                        <h1>Update Customer Details<small></small></h1>
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
                                <label class="col-sm-2 control-label">Customer ID:</label>
                                <div class="col-sm-10"><input type="text" name="cus_id" id="cus_id" class="form-control" readonly="" value='<?= $c["cus_id"]?>'></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">First Name:</label>
                                <div class="col-sm-10"><input type="text" name="f_name" id="f_name" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid Name" pattern="^([a-zA-Z ]{2,15})$" required value="<?= $c["f_name"]?>"></div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Last Name:</label>
                                <div class="col-sm-10"><input type="text" name="l_name" id="l_name" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid Name" pattern="^([a-zA-Z ]{2,20})$" required value="<?= $c["l_name"]?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address:</label>
                                <div class="col-sm-10"><input type="text" name="adr" id="adr" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid address" pattern="[A-Za-z0-9'\.\-\s\,]$" value="<?= $c["address"]?>" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Contact Number:</label>
                                <div class="col-sm-10"><input type="text" name="con_n" id="con_n" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid contct no" pattern="^([0-9]{10}|[0-9\+\s\-]{12,13})$" value="<?= $c["contact_no"]?>" required/>
                                </div>
                            </div>
                            
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input type="button" class="btn btn-primary" id="btnupdate" value="Update">
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
        $(document).ready(function(){
            $("#btncancel").click(function(){
                window.location.href = "Customer_mng.php";
            });
            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
            $('#cfrm').data('bootstrapValidator').resetForm();
            $("#btnupdate").click(function(){//when the save button clicked the form data captured to following js variables
                $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
                if ($('#cfrm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
                    $('#cfrm').bootstrapValidator('validate');//validate again for the confirmation

                    var cusid = $("#cus_id").val();
                    var fname = $("#f_name").val();
                    var lname = $("#l_name").val();
                    var url = "../handeler/cus_ctrl.php?type=update_customer"; //location of the loading page

                    $.post(url, {cus_id:cusid, f_name:fname, l_name:lname}, function(data){
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
                            url:"../handeler/cus_ctrl.php?type=update_customer",
                            data:new FormData($("#cfrm")[0]),
                            processData:false,
                            contentType:false,
                            complete: function(data){
                                if(data.responseText =="Done"){
                                    setTimeout(function() {
                                        swal({
                                            title:'Done!',
                                            text: 'Customer Details Was Successfully Updated!',
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: "OK"
                                        }, function() {
                                            window.location.href ="Customer_mng.php";
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
        });
    </script>
    <?php
    include("footer.php");
    ?>