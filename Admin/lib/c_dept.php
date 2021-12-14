<?php
	include_once("dbConnection.php");
	
	include_once("c_email.php");
	
	if ($_POST) {
		$cus_id=$_POST['cus_id'];
	    $pay=$_POST['pay_bal'];
		
		$sql ="SELECT tbl_payment.bal,tbl_payment.cus_ord_no FROM tbl_cus_ord 
		LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id 
		LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no 
		WHERE tbl_customer.cus_id='$cus_id' AND tbl_payment.bal > 0 ORDER BY tbl_payment.cus_ord_no";
		
		$r= mysqli_query($con,$sql);
		while ($pay>0 &&  $row = mysqli_fetch_array($r))
		{
			$OrderId = $row['cus_ord_no'];
			if ($pay <= $row['bal'])
			{
				$sql2 = "UPDATE tbl_payment
			           		SET bal=bal-$pay, amt =amt+$pay
			           		WHERE cus_ord_no='$OrderId'";
							mysqli_query($con,$sql2);
				$pay =0;
				
			}
			else
			{
				$temp = $row['bal'];
				$sql3 = "UPDATE tbl_payment
			           		SET bal=0, amt =ntot
			           		WHERE cus_ord_no='$OrderId'";
							mysqli_query($con,$sql3);
							$pay = $pay-$temp;
							
			}
		}
	}
		
		//$result1 = mysqli_query("select count(1) FROM tbl_payment");
        //$rowcount = mysqli_fetch_array($result1);
		
		/*$sql="SELECT * from tbl_payment";

  if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
 
  }

				  for ($x = 0; $x < $rowcount; $x++)
                    {
						$TempBal = $pay_bal;
                        $Cid = $cus_id;
				  while ($TempBal > 0)
                        {
							$sqlSearch= "SELECT tbl_payment.cus_ord_no, tbl_payment.bal 
							FROM tbl_cus_ord LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id 
							LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no 
							WHERE tbl_customer.cus_id='$Cid' AND tbl_payment.bal > 0 ORDER BY tbl_payment.cus_ord_no ASC LIMIT 1";
							
                            $result = $con-> query($sqlSearch);
							
		 				while($row = $result->fetch_assoc()){
							$OrderId = $row['cus_ord_no'];
							$Balance = $row['bal'];
					 	}
						
						if ($Balance > $TempBal)
                            {
                                $Balance = $Balance - $TempBal;
                                $TempBal = 0;
                            }
                            else
                            {
                                $TempBal = $TempBal - $Balance;
                                $Balance = 0;
                            }
					 	$sql2 = "UPDATE tbl_payment
			           		SET bal=$Balance
			           		WHERE cus_ord_no='OrderId'"; 	
			}	
						}
				if ($con->query($sql2)===true) {     
		  # code...     
		  header("Location:../ui/dept_details.php?msg=s"); 
		  } 
		  else{ 
 
          header("Location:../ui/dept_details.php?msg=f"); 
 
} 

				}	*/
	
	
	
			
	?>
	<script>
    var str1 = '../ui/dept_details.php';
    window.location.href = str1;
    </script>