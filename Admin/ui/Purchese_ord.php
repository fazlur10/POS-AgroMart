    <?php
        include("header.php");
        include_once("../lib/c_purchese_ord.php");
            $po=new pur();
            $res2=$po->poid();
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
                                <h1>Purchese Order</h1>
                                <div class="ibox-tools">
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form action="#" method="POST" name="cform" id="cfrm" data-toggle="validator" autocomplete="on">
                                    <div class="row">
                                        <h3 class="form-section"><i class="icon-head"></i><strong>Basic Details</strong></h3>
                                        <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                        
                                        <label for="first_name" class="col-md-2" align="right" style="display:none;">
                                            PO no:
                                        </label>
                                        <div class="form-group col-md-4">
                                            <input type="text" name="first_name" class="form-control" id="" style="display:none;" readonly="" value="<?php echo($res2); ?>"></br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-horizontal">
                                            <label  class="col-md-2" align="right">Order Date:</label>
                                            <div class="form-group col-md-4">
                                            <input type="text" name="or_d" class="form-control" id="or_d" value="<?php echo date('Y-m-d')?>" readonly="readonly" ></br>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2" align="right">Supplier:
                                                <div class="col-lg-2"><a href="sup_mng.php"><i class="fa fa-user-plus fa-2x"></a></i></div></label>
                                            <div class="form-group col-md-4">
                                                <select name="sup" class="form-control" id="sup">
                                                    <option>Select</option>
                                                    <?php
                                                        include_once("../lib/c_add_product.php");
                                                            $pro=new product();
                                                            $res=$pro->load_sup();
                                                    ?>
                                                </select></br>
                                            </div>
                                        </div>

                                        <label for="first_name" class="col-md-2" align="right">
                                            Shipping Date:
                                        </label>
                                        <div class="form-group col-md-4">
                                            <input type="Date" name="sd" id="sd"class="form-control" data-bv-regexp-message="Please Select Date" required/></br>
                                        </div> 
                                    </div> 

                                    <div class="row">
                                        <h3 class="form-section"><i class="icon-head"></i><strong>Item Details</strong></h3>
                                        <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                        <label class="col-md-2" align="right"><a href="Add product.php"><i class="fa fa-plus fa-2x"></a></i>Product: <div class="col-lg-2"></div>
                                        </label>
                                        <div class="form-group col-md-4">
                                            <select class="form-control" id="pro">
                                                <option>Select</option>
                                                <?php
                                                    include_once("../lib/c_add_product.php");
                                                        $pro=new product();
                                                        $res=$pro->load_mno();
                                                ?>
                                            </select></br>
                                        </div>

                                        <label for="last_name" class="col-md-2" align="right">
                                            Qty:
                                        </label>
                                        <div class="form-group col-md-4">
                                            <input type="text" class="form-control gt-zero" id="qty" placeholder="" autocopmlete="on" required/></br>
                                        </div>
                                            <br>
                                            <br>
                                        <div class="form-group col-md-2">
                                            <input type="button" class="add-row" id="addRow" style="background-color:#338DFF; color: #ffffff ; border-radius: 5px; padding: 3px; margin-top: 35px;" value="Add Item">
                                        </div> 
                                    </div>

                                    <hr style="height:2px; background-color:#ffffff;"></hr>

                                    <div class="row">
                                        <small class="help-block" style="" id="prErrors"></small>
                                        <table class="table table-striped">
                                            <thead style="background-color: #292929; color: #fff;">
                                                <tr>
                                                    <th style="display:none;">item</th>
                                                    <th>Product</th>
                                                    <th>QTY</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot> 
                                            </tfoot>
                                        </table>               
                                    </div>

                                    <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                    <div class="form-action" align="right">
                                        <br><br>
                                        <input type="button" class="btn btn-primary" id="btn_s" value="Complete Order">
                                        <input type="reset" class="btn btn-danger btn-xl" id="btn_r" value="Cancel">
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
<script type="text/javascript">
    var existingItems = new Array();
    $(document).ready(function(){
        $(".add-row").click(function(){
            var prd = $("#pro").val();
            var prd2 =$("#pro option:selected").text();
            var qun = $("#qty").val();

            console.log($.inArray(prd, existingItems));
            var inarray = $.inArray(prd, existingItems);
            if(prd != '' && qun != '' && inarray == -1){
                $("#prErrors").html('');
                existingItems.push(prd);
                var markup ="<tr><td><input type='text' id='pro2' value='" + prd2 + "' readonly='readonly' style='border: none; text-align: center;'/></td><br><td style='display:none;'><input type='text' name ='pro[]' id='pro' value='" + prd + "' readonly='readonly' style='border: none; text-align: center;'/></td><br><td><input type='text' name ='qty[]' id='qty' value='" + qun + "' readonly='readonly' style='border: none; text-align: center;'/></td><td><button role='button' class='remove-row' value='"+prd+"'>Remove</button></td></tr>";
                $("table tbody").append(markup);
            }
        });

        $("#addRow").click(function(){
            $("#pro").val('');
            $("#qty").val('');
        });
    });

    $(document).on('click','.remove-row',function(){
            var prd = $(this).val();
            var inarray = $.inArray(prd, existingItems);
            existingItems.splice(inarray,1);            
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
                        if(parseInt(pro) > 0)
                        {
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
                                url:"../handeler/po_hndl.php",
                                data:new FormData($("#cfrm")[0]),
                                processData:false,
                                contentType:false,
                                complete: function(data){
                                    if(data.responseText =="Done"){
                                        setTimeout(function() {
                                            swal({
                                                title: 'Done!',
                                                text: 'Order Complete Successfully!',
                                                type: "success",
                                                allowOutsideClick: false,
                                                confirmButtonText: "OK"
                                            }, function() {
                                                window.location.href ="view_Purchese_ord.php";
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
                        else{
                            $("#prErrors").html('Purchese order should include at least one product');
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
<?php 
    include("footer.php");
?>