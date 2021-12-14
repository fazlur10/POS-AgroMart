<?php 
  include_once("header.php");
?>
<!DOCTYPE html>
<html>
  <head>
  	<title></title>
  </head>
  <body>
    <div class="form-action" align="right">
        <a href="Purchese_ord.php"><input type="button" class="btn btn-success" value="Purchese Order"></a>
        <a href="GRN.php"><input type="button" class="btn btn-success" value="GRN"></a>
        <a href="new_order.php"><input type="button" class="btn btn-success" value="Sales"></a>
    </div>
  	<!--Registered Customers List-->
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5>Available products</h5>
                <div class="ibox-tools">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-user">
                    <li>
                      <a href="#">Config option 1</a>
                    </li>
                    <li>
                      <a href="#">Config option 2</a>
                    </li>
                  </ul>
                  <a class="close-link">
                    <i class="fa fa-times"></i>
                  </a>
                </div>
              </div>
              <div class="ibox-content">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                      <tr>
                        <th>Product ID</th>
                        <th>Product Sub Category</th>
                        <th>Product Name</th>
                        <th>Product description</th>
                        <th>Re-Order Qty</th>
                        <th>State</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        include("../lib/c_add_product.php");
                          $pro=new product();
                          $c1=$pro->view_pro();
                            if(!empty($c1)){
                              foreach ($c1 as $item) {
                                echo (" <tr id='tr_$item->p_id'>
                                  <td>$item->p_id</td>
                                  <td>$item->sub_cat</td>
                                  <td>$item->model_number</td>
                                  <td>$item->description</td>
                                  <td>$item->re_ord_qty</td>
                                  <td>$item->state</td>
                                  <td>
                                  <span class='glyphicon glyphicon-edit text-primary' onclick='edit(\"$item->p_id\")'></span>
                                  <span class='glyphicon glyphicon-trash text-danger' onclick='del(\"$item->p_id\")'></span>
                                  <span class='glyphicon glyphicon-check text-success' onclick='act(\"$item->p_id\")'></span>
                                  </td>
                                  </tr>");
                              }
                            }
                      ?>
                    </tbody>
                  </table>
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
    $('.dataTables-example').DataTable({
      pageLength: 10,
      responsive: true,
      dom: '<"html5buttons"B>lTfgitp',
      buttons:[
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
  
  function edit(p_id) {
    swal({
      title: "Are you sure?",
      text: "Do You Really Want To Edit This Product Information!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#CCCC00",
      confirmButtonText: "Yes, Edit it!",
      closeOnConfirm: false
    },function () {
      window.location.href="update_product.php?p_id="+p_id;
    });
  }

  function del(p_id){
    swal({
      title: "Are you sure?",
      text: "Do You Really Want To Dactivate This product!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, Dactivate it!",
      closeOnConfirm: false
    },function () {
      window.location.href="../handeler/pro_ctrl.php?type=deactive_pro&p_id="+p_id;
    });
  }

  function act(p_id){
    swal({
      title: "Are you sure?",
      text: "Do You Really Want To Activate This product!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#00FA9A",
      confirmButtonText: "Yes, Activate it!",
      closeOnConfirm: false
    },function () {
      window.location.href="../handeler/pro_ctrl.php?type=Active_pro&p_id="+p_id;
    });
  }
</script>
<?php
  include_once("footer.php");
?>