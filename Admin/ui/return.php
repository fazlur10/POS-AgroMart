<?php
    include_once("header.php");
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
                                <h1>Return</h1>
                                <div class="ibox-tools">
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                                <div class="ibox-content">
                                    <form method="post" action="#" id="cfrm" name="cfrm" class="form-horizontal"data-toggle="validator">
                                        <h2>Return Details</h2>
                                        <hr style="height:2px; background-color:#ffffff;"></hr>
                                        <div class="row">
                                            <div class="form-horizontal">
                                                <label class="col-lg-2 control-label">Item Code:</label>
                                                <div class="col-lg-4"><input type="text" name="ic" id="ic" placeholder="" class="form-control" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="txtname">Date:</label>
                                                <div class="col-lg-4"><input type="text" class="form-control" id="dte" name="dte" value="<?php echo date('Y-m-d')?>" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-inline">
                                                <label class="col-lg-2 control-label">Reason:</label>
                                                <div class="col-lg-4">
                                                    <select  id="res" name="res" class="form-control" required>
                                                        <option></option>
                                                        <option>Technical Faults</option>
                                                        <option>Customer Request</option>
                                                        <option>Other</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-inline">
                                                <label class="col-lg-2 control-label" for="txtname">Remarks:</label>
                                                <div class="col-lg-4"><textarea name="re" id="re" cols="40" rows="5"  style="resize:none;" required></textarea>  
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="col-lg-4 control-label"style="display:none">customer order number:</label>
                                                <div class="col-lg-6"><input type="text"  id="ono" placeholder="" class="form-control"  style="display:none">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label class="col-lg-4 control-label"style="display:none">Item code:</label>
                                                <div class="col-lg-6"><input type="text"  id="icode" placeholder="" class="form-control"  style="display:none">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label class="col-lg-4 control-label"style="display:none">Cus name</label>
                                                <div class="col-lg-6"><input type="text"  id="cname" placeholder="" class="form-control"  style="display:none">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label class="col-lg-4 control-label"style="display:none">order date</label>
                                                <div class="col-lg-6"><input type="text"  id="od" placeholder="" class="form-control"  style="display:none">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label class="col-lg-4 control-label"style="display:none">item</label>
                                                <div class="col-lg-6"><input type="text"  id="mn" placeholder="" class="form-control"  style="display:none">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label class="col-lg-4 control-label" style="display:none">sold price</label>
                                                <div class="col-lg-6"><input type="text"  id="sol_pri" placeholder="" class="form-control" style="display:none">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label class="col-lg-4 control-label" style="display:none">product_id</label>
                                                <div class="col-lg-6"><input type="text"  id="p_id" placeholder="" class="form-control" style="display:none;">
                                                </div>
                                            </div>

                                            <br>
                                            <br>
                                            <div class="form-group col-md-2">
                                                <input type="button" class="add-row" id="addRow" style="background-color:#338DFF; color: #ffffff ; border-radius: 5px; padding: 3px; margin-top: 35px;" value="View Item">
                                            </div>
                                        </div>
                                        <hr style="height:2px; background-color:#ffffff;"></hr>
                                        <div class="row">
                                            
                                            <table class="table table-striped">
                                                <thead style="background-color: #292929; color: #fff;">
                                                    <tr>
                                                        <th>Order No:</th>
                                                        <th>itm Code</th>
                                                        <th>customer Name:</th>
                                                        <th>Order Date:</th>
                                                        <th>Item</th>
                                                        <th>Sold Price</th>
                                                        <th style="display:none;">product id</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot> 
                                                </tfoot>
                                            </table>               
                                        </div>
                                        <hr style="height:2px; background-color:#ffffff;"></hr>
                                        <div class="form-action" align="right">
                                            <input type="button" class="btn btn-primary" id="btn_s" value="Return Product">
                                            <input type="button" value="Cancel" class="btn btn-danger btn-xl" id="btn_r" value="Reset">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $(".add-row").click(function(){
            var onum = $("#ono").val();
            var icod = $("#icode").val();
            var cnam= $("#cname").val();
            var odate=$("#od").val();
            var itm=$("#mn").val();
            var solpri=$("#sol_pri").val();
            var pro=$("#p_id").val();
            var markup ="<tr><td><input type='text' name ='ono' id='ono' value='" + onum + "' readonly='readonly' style='border: none; text-align: center;'/></td><br><td><input type='text' name ='icode' id='icode' value='" + icod + "' readonly='readonly' style='border: none; text-align: center;'/></td></br><td><input type='text' name ='cname' id='cname' value='" + cnam + "' readonly='readonly' style='border: none; text-align: center;'/></td><br><td><input type='text' name ='odate' id='odate' value='" + odate + "' readonly='readonly' style='border: none; text-align: center;'/></td><br><td><input type='text' name ='mn' id='mn' value='" + itm + "' readonly='readonly' style='border: none; text-align: center;'/></td><br><td><input type='text' name ='sol_pri' id='sol_pri' value='" + solpri + "' readonly='readonly' style='border: none; text-align: center;'/></td><td><input type='text' name ='p_id' id='p_id' value='" + pro + "' readonly='readonly' style='border: none; text-align: center;'/></td></tr>";
            $("table tbody").append(markup);
        });

        $("#addRow").click(function(){
            $("#ono").val('');
            $("#icode").val('');
            $("#cname").val('');
            $("#od").val('');
            $("#itm").val('');
            $("#solpri").val('');
            $("#p_id").val('');
        });
    });
</script>
<script>
    $("#ic").keyup(function(){
        var ic = $("#ic").val();
        $.get("../handeler/return_hndl.php?type=return_itm_details",{ 
            ic:ic},function(data, status){
                if(status =="success"){
                    var result = JSON.parse(data);
                    $("#ono").val(result.cus_ord_no);
                    $("#icode").val(result.itm_code);
                    $("#cname").val(result.f_name+result.l_name);
                    $("#od").val(result.ordate);
                    $("#mn").val(result.model_number);
                    $("#sol_pri").val(result.sel_pri);
                    $("#p_id").val(result.p_id);
                }
            });
    });
</script>
<script>
    $(document).ready(function(){
        $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
        $('#cfrm').data('bootstrapValidator').resetForm();
        $("#btn_s").click(function(){
            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
                if ($('#cfrm').data('bootstrapValidator').isValid()){//isValid() return true if valid
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
                        url:"../handeler/return_hndl.php?type=return_i",
                        data:new FormData($("#cfrm")[0]),
                        processData:false,
                        contentType:false,
                        complete: function(data){
                            if(data.responseText =="DoneDone"){
                                setTimeout(function() {
                                    swal({
                                        title:'Done!',
                                        text: 'Successfully Returned!',
                                        type: "success",
                                        allowOutsideClick: false,
                                        confirmButtonText: "OK"
                                    }, function() {
                                        window.location.href ="return.php";
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
<?php
    include("footer.php");
?>