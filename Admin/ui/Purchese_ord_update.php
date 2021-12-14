<?php
    include("header.php");
    include_once("../lib/c_purchese_ord.php");

        if(isset($_GET["po_no"])){
            $po_no= $_GET["po_no"];
            $po=new pur();
            $p = $po->get_po_by_id($po_no);
        }
?>

<?php
    include_once("../lib/c_purchese_ord.php");
        $po=new pur();
        $c1=$po->get_po_details($po_no);

            if(!empty($c1)){
                foreach ($c1 as $item) {
                    $id=$item->p_id;
                    $model=$item->model;
                    $qty=$item->qty;
                }
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
                                        
                                        <label for="first_name" class="col-md-2" align="right">
                                            PO no:
                                        </label>
                                        <div class="form-group col-md-4">
                                            <input type="text"  class="form-control" id="pon" name="pon" readonly="" value='<?= $p["po_no"]?>'></br>
                                        </div>

                                        <label for="first_name" class="col-md-2" align="right">
                                            Order Date:
                                        </label>
                                        <div class="form-group col-md-4">
                                            <input type="text" name="or_d" class="form-control" id="or_d" value="<?php echo date('Y-m-d')?>" readonly="readonly" ></br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="j_role" class="col-md-2" align="right">
                                            Supplier:
                                            <div class="col-lg-2"><a href=""><i class="fa fa-user-plus fa-2x"></a></i></div>
                                        </label>

                                        <div class="form-group col-md-4">
                                            <select name="sup" class="form-control" id="sup" value="<?= $p['sup_id']?>"required>
                                                <option></option>
                                                <?php
                                                include_once("../lib/c_add_product.php");
                                                $pro=new product();
                                                $res=$pro->load_sup();
                                                ?>
                                            </select></br>
                                        </div>

                                        <label for="first_name" class="col-md-2" align="right">
                                            Shipping Date:
                                        </label>
                                        <div class="form-group col-md-4">
                                            <input type="Date" name="sd" id="sd"class="form-control" id="" value=<?= $p['po_date']?> data-bv-regexp-message="Please Select Date" required/></br>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <h3 class="form-section"><i class="icon-head"></i><strong>Item Details</strong></h3>
                                        <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                        <label class="col-md-2" align="right"><a href="Add product.php"><i class="fa fa-plus fa-2x"></a></i>Product: <div class="col-lg-2"></div>
                                        </label>
                                        <div class="form-group col-md-4">
                                            <select class="form-control" id="pro_name">
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
                                            <input type="number" class="form-control gt-zero" id="pro_qty" placeholder=""></br>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <input type="button" class="add-row" id="addRow" style="background-color:#338DFF; color: #ffffff ; border-radius: 5px; padding: 3px; margin-top: 35px;" value="Add Item">
                                        </div> 
                                    </div>

                                    <hr style="height:2px; background-color:#ffffff;"></hr>

                                    <div class="row">
                                        <table class="table table-striped" id="itm_tbl">
                                            <thead style="background-color: #292929; color: #fff;">
                                                <tr>
                                                    <th style="display:none">Product id</th>
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
                                        <input type="button" class="btn btn-primary" id="btnupdate" value="Complete Order">
                                        <input type="reset" class="btn btn-danger btn-xl" id="btncancel" value="Cancel">
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
    var poItems = <?php echo json_encode($c1);?>;
    var existingItems = new Array();
    $(document).ready(function(){

            console.log(poItems);

            for(var i=0; i<poItems.length; i++){
                
                var p_id = poItems[i].p_id;
                var model = poItems[i].model;
                var qty = poItems[i].qty;
                existingItems[i] = p_id;

                var markup ="<tr><td><input type='text' id='pro2' value='"+model+"' readonly='readonly' style='border: none; text-align: center; width:500px;'/></td><br><td style='display:none;'><input type='text' name ='pro[]' id='pro' value='"+p_id+"' readonly='readonly' style='border: none; text-align: center;'/></td><br><td><input type='text' name ='qty[]' id='qty' value='"+qty+"' readonly='readonly' style='border: none; text-align: center;'/></td><td><button role='button' class='remove-row'>Remove</button></td></tr>";
                    $("#itm_tbl tbody").append(markup);    
            }

            
    });

    $(".add-row").click(function(){
        var prd = $("#pro_name").val(); 
        var prd2 =$("#pro_name option:selected").text();
        var qun = $("#pro_qty").val();

        var inarray = $.inArray(prd, existingItems);

        if(prd != '' && qun != '' && inarray== -1){
            var markup ="<tr><td><input type='text' id='pro2' value='" + prd2 + "' readonly='readonly' style='border: none; text-align: center; width:500px;'/></td><br><td style='display:none; center; '><input type='text' name ='pro[]' id='pro' value='" + prd + "' readonly='readonly' style='border: none; text-align: center; '/></td><br><td><input type='text' name ='qty[]' id='qty' value='" + qun + "' readonly='readonly' style='border: none; text-align: center;'/></td><td><button role='button' class='remove-row'>Remove</button></td></tr>";
            $("#itm_tbl tbody").append(markup);
        }
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
        $("#btncancel").click(function(){
            window.location.href = "view_Purchese_ord.php";
        });

        $("#sup").each(function(){ $(this).find('option[value="'+$(this).attr("value")+'"]').prop('selected', true); });

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
                            url:"../handeler/po_ctrl.php?type=update_po",
                            data:new FormData($("#cfrm")[0]),
                            processData:false,
                            contentType:false,
                            complete: function(data){
                                if(data.responseText =="Done"){
                                    setTimeout(function() {
                                        swal({
                                            title:'Done!',
                                            text: 'Purchese Order Details Was Successfully Updated!',
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