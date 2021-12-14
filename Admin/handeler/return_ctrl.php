<?php
	include_once("../lib/c_order.php");

		$or=new order();
		$ty=$_GET['type'];
		$ty();

			function return_pro(){
				global $or;
					$or->return_pro($_GET['cus_ord_no']);
					header("location:../ui/mod.ret.php");
			}
?>