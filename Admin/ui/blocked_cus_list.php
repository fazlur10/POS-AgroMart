<?php
    include("header.php");
        $dtm=date('Y-m-d / h:i:s a');
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <!--Available stock-->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Blocked Customer List</h5>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Adderess</th>
                                            <th>Contact Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include("../lib/c_reports.php");
                                                $re=new report;
                                                $c1=$re->view_blocked_cus();
                                                    if(!empty($c1)){
                                                        foreach ($c1 as $item) {
                                                            echo("<tr>
                                                                    <td>$item->f_name</td>
                                                                    <td>$item->l_name</td>
                                                                    <td>$item->address</td>
                                                                    <td>$item->contact_no</td>
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
<?php 
    include("footer.php");
?>
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
            "buttons":[
                {extend: 'pdf', title: 'Blocked Customer List - '+date,
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
                    messageTop:'<img src="img/Header.jpg" width="100%"><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Blocked Customer List Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Bright Computer Systems &copy; </p> </div>'
                }
            ]
        });
    });
</script>