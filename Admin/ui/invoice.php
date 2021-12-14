<?php
    include("header.php");
    include_once("../lib/c_order.php");


        if (isset($_GET["id"])) {
            $cus_ord_no=$_GET["id"];
    
            $or=new order();
            $i=$or->getdetails_for_bill($cus_ord_no);
        }
            $today = date('Y-m-d');
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <img src="img/Header.png" width="1100px" height="150px" align="center">
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>From:</h5>
                                    <address>
                                        <strong>M.S.M. Agro Mart
                                        .</strong><br>
                                        No 440/2 Katupotha Road,<br>
                                        Pahamune<br>
                                        <abbr title="Phone"></abbr> (077) 467-8849
                                    </address>
                                </div>
                            </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>Product Description</th>
                                        <th>Unit Price</th>
                                        <th>QTY</th>
                                        <th>Sub Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include_once("../lib/c_order.php");
                                                $or=new order();
                                                $c2=$or->get_bill_details($cus_ord_no);

                                                if(!empty($c2)){
                                                    foreach ($c2 as $item){
                                                        echo("<tr id='tr_$item->p_id'>
                                                                <td>$item->model_number</td>
                                                                <td>$item->sel_pri</td>
                                                                <td>$item->itm_qty</td>
                                                                <td>$item->sub_tot</td>
                                                            </tr>");
                                                    }
                                                }
                                        ?>
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->
                            <table class="table invoice-total">
                                <tbody>
                                    <tr>
                                        <td><strong>Grand Total :</strong></td>
                                        <td><?=$i['gtot']?></td>
                                    </tr>

                                    <tr>
                                        <td><strong>Discount :</strong></td>
                                        <td><?=$i['dis']?> %</td>
                                    </tr>

                                    <tr>
                                        <td><strong>Net Total:</strong></td>
                                        <td><?=$i['ntot']?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>Paid Amount:</strong></td>
                                        <td><?=$i['amt']?></td>
                                    </tr>

                                    <tr>
                                        <td><strong>Balance:</strong></td>
                                        <td><?=$i['bal']?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <img src="img/Footer.png" width="1000px">
                </div>
            </div>
    </body>
</html>

<?php 
    include("footer.php");
?>
<script>
    $(document).ready(function(){
        var date = "<?= $today;?>";
        $('.dataTables-example').DataTable({//dataTables plugin
            "paging": true,
            "info": false,
            "sort": true,
            "responsive": true,
            "dom": 'Bfrtip',
            "order": [[0,"desc"]],
            "buttons": [
                {extend: 'pdf', title: 'Active Customer List - '+date,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3]
                    }
                },
                {extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3]
                    },
                    text: 'Print',
                    title: ' ',
                    orientation:'Landscape',
                    messageTop:'<img src="img/Header.png" width="100%"><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Active Customer List Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Bright Computer Systems &copy; </p> </div>'
                }
            ]
        });
    });
</script>

<script>
    $(document).ready(function(){
        window.print();
        setTimeout("closePrintview()",20000);
    });
    // function closePrintview(){
    //     document.location.href="order_history.php";
    // }
</script>

