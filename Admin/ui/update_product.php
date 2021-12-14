<?php
include_once("header.php");
include_once("../lib/c_add_product.php");

if(isset($_GET["p_id"])){
  $p_id= $_GET["p_id"];
  $pro =new product();
  $p = $pro->get_pro_byid($p_id);
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
              <h1>Update product</h1>
              <div class="ibox-tools">
                <a class="close-link">
                  <i class="fa fa-times"></i>
                </a>
              </div>
            </div>
            <div class="ibox-content">
              <form action="#" method="POST" name="cform" id="cfrm" enctype="multipart/form-data" data-toggle="validator" autocomplete="on">
                <hr style="height:2px; background-color:#3c8dbc;"></hr>
                <div class="row">
                  <div class="row">
                    <label for="first_name" class="col-md-2" align="right">
                      Product ID:
                    </label>
                    <div class="form-group col-md-4">
                      <input type="text" readonly="" name="p_id" class="form-control" id="p_id" value='<?= $p["p_id"]?>'>
                    </div>

                    <label for="j_role" class="col-md-2" align="right">
                      Category:<div class="col-lg-2"><a href="New_cat.php"><i class="fa fa-plus fa-2x"></a></i></div>
                    </label>
                    <div class="form-group col-md-4">
                      <select name="cat" class="form-control" id="cat" required/>
                      <option>Select</option>
                      <?php
                      include_once("../lib/c_add_product.php");
                      $pro=new product();
                      $res=$pro->load_cat();
                      ?>        
                    </select></br>
                  </div>
                </div>
                <div class="row">          
                  <label for="j_role" class="col-md-2" align="right">
                    Sub Category:<div class="col-lg-2"><a href="New_sub_cat.php"><i class="fa fa-plus fa-2x"></a></i></div>
                  </label>
                  <div class="form-group col-md-4">
                    <select name="scat" class="form-control" id="scat" value='<?= $p["sub_cat_id"]?>'>
                    <option>Select</option>
                    <?php
                    include_once("../lib/c_add_product.php");
                    $pro=new product();
                    $res=$pro->load_scat();
                    ?>         
                  </select></br>
                </div>

                <label for="first_name" class="col-md-2" align="right">
                  Product Name:
                </label>
                <div class="form-group col-md-4">
                  <input type="text" name="mn" class="form-control" id="mn" data-bv-regexp="true" data-bv-regexp-message="Model number is required" pattern="[A-Za-z0-9'\.\-\s\,]$"autocopmlete="on" required value='<?= $p["model_number"]?>'>
                </div>
              </div>
              <label for="first_name" class="col-md-2" align="right">
                Re-Order QTY:
              </label>
              <div class="form-group col-md-4">
                <input type="text" name="roq" class="form-control" id="roq" data-bv-regexp="true" data-bv-regexp-message="Please enter Valid Quantity" pattern="^0*([1-9]|[1-8][0-9]|9[0-9]|[1-8][0-9]{2}|9[0-8][0-9]|99[0-9]|[1-8][0-9]{3}|9[0-8][0-9]{2}|99[0-8][0-9]|999[0-9]|10000)$"autocopmlete="on" required value='<?= $p["re_ord_qty"]?>'>
              </div>

              <label for="description" class="col-md-2" align="right">
                Description:
              </label>
              <div class="form-group col-md-4">
                <textarea name="des" class="form-control" id="des" data-bv-regexp="true" cols="30" rows="3" data-bv-regexp-message="Description is required" pattern="[A-Za-z0-9'\.\-\,]$" required value='' required style="resize:none;" ><?= $p["description"]?></textarea>
                
              </div>

            </div>
            <hr style="height:2px; background-color:#3c8dbc;"></hr>
            <div class="form-action" align="right">
            </br>
          </br>
          <input type="button" class="btn btn-primary" id="btnupdate" value="Update">
          <input type="button" value="Cancel" class="btn btn-danger btn-xl" id="btncancel" value="Reset">
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
      window.location.href = "product_list.php";
    });
     $("#scat").each(function(){ $(this).find('option[value="'+$(this).attr("value")+'"]').prop('selected', true)
      });

            $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
            $('#cfrm').data('bootstrapValidator').resetForm();
            $("#btnupdate").click(function(){//when the save button clicked the form data captured to following js variables
                $('#cfrm').bootstrapValidator('validate');//validate variable-'val'
                if ($('#cfrm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
                    $('#cfrm').bootstrapValidator('validate');//validate again for the confirmation

                    var pid = $("#p_id").val();
                    var sc = $("#scat").val();
                    var mno = $("#mn").val();
                    var roq = $("#roq").val();
                    var des = $("#des").val();
                    
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
                        url:"../handeler/pro_ctrl.php?type=update_product",
                        data:new FormData($("#cfrm")[0]),
                        processData:false,
                        contentType:false,
                        complete: function(data){
                          if(data.responseText =="Done"){
                            setTimeout(function() {
                              swal({
                                title:'Done!',
                                text: 'Product Details Was Successfully Updated!',
                                type: "success",
                                allowOutsideClick: false,
                                confirmButtonText: "OK"
                              }, function() {
                                window.location.href ="product_list.php";
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