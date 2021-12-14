<?php
    include("header.php");
    include("../lib/c_order.php");
        $or=new order();
        $res=$or->order_id();
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
        <style type="text/css">
            .box{
                border:1px solid black;
                width:44%;
                border-radius:10px;
            }
        </style>
    </head>
    <body>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h1>New Sale</h1>
                                <div class="ibox-tools">
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form method="post" action="#" id="cfrm" name="cfrm" class="form-horizontal" data-toggle="validator">
                                    <h2>Basic Details</h2>
                                    <hr style="height:2px; background-color:#ffffff;"></hr> 
                                    <div class="row" >
                                        <div class="form-horizontal" style="display:none;">
                                            <label class="col-lg-2 control-label">Order No</label>
                                            <div class="col-lg-4"><input type="text" readonly="" id="ono" name="ono" value="<?php echo($res); ?>" placeholder="" class="form-control" readonly="">
                                            </div>
                                        </div>

                                        <div class="form-horizontal" style="display:none;">
                                            <label class="col-lg-2 control-label">Order Type</label>
                                            <div class="col-lg-4"><input type="text" readonly="" id="otype" name="otype" value="walking order" placeholder="" class="form-control" readonly="">
                                            </div>
                                        </div>     

                                        <div class="form-group" id="div_r_cus">
                                            <label class="col-lg-2 control-label">Customer:<div class="col-lg-2"><a href="Customer_reg.php"><i class="fa fa-user-plus fa-2x"></a></i></div></label>
                                            <div class="col-lg-4">
                                                <select id="cus" name="cus" class="form-control" required>
                                                    <?php
                                                        include_once("../lib/c_order.php");
                                                            $or=new order();
                                                            $res=$or->load_cus();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <hr style="height:2px; background-color:#ffffff;"></hr>
                                    <h2>Item Details</h2>
                                    <div class="row">
                                        <div><a href="Add product.php"><i class="fa fa-plus fa-2x"></a></i></div>
                                        <div class="col-md-4">
                                            <select  id="pro" class="form-control" required>
                                                <option> </option>
                                                <?php
                                                    include_once("../lib/c_add_product.php");
                                                        $pro=new product();
                                                        $res=$pro->load_mno();
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="col-lg-4 control-label">Serial number:</label>
                                            <div class="col-lg-6"><input type="text"  id="code" placeholder="" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="col-lg-4 control-label">Selling Price:</label>
                                            <div class="col-lg-6"><input type="text"  id="sp" placeholder="" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3" >
                                            <label class="col-lg-4 control-label">Item Qty:</label>
                                            <div class="col-lg-6"><input type="text"  id="qty" placeholder="" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <input type="button" class="add-row" id="addRow" style="background-color:#338DFF; color: #ffffff ; border-radius: 5px; padding: 3px; margin-top: 35px;" value="Add Item">
                                        </div>
                                    </div>
                                    <!--get qty-->
                                    <input type="text" name="hiddnqty" id="hiddnqty" style="display:none">
                                    <div class="row">
                                        <table class="table table-striped" id="item_table">
                                            <thead style="background-color: #292929; color: #fff;">
                                                <tr>
                                                    <th style="display:none;">Item:</th>
                                                    <th>Item Name:</th>
                                                    <th>Item Code:</th>
                                                    <th>Qty:</th>
                                                    <th>Selling Price:</th>
                                                    <th>Sub Total</th>
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
                                    <table class="table invoice-total">
                                        <tbody>
                                            <tr>
                                                <td><strong>TOTAL :</strong></td>
                                                <td><input style="border: none; text-align: right;" type="text" readonly="" name="txttot" id="txttot" value="0"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-action" align="right">
                                        <br>
                                        <br>
                                        <button type="button"  class="btn btn-success"data-toggle="modal" data-target="#myModal">Payment Here</button>
                                        <button type="button" value="Cancel" class="btn btn-danger btn-xl" id="btn_r">Reset</button>
                                    </div> 
                                    <hr style="height:2px; background-color:#ffffff;"></hr>
                                        <div class="container">
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" role="dialog">
                                                    <div class="modal-dialog">
                                                      <!-- Modal content-->
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                          <h4 class="modal-title">Payment Summery</h4>
                                                      </div>
                                                      <div class="modal-body">

                                                        <table class="table invoice-total">
                                                            <tbody>

                                                                <tr>

                                                                    <div class="form-group" >
                                                                        <div class="col-md-3">
                                                                            <select id="pay" name="c" class="form-control" value="P00001" style="display:none;">
                                                                                <?php
                                                                                include_once("../lib/c_add_product.php");
                                                                                $pro=new product();
                                                                                $res=$pro->load_payment();
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group"><label class="col-lg-2 control-label">Grand Total:</label>

                                                                        <div class="col-lg-10"><input type="text" name="gtot" id="gtot" class="form-control" data-bv-integer="true" min="0" data-bv-integer-message="Please enter a valid Number"  readonly="" required> <span class="help-block m-b-none"></span>
                                                                        </div>
                                                                    </div>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <div class="form-group"><label class="col-lg-2 control-label">Discount:</label>

                                                                        <div class="col-lg-10"><input type="text" class="form-control" data-bv-integer="true" data-bv-integer-message="Please enter a valid Number" min="0" name="dis" id="dis" placeholder="%" required> <span class="help-block m-b-none"></span>
                                                                        </div>
                                                                    </div>
                                                                </tr>

                                                                <tr>
                                                                    <div class="form-group"><label class="col-lg-2 control-label">Net Total:</label>

                                                                        <div class="col-lg-10"><input type="text" class="form-control" data-bv-integer="true" min="0"data-bv-integer-message="Please enter a valid Number"  readonly="" name="nt_amt" id="nt_amt" required> <span class="help-block m-b-none"></span>
                                                                        </div>
                                                                    </div>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <div class="form-group"><label class="col-lg-2 control-label">Amount:</label>

                                                                        <div class="col-lg-10"><input type="text" id="amount" name="amount" class="form-control" data-bv-integer="true" min="0" data-bv-regexp-integer="Please enter a valid Number"  required> <span class="help-block m-b-none"></span>
                                                                        </div>
                                                                    </div> 
                                                                </tr>
                                                                <tr>
                                                                    <div class="form-group"><label class="col-lg-2 control-label">Balance:</label>

                                                                        <div class="col-lg-10"><input type="text" id="bal" name="bal" class="form-control" data-bv-integer="true" min="0" data-bv-regexp-integer="Please enter a valid Number" readonly="" readonly=""required> <span class="help-block m-b-none" ></span>
                                                                        </div>
                                                                    </div>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" id="btn_s"class="btn btn-success" data-dismiss="modal">Complete Order</button>
                                                  </div>
                                              </div>
                                          </div>
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

<script type="text/javascript">
    $(document).ready(function(){
        $(".add-row").click(function(){
            var item = $("#pro").val();
            var itemname = $("#pro option:selected").text();
            var itmcode = $("#code").val();
            var qty= $("#qty").val();
            var selpri=$("#sp").val();
            var subtot = selpri*qty;
            var curqty = $("#hiddnqty").val();
            if(item != "" && itmcode  != "" && selpri != ""){
                if(1>Number(curqty)){
                    swal("Out of stock!");
                }
                else{ 

                
                    var markup ="<tr><td style='display:none;'><input type='text' name ='pro[]' id='pro' value='" + item + "' readonly='readonly' style='border: none; text-align: center;'/></td><br><td>" + itemname + "</td><br><td><input type='text' name ='code[]' id='code' value='" + itmcode + "' readonly='readonly' style='border: none; text-align: center;'/></td></br><td><input type='text' name ='qty[]' id='qty' value='" + qty + "' readonly='readonly' style='border: none; text-align: center;'/></td><br><td><input type='text' name ='sp[]' id='sp' value='" + selpri + "' readonly='readonly' style='border: none; text-align: center;'/></td></br> <td><input type='text' name ='sbt[]' id='sbt' value='" + subtot + "' readonly='readonly' style='border: none; text-align: center;'/></td><td><button role='button' class='remove-row'>Remove</button></td></tr>";

                    $("#item_table tbody").append(markup);
                    data = subtot;
                    total(data);
                

                    $("#addRow").click(function(){
                        $("#pro").val('');
                        $("#code").val('');
                        $("#qty").val('');
                        $("#sp").val('');
                        $("#hiddnqty").val('');
                    });   
                }
            }
        

        });
    });

     $(document).on('click','.remove-row',function(){
            $(this).parent().parent().remove();
        });
</script>   
<script>
    function total(){
        var Current_tot = $("#txttot").val();
        var Final_tot = Number(Current_tot)+Number(data);

        $('#txttot').val(Final_tot);
        $('#gtot').val(Final_tot);
    }

    function get_discount(){

        var TotAmount =$('#txttot').val();
        var discount=$("#dis").val();

        var dis_amount =(Number(TotAmount)*(discount/100));
        var discountvalue=(Number(TotAmount)-Number(dis_amount));

        $('#nt_amt').val(discountvalue);
    }

    function calculate_bal(){
        var cash_in=$("#nt_amt").val();
        var paid_amount=$("#amount").val();
        
        if(Number(paid_amount) < Number(cash_in)){
            var balance =cash_in-paid_amount;
            $("#bal").val(balance);
        }
        else{
            $("#bal").val(0);
        }
    }

    $("#pro").change(function(){
        var pro = $("#pro").val();
        $.get("../handeler/order_hndl.php?type=onchange",{ 
            pro:pro},function(data){
                var result = JSON.parse(data);
                p_id = result.p_id;
                p_name=result.model_number;
                p_price = result.sell_price;
                hiqty=result.tot_qty;
                $("#sp").val(p_price);
                $("#hiddnqty").val(hiqty);
            });
    });
</script>
<script>
    $("#dis").keyup(function(){
        get_discount();
    });
    $("#amount").keyup(function(){
        calculate_bal();
    }); 
</script>

<script>
    $(document).ready(function(){
$('#cfrm').bootstrapValidator('validate');//validate variable-'val'
$('#cfrm').data('bootstrapValidator').resetForm();
$("#btn_s").click(function(){
        var oid=$('#ono').val();
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
            url:"../handeler/order_hndl.php?type=add_ord_info",
            data:new FormData($("#cfrm")[0]),
            processData:false,
            contentType:false,
            complete: function(data){
                if(data.responseText =="DoneDone"){
                    setTimeout(function() {
                        swal({
                            title:'Done!',
                            text: 'Successfully Added!',
                            type: "success",
                            allowOutsideClick: false,
                            confirmButtonText: "OK"
                        }, function() {
                            window.location.href ="invoice.php?id="+oid;
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

