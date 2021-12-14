<?php
  include("header.php");
  include_once("../lib/c_add_product.php");

    $pro=new product();
    $res2=$pro->pid();
?>
<script>
  $(document).ready(function(){
    $('#cfrm').bootstrapValidator({
      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons:{
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
                <h1>Add product</h1>
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
                      <label for="first_name" class="col-md-2" align="right" style="display:none">
                        Product ID:
                      </label>
                      <div class="form-group col-md-4" style="display:none">
                        <input type="text" readonly="" name="p_id" class="form-control" id="p_id" value="<?php echo($res2); ?>">
                      </div>

                      <label for="j_role" class="col-md-2" align="right">
                        Category:<div class="col-lg-2"><a href="New_cat.php"><i class="fa fa-plus fa-2x"></a></i></div>
                      </label>
                      <div class="form-group col-md-4">
                        <select name="cat" class="form-control" id="cat">
                          <option>Select</option>
                            <?php
                              include_once("../lib/c_add_product.php");
                              $pro=new product();
                              $res=$pro->load_cat();
                            ?>  
                        </select>
                        </br>
                    </div>

                    <div class="row">
                      <label for="j_role" class="col-md-2" align="right">
                        Sub Category:<div class="col-lg-2"><a href="New_sub_cat.php"><i class="fa fa-plus fa-2x"></a></i></div>
                      </label>
                      <div class="form-group col-md-4">
                        <select name="scat" class="form-control" id="scat">
                          <option>Select</option> 
                        </select></br>
                      </div>
                    </div>

                    <div class="row">          
                      <label for="first_name" class="col-md-2" align="right">
                        Product Name:
                      </label>
                      <div class="form-group col-md-4">
                        <input type="text" name="mn" class="form-control" id="mn" data-bv-regexp="true" data-bv-regexp-message="Model number is required" pattern="[A-Za-z0-9'\.\-\s\,]$"autocopmlete="on" required/>
                      </div>

                      <label for="first_name" class="col-md-2" align="right">
                        Re-Order QTY:
                      </label>
                      <div class="form-group col-md-4">
                        <input type="text" name="roq" class="form-control" id="roq" data-bv-regexp="true" data-bv-regexp-message="Please enter Valid Quantity" pattern="^0*([1-9]|[1-8][0-9]|9[0-9]|[1-8][0-9]{2}|9[0-8][0-9]|99[0-9]|[1-8][0-9]{3}|9[0-8][0-9]{2}|99[0-8][0-9]|999[0-9]|10000)$"autocopmlete="on" required/>
                      </div>
                    </div>

                    <div class="row">
                      <label for="first_name" class="col-md-2" align="right">
                        Description:
                      </label>
                      <div class="form-group col-md-4">
                        <textarea name="des" class="form-control" id="des" data-bv-regexp="true" cols="80" rows="5" data-bv-regexp-message="Description is required" pattern="[A-Za-z0-9'\.\-\,]$" required style="resize:none;"></textarea>
                      </div>

                      <label for="e_img" class="col-md-2">
                        Product image:
                      </label>
                      <div class="form-group col-md-4">
                        <input type="file" name="e_img" id="e_img"></br>
                        <strong>Note : PNG and JPEG only</strong>
                      </div>
                    </div>
                    <hr style="height:2px; background-color:#3c8dbc;"></hr>
                    <div class="form-action" align="right">
                    </br>
                    </br>
                    <div>  
                      <input type="button" class="btn btn-primary" id="btn_s" value="Add">
                      <input type="button" value="Cancel" class="btn btn-danger btn-xl" id="btn_r" value="Reset">
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
  $("#cat").change(function(){
    var cat=$("#cat").val();
    $.get("../handeler/pro_hndl.php?type=onchangep&id="+cat,function(data){
      var result = JSON.parse(data);
      var i;
      $("#scat").html('');
      $('#scat').append($('<option>').text("Select"));
        if(result.length>0){
          for(i=0;i<result.length;i++){
            var sub_cat_id = result[i].sub_cat_id;
            var sub_cat=result[i].sub_cat;                
            $("#scat").append('<option value="'+sub_cat_id+'">'+sub_cat+'</option>');

          }
        } 
        else{
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
                  url:"../handeler/pro_hndl.php?type=add",
                  data:new FormData($("#cfrm")[0]),
                  processData:false,
                  contentType:false,
                  complete: function(data){
                    if(data.responseText == "Done"){
                      setTimeout(function() {
                        swal({
                          title: 'Done!',
                          text: 'Successfully Added!',
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
    $("#btn_r").click(function(){
      $('#cfrm').data('bootstrapValidator').resetForm();
    });
  });
</script>
<?php 
  include("footer.php");
?>