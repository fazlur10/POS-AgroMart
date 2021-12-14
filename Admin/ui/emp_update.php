<?php
    include_once("header.php");
    include_once("../lib/c_employee.php");

        if(isset($_GET["emp_id"])){
            $emp_id= $_GET["emp_id"];

            $emp =new employee();
            $e = $emp->get_emp_byid($emp_id);            
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
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                });
            });
        </script>
    </head>
    <body>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h1>Update Employee Details:<small></small></h1>
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
                                <label class="col-sm-2 control-label">employee ID:</label>
                                <div class="col-sm-10"><input type="text" name="e_id" id="e_id" class="form-control" disabled="" value='<?= $e["emp_id"]?>'>
                                </div>
                            </div>

                            <div class="form-group" id="div_r_cus">
                                <label class="col-lg-2 control-label">Employee Role:<div class="col-lg-2"></i></div></label>
                                <div class="col-lg-10">
                                    <select id="rol" name="rol" class="form-control" required value='<?= $e["role_id"]?>'>'
                                        <option>Select</option>
                                        <?php
                                        include_once("../lib/c_employee.php");
                                        $emp=new employee();
                                        $res=$emp->load_role();
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">employee name:</label>
                                <div class="col-sm-10"><input type="text" name="e_name" id="e_name" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid Name" pattern="^([a-zA-Z ]{2,15})$" required value='<?= $e["emp_name"]?>'/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address:</label>
                                <div class="col-sm-10"><input type="text" name="adr" id="adr" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid address" pattern="[A-Za-z0-9'\.\-\s\,]$" required value='<?= $e["addr"]?>'/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Contact Number:</label>
                                <div class="col-sm-10"><input type="text" name="con_n" id="con_n" class="form-control" data-bv-regexp="true" data-bv-regexp-message="Please enter a valid contct no" pattern="^([0-9]{10}|[0-9\+\s\-]{12,13})$" required value='<?= $e["cont"]?>'/>
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
    </body>
</html>
<script>
    $(document).ready(function(){
        $("#btncancel").click(function(){
            window.location.href = "emp_mng.php";
        });
        $("#rol").each(function(){ $(this).find('option[value="'+$(this).attr("value")+'"]').prop('selected', true); });

    $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
    $('#cfrm').data('bootstrapValidator').resetForm();
    $("#btnupdate").click(function(){//when the save button clicked the form data captured to following js variables
        $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
            if ($('#cfrm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
                $('#cfrm').bootstrapValidator('validate');//validate again for the confirmation
                    var eid = $("#e_id").val();
                    var role_id=$("#rol").val();
                    var ename = $("#e_name").val();
                    var add = $("#adr").val();
                    var con =$("#con_n").val();
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
                            url:"../handeler/emp_ctrl.php?type=update_emp",
                            data:new FormData($("#cfrm")[0]),
                            processData:false,
                            contentType:false,
                            complete: function(data){
                                if(data.responseText =="Done"){
                                    setTimeout(function() {
                                        swal({
                                            title:'Done!',
                                            text: 'Employee Details Was Successfully Updated!',
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: "OK"
                                        }, function() {
                                            window.location.href ="emp_mng.php";
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