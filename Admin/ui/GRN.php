<?php
    include("header.php");
    include("../lib/c_grn.php");
        $gr=new grn();
        $res=$gr->grn_no();
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
                                <h1>GRN</h1>
                                <div class="ibox-tools">
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form method="post" action="#" id="cfrm" name="cfrm"  data-toggle="validator">
                                    <div class="form-horizontal">
                                        <h2>GRN Details</h2>
                                        <hr style="height:2px; background-color:#ffffff;"></hr>
                                     
                                        <div class="form-group" style="display:none;">
                                            <label class="col-sm-4 control-label">PO no:</label>
                                            <div class="col-sm-8"><input type="text" readonly="" id="pon" name="pon" value="Normal Grn" placeholder="" class="form-control" required>
                                            </div>
                                        </div>
                                  
                          
                                        <div class="form-group" style="display: none;">
                                            <label class="col-sm-4 control-label">GRN no:</label>
                                            <div class="col-sm-8"><input type="text" readonly="readonly" id="gno" name="gno" value="<?php echo($res);?>" placeholder="" class="form-control" required>
                                            </div>
                                        </div>
                                     
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label" for="txtname">Date:</label>
                                                    <div class="col-lg-8"><input type="text" class="form-control" id="dte" name="txtdate" value="<?php echo date('Y-m-d')?>" readonly="readonly" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label">Ref no:</label>
                                                    <div class="col-lg-8"><input type="text" name="ref" id="ref" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label">Supplier:<div class="col-lg-2"><a href="sup_reg.php"><i class="fa fa-user-plus fa-2x"></a></i></div></label>
                                                    <div class="col-lg-8">
                                                        <select id="sup" name="sup" class="form-control" required>
                                                            <option value="">Select</option>
                                                                <?php
                                                                    include_once("../lib/c_add_product.php");
                                                                        $pro=new product();
                                                                        $res=$pro->load_sup();
                                                                ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="height:2px; background-color:#ffffff;"></hr>
                                    <h2>Product Details</h2>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label > <a href="Add product.php"><i class="fa fa-plus fa-2x"></i></a>  Product:</lable>
                                                
                                                <select  id="pro" class="form-control">
                                                    <option>Select Product</option>
                                                    <?php
                                                        include_once("../lib/c_add_product.php");
                                                        $pro=new product();
                                                        $res=$pro->load_mno();
                                                    ?>
                                                </select>
                                              
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label >Item Qty:</label>
                                                <input type="Number"  id="qty" class="form-control gt-zero" data-bv-integer="true" data-bv-integer-message="Please enter a valid Number" min="1" required> 
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Unit Price:</label>
                                                <input type="Number"  id="up" class="form-control gt-zero" data-bv-integer="true" data-bv-integer-message="Please enter a valid Number" min="0" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Selling Price:</label>
                                                <input type="Number"  id="sp"  class="form-control gt-zero" min="0" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input type="button" class="add-row gt-zero" id="addRow" style="background-color:#338DFF; color: #ffffff ; border-radius: 5px; padding: 3px; margin-top: 25px;" value="Add Product">
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="height:2px; background-color:#ffffff;"></hr>
                                    <div class="row">
                                        <small class="help-block" style="" id="prErrors"></small>
                                        <table class="table table-striped">
                                            <thead style="background-color: #292929; color: #fff;">
                                                <tr>
                                                    <th style="display: none;">Item:</th>
                                                    <th>Item Name:</th>
                                                    <th>Item Qty:</th>
                                                    <th>Unit Price:</th>
                                                    <th>Selling Price</th>
                                                    <th>Remove</th> 
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
                                        <br>
                                        <br>
                                        <input type="button" class="btn btn-primary" id="btn_s" value="Complete GRN">
                                        <input type="button" value="Cancel" class="btn btn-danger btn-xl" id="btn_r" value="Reset">
                                    </div>
                            </div>
                                </form>        
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>       
    </body>
</html>
    
<?php 
    include("footer.php");
?>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".add-row").click(function(){
                
                var item = $("#pro").val();
                var itemname = $("#pro option:selected").text();
                var qty = $("#qty").val();
                var uprice= $("#up").val();
                var sprice=$("#sp").val();

                if(item != "" && qty != "" && uprice != "" && sprice != ""){
                    $("#prErrors").html('');
                    var markup ="<tr><td style='display:none;'><input type='text' name ='pro[]' id='pro' value='" + item + "' readonly='readonly' style='border: none; text-align: center;'/></td><br><td>" + itemname + "</td><br><td><input type='text' name ='qty[]' id='qty' value='" + qty + "' readonly='readonly' style='border: none; text-align: center;'/></td></br><td><input type='text' name ='up[]' id='pri' value='" + uprice + "' readonly='readonly' style='border: none; text-align: center;'/></td><br><td><input type='text' name ='sp[]' id='sp' value='" + sprice + "' readonly='readonly' style='border: none; text-align: center;'/></td><td><button role='button' class='remove-row'>Remove</button></td></tr>";
                    $("table tbody").append(markup);
                }
            });

            $("#addRow").click(function(){
                $("#item").val('');
                $("#qty").val('');
                $("#up").val('');
                $("#sp").val('');
            });

        });

        $(document).on('click','.remove-row',function(){
            $(this).parent().parent().remove();
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
            $('#cfrm').data('bootstrapValidator').resetForm();
            $("#btn_s").click(function(){
                $("#prErrors").html('');
                $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
                    if ($('#cfrm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
                        $('#cfrm').bootstrapValidator('validate');//validate again for the confirmation
                            
                            var pro = $('input[name="pro[]"]').length;

                            if(parseInt(pro) > 0){
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
                                        url:"../handeler/grn_hndl.php?type=add_grn",
                                        data:new FormData($("#cfrm")[0]),
                                        processData:false,
                                        contentType:false,
                                        complete: function(data){
                                            if(data.responseText == "Done"){
                                                setTimeout(function() {
                                                    swal({
                                                        title:'Done!',
                                                        text: 'Successfully Added!',
                                                        type: "success",
                                                        allowOutsideClick: false,
                                                        confirmButtonText: "OK"
                                                        }, function() {
                                                            window.location.href ="GRN_list.php";
                                                        });
                                                    },2000);

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
                            else{
                                $("#prErrors").html('GRN should include at least one product');
                            }

                            
                    }
            });
                $("#btn_r").click(function(){
                $('#cfrm').data('bootstrapValidator').resetForm();
                });
        });

        $('.gt-zero').on('keypress',function(e){
            
            var num = $(this).val();

            if(e.keyCode == 45){
                e.preventDefault();
            }

        });
    </script>
