<?php
	include_once("../lib/c_customer.php");
	include_once("../lib/c_user.php");
	

		$cus=new customer();
		$ty=$_GET['type'];
		$ty();

			function update_customer(){
				global $cus;
					$cus->cus_id= $_POST["cus_id"];
					$cus->first_name=$_POST["f_name"];
					$cus->last_name=$_POST["l_name"];
					$cus->address=$_POST["adr"];
					$cus->contact_no=$_POST["con_n"];
					$cus->updateCustomer();
			}

			function deactive_cus(){
				global $cus;
					$cus->removeCus($_GET['cus_id']);
					header("location:../ui/Customer_mng.php");
			}

			function Active_cus(){
				global $cus;
					$cus->ActiveCus($_GET['cus_id']);
					header("location:../ui/Customer_mng.php");
			}
			
			function update_dept(){
				global $cus;
					$cus->cus_id= $_POST["cus_id"];
					$cus->pay_bal=$_POST["pay_bal"];
					
					$cus->updateDept();
			}
?>