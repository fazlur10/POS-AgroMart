<?php
    include("header.php");
    include_once("../lib/c_purchese_ord.php");

        if(isset($_GET["po_no"])){
            $po_no= $_GET["po_no"];
            $po=new pur();
            $p = $po->get_po_by_id($po_no);
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
                                <h1> GRN Purchese Order</h1>
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
                                        Date:
                                        </label>
                                        <div class="form-group col-md-4">
                                            <input type="text" class="form-control" id="txtdate" name="txtdate" value="<?php echo date('Y-m-d')?>" readonly="readonly" ></br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-horizontal">
                                            <label class="col-lg-2 control-label">Ref no:</label>
                                            <div class="col-lg-4"><input type="text" id="ref" name="ref" 
                                            class="form-control" required/>
                                            </div>
                                        </div>

                                        <div class="form-horizontal">
                                            <label class="col-lg-2 control-label">Supplier:</label>
                                            <div class="col-lg-4"><input type="text"  
                                            value='<?= $p["comp_name"]?>' class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="form-horizontal" style="display:none;">
                                            <label class="col-lg-2 control-label">Supplier:</label>
                                            <div class="col-lg-4"><input type="text" id="sup" name="sup" 
                                            value='<?= $p["sup_id"]?>' class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h3 class="form-section"><i class="icon-head"></i><strong>Item Details</strong></h3>
                                        <hr style="height:2px; background-color:#3c8dbc;"></hr>
                                    </div>
                                    <div class="row">
                                        <table class="table table-striped">
                                            <thead style="background-color: #292929; color: #fff;">
                                                <tr>
                                                    <th style="display: none;">Product</th>
                                                    <th>Item Name</th>
                                                    <th>Qty</th>
                                                    <th>Unit Price</th>
                                                    <th>Selling Price</th>   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                  include_once("../lib/c_purchese_ord.php");
                                                    $po=new pur();
                                                    $c1=$po->get_po_details($po_no);
                                                        if(!empty($c1)){
                                                            foreach ($c1 as $item) {
                                                              echo ("<tr id='tr_$item->p_id'>
                                                                        <td style='display:none'><input type='text' name ='pro[]' id='pro' value='$item->p_id' readonly='readonly' style='border: none; text-align: center;'/></td>
                                                                        <td><input type='text' id='pro2' value='$item->model' readonly='readonly' style='border: none; text-align: center;' width='500px;'/></td>
                                                                        <td><input type='number' id='qty' name ='qty[]'  value='$item->qty' text-align: center;' min='0'/></td>
                                                                        <td><input type='number' id='up' name ='up[]'  text-align: center;' min='0'/></td>
                                                                        <td><input type='number' id='sp' name ='sp[]' text-align: center;' min='0'/></td>
                                                                        <td>
                                                                    </tr>");
                                                            }
                                                        }
                                                ?> 
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

<script>
    $(document).ready(function(){
        $("#btncancel").click(function(){
            window.location.href = "GRN_list.php";
        });
            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
            $('#cfrm').data('bootstrapValidator').resetForm();
            $("#btnupdate").click(function(){//when the save button clicked the form data captured to following js variables
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
                            url:"../handeler/grn_hndl.php?type=add_grn",
                            data:new FormData($("#cfrm")[0]),
                            processData:false,
                            contentType:false,
                            complete: function(data){
                                if(data.responseText =="Done"){
                                    setTimeout(function() {
                                        swal({
                                            title:'Done!',
                                            text: 'GRN Was Successfully Added!',
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: "OK"
                                        }, function() {
                                            window.location.href ="GRN_list.php";
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