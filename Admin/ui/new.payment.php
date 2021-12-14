<?php
    include_once("header.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div class="col-lg-4">
            <div class="title-action">
                <a href="#" class="btn btn-white"><i class="fa fa-pencil"></i> Edit </a>
                <a href="#" class="btn btn-white"><i class="fa fa-check "></i> Save </a>
                <a href="recipt_print.php" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Recipt </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="col-sm-6">
                            
                            
                        </div>

                        <div class="col-sm-6 text-right">
                            <h4>Invoice No.</h4>
                            
                            <p>
                                <span><strong>Invoice Date:</strong> Marh 18, 2014</span><br/>
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive m-t">
                        <table class="table invoice-table">
                            <thead>
                                <tr>
                                    <th>Item List</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                

                            </tbody>
                        </table>
                    </div><!-- /table-responsive -->

                    <table class="table invoice-total">
                        <tbody>
                            <tr>
                                <td><strong>Sub Total :</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>Discount:</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>Grand Total:</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>Amount:</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><strong>Balance:</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                    </div>

                    <div class="well m-t"><strong>Comments</strong>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>

<?php
    include_once("footer.php");
?>