<?php 
  include_once("header.php");
    $dtm=date('Y-m-d / h:i:s a');
?>
<!DOCTYPE html>
<html>
  <head>
  	<title></title>
  </head>
  <body>
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
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include("../lib/c_reports.php");
                        $re=new report();
                          $c1=$re->view_pro_list();
                            if(!empty($c1)){
                              foreach ($c1 as $item) {
                                echo (" <tr id='tr_$item->p_id'>
                                  <td>$item->p_id</td>
                                  <td>$item->sub_cat</td>
                                  <td>$item->model_number</td>
                                  <td>$item->description</td>
                                  <td>$item->re_ord_qty</td>
                                  <td>$item->state</td>
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
        var date = "<?= $dtm;?>";
        $('.dataTables-example').DataTable({//dataTables plugin
            "paging": true,
            "info": false,
            "sort": true,
            "responsive": true,
            "dom": 'Bfrtip',
            "order": [[0,"desc"]],
            "buttons": [
                {extend: 'pdf', title: 'Available Product List Report - '+date,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5]
                    }
                },
                {extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5]
                    },
                    text: 'Print',
                    title: ' ',
                    orientation:'Landscape',
                    messageTop:'<img src="img/Header.jpg" width="100%"><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Available Product List Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Bright Computer Systems &copy; </p> </div>'
                }
            ]
        });
    });
</script>
<?php
  include_once("footer.php");
?>