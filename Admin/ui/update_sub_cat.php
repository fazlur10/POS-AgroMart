    <?php
    include_once("header.php");
    include_once("../lib/c_sub_cat.php");

    if(isset($_GET["sub_cat_id"])){
        $sub_cat_id= $_GET["sub_cat_id"];

        $sc =new scat();
        $s = $sc->get_sc_byid($sub_cat_id);
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
    <!-- <script type="text/javascript">  
        $(document).ready(function(){
            $.post('../handeler/load_hndl.php',{'txtActMode':'load_drop'},function(data){
                var def='<option>--Select here--</option>';
                var rows = '';
                // $("#cate").html('');
                $("#cate").append(def);
                for (var i = 0; i < data.length; i++) {
                    var catId = data[i].cat_id;
                    var catName = data[i].cat;
                    rows = '<option value="'+catId+'">'+catName+'</option>';
                    $("#cate").append(rows); 
                }   
            },'Json');
        });
    </script> -->
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
                                <h1>Update Sub Category</h1>
                                <div class="ibox-tools">
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form method="POST" action="#" id="cfrm" name="frm" class="form-horizontal data-toggle="validator">
                                    <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Sub Category ID</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="s_c_id" id="s_c_id" readonly="" value='<?= $s["sub_cat_id"]?>' class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Select Category</label>
                                        <div class="col-sm-10">
                                            <select id="cate" class="form-control" name="cate" value='<?= $s["cat_id"]?>'>
                                               <option ></option>
                                                <?php
                                                  include_once("../lib/c_sub_cat.php");
                                                  $sc=new scat();
                                                  $res=$sc->load_cat();
                                                ?> 
                                           </select>
                                       </div>
                                   </div>
                                   
                                   <div class="form-group">
                                    <label class="col-sm-2 control-label">Sub Category</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="s_c" id="s_c"  placeholder="Sub Category" value='<?= $s["sub_cat"]?>' class="form-control" required/>
                                            
                                        </div>
                                    </div>
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
            window.location.href = "New_sub_cat.php";
        });

        $("#cate").each(function(){ $(this).find('option[value="'+$(this).attr("value")+'"]').prop('selected', true)
      });

            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
            $('#cfrm').data('bootstrapValidator').resetForm();
            $("#btnupdate").click(function(){//when the save button clicked the form data captured to following js variables
                $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
                if ($('#cfrm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
                    $('#cfrm').bootstrapValidator('validate');//validate again for the confirmation

                    var sc_id = $("#s_c_id").val();
                    var cat = $("#cate").val();
                    var s_c = $("#s_c").val();
                    var url = "../handeler/sub_cat_ctrl.php?type=update_Scat"; //location of the loading page

                    $.post(url, {s_c_id:sc_id, cate:cat, s_c:s_c}, function(data){
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
                            url:"../handeler/sub_cat_ctrl.php?type=update_Scat",
                            data:new FormData($("#cfrm")[0]),
                            processData:false,
                            contentType:false,
                            complete: function(data){
                                if(data.responseText =="Done"){
                                    setTimeout(function() {
                                        swal({
                                            title:'Done!',
                                            text: 'Sub Category Details Was Successfully Updated!',
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
                        
                    });
                }
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
    </script>
    <?php 
    include("footer.php");
    ?>