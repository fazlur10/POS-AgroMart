<?php
	include_once("../lib/c_purchese_ord.php");

		$po=new pur();
		$ty=$_GET['type'];
		$ty();

			function update_po(){
				global $po;
					$po->po_no=$_POST["pon"];
					$po->po_date=$_POST["or_d"];
					$po->sup_id=$_POST["sup"];
					$po->ship_date=$_POST["sd"];
					$po->updatePo();

					$po->po_no=$_POST["pon"];
					$po->p_id=$_POST["pro"];
					$po->qty=$_POST["qty"];
					$po->update_itm_po();
			}

			function deactive_po(){
				global $po;
					$po->removePo($_GET['po_no']);
					header("location:../ui/GRN_list.php");
			}

			function Active_po(){
				global $po;
					$po->ActiveCus($_GET['cus_id']);
					header("location:../ui/view_Purchese_ord.php");
			}
?>