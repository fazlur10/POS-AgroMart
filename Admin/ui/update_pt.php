    <?php
    include_once("header.php");
    include_once("../lib/c_add_payment.php");

    if(isset($_GET["p_m_id"])){
        $p_m_id= $_GET["p_m_id"];

        $apay=new apayment();
        $b = $apay->get_pt_byid($p_m_id);
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
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h1>Edit Payment Method</h1>
                                <div class="ibox-tools">
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="#" id="cfrm" class="form-horizontal" data-toggle="validator">
                                    <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                    
                                    <div class="form-group"><label class="col-lg-2 control-label">Payment Method ID</label>
                                        <div class="col-lg-10"><input type="text" id="pmid" name="pmid" readonly="" placeholder="" class="form-control" value='<?= $b["p_m_id"]?>'></div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-2 control-label">Payment Method:</label>
                                        <div class="col-sm-10"><input type="text" name="pt" id="pt" placeholder="Brand" class="form-control" value='<?= $b["payment_method"]?>' data-bv-regexp="true" data-bv-regexp-message="Please enter a valid Name" pattern="^([a-zA-Z ]{2,15})$" required/></div>
                                    </div>

                                    <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                    <div class="form-action" align="right">
                                    </br></br>
                                    <input type="button" class="btn btn-primary" id="btnupdate" value="Add">
                                    <input type="button" class="btn btn-danger btn-xl" id="btncancel" value="Cancel">
                                </div>
                            </form>
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
<script>
    $(document).ready(function(){
        $("#btncancel").click(function(){
            window.location.href = "new_payment.php";
        });
            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
            $('#cfrm').data('bootstrapValidator').resetForm();
            $("#btnupdate").click(function(){//when the save button clicked the form data captured to following js variables
                $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
                if ($('#cfrm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
                    $('#cfrm').bootstrapValidator('validate');//validate again for the confirmation

                    var pmid = $("#pmid").val();
                    var pm = $("#pt").val();
                    var url = "../handeler/pm_ctrl.php?type=update_Pt"; //location of the loading page

                    $.post(url, {pmid:pmid, pt:pm}, function(data){
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
                            url:"../handeler/pm_ctrl.php?type=update_Pt",
                            data:new FormData($("#cfrm")[0]),
                            processData:false,
                            contentType:false,
                            complete: function(data){
                                if(data.responseText =="Done"){
                                    setTimeout(function() {
                                        swal({
                                            title:'Done!',
                                            text: 'Payment Type Details Was Successfully Updated!',
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: "OK"
                                        }, function() {
                                            window.location.href ="new_payment.php";
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