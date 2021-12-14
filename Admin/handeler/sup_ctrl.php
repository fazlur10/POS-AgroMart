<?php
	include_once("../lib/c_supplier.php");
	include_once("../lib/c_user.php");

		$sup=new supplier();
		$ty=$_GET['type'];
		$ty();

			function update_supplier(){
				global $sup;
					$sup->sup_id=$_POST["sup_id"];
					$sup->sup_name=$_POST["s_n"];
					$sup->comp_name=$_POST["c_n"];
					$sup->comp_addr=$_POST["c_addr"];
					$sup->contact=$_POST["con"];
					
					$sup->updateSupplier();
					header("location:../ui/sup_mng.php");
			}

			function deactive_sup(){
				global $sup;
					$sup->removeSup($_GET['sup_id']);
					header("location:../ui/sup_mng.php");
			}

			function Active_sup(){
				global $sup;
					$sup->ActiveSup($_GET['sup_id']);
					header("location:../ui/sup_mng.php");
			}
?>