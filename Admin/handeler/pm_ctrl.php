<?php
	include_once("../lib/c_add_payment.php");

		$apay=new apayment();
		$ty=$_GET['type'];
		$ty();

			function update_Pt(){
				global $apay;
					$apay->p_m_id= $_POST["pmid"];
					$apay->payment_method=$_POST["pt"];

					$apay->updatePt();
			}

			function deactive_pt(){
				global $apay;
					$apay->removePt($_GET['p_m_id']);
					header("location:../ui/new_payment.php");
			}

			function Active_pt(){
				global $apay;
					$apay->ActivePt($_GET['p_m_id']);
					header("location:../ui/new_payment.php");
			}
?>