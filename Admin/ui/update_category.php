    <?php
    include_once("header.php");
    include_once("../lib/c_cat.php");

    if(isset($_GET["cat_id"])){
        $cat_id= $_GET["cat_id"];

        $cat =new category();
        $c = $cat->get_cat_byid($cat_id);            
    }
    ?>
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
                                <h1>Update Category</h1>
                                <div class="ibox-tools">
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="#" id="cfrm" class="form-horizontal">
                                    <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                    
                                    <div class="form-group"><label class="col-lg-2 control-label">Category ID</label>
                                        <div class="col-lg-10"><input type="text" name="cid" id="cid" readonly="" placeholder="" class="form-control" value='<?= $c["cat_id"]?>'></div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-2 control-label">Category</label>
                                        <div class="col-sm-10"><input type="text" name="ca" id="ca" placeholder="Category" name="cat" class="form-control" value='<?= $c["cat"]?>' required/></div>
                                    </div>

                                    <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                    <div class="form-action" align="right">
                                    </br></br>
                                    <input type="button" class="btn btn-primary" id="btnupdate" value="Update">
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
            window.location.href = "New_cat.php";
        });
            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
            $('#cfrm').data('bootstrapValidator').resetForm();
            $("#btnupdate").click(function(){//when the save button clicked the form data captured to following js variables
                $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
                if ($('#cfrm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
                    $('#cfrm').bootstrapValidator('validate');//validate again for the confirmation

                    var catid = $("#cid").val();
                    var cat = $("#ca").val();
                    var url = "../handeler/cat_ctrl.php?type=update_cat"; //location of the loading page

                    $.post(url, {cid:catid, ca:cat}, function(data){
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
                            url:"../handeler/cat_ctrl.php?type=update_cat",
                            data:new FormData($("#cfrm")[0]),
                            processData:false,
                            contentType:false,
                            complete: function(data){
                                if(data.responseText =="Done"){
                                    setTimeout(function() {
                                        swal({
                                            title:'Done!',
                                            text: 'Category Details Was Successfully Updated!',
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: "OK"
                                        }, function() {
                                            window.location.href ="New_cat.php";
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