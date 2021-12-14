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
        <!--Walk-in Orders List-->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h1>Dept Details</h1>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a></li>
                                    <li><a href="#">Config option 2</a></li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="walkinOrdTbl">
                                    <thead>
                                    <tr>
									    <th>Customer ID</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Grand Total</th>
                                       
                                        <th>Net Total</th>
										 <th>Paid Amount</th>
										<th> Balance </th>
										<th> Pay Balance </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include_once("../lib/c_order.php");
                                    $or=new order();
                                    $c1=$or->view_dept_orders();
                                    if(!empty($c1)){
                                        foreach ($c1 as $item) {
											$cid= $item->dcus_id;
											$amt= $item->dntot-$item->dbal;
                                            echo("<tr>
                                                <td>$item->dcus_id</td>
                                                <td>$item->df_name</td>
                                                <td>$item->dl_name</td>
                                                <td>$item->dgtot</td>
                                                
                                                <td>$item->dntot</td>
												<td>$amt</td>
												<td>$item->dbal</td>
												<td width='50px'> ");
												if ($item->dbal>0)
												{echo ("
												<a href='update_dept.php?c_id=".$cid."'><button type='button' class='btn btn-primary btn-sm'> Pay </button></a></td>
															
                                            </tr>");
												}
												else
													{echo ("
												<a href='update_dept.php?c_id=".$cid."'><button type='button' class='btn btn-primary btn-sm' disabled> Pay </button></a></td>
															
                                            </tr>");
												}
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

<?php
    include("footer.php");
?>

<script>
    $(document).ready(function(){
        var date = "<?= $dtm;?>";
        $('#walkinOrdTbl').DataTable({//dataTables plugin
            "paging": true,
            "info": false,
            "sort": true,
            "responsive": true,
            "dom": 'Bfrtip',
            "order": [[0,"desc"]],
            "buttons":[
                {extend: 'pdf', title: 'Walk-in Order Report - '+date,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6,7]
                    }
                },
                {extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6,7]
                    },
                    text: 'Print',
                    title: ' ',
                    orientation:'Landscape',
                    messageTop:'<img src="img/Header.jpg" width="100%"><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Walk-in Order Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Bright Computer Systems &copy; </p> </div>'
                }
            ]
        });
    });
</script>
