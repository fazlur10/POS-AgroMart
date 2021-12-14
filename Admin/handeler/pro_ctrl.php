<?php
	include_once("../lib/c_add_product.php");

		$pro=new product();
		$ty=$_GET['type'];
		$ty();

			function update_product(){
				global $pro;
					$pro->p_id= $_POST["p_id"];
					$pro->sub_cat_id=$_POST["scat"];
					$pro->model_number=$_POST["mn"];
					$pro->re_ord_qty=$_POST["roq"];
					$pro->description=$_POST["des"];

					$pro->updateProduct();
			}

			function deactive_pro(){
				global $pro;
					$pro->removePro($_GET['p_id']);
					header("location:../ui/product_list.php");
			}

			function Active_pro(){
				global $pro;
					$pro->ActivePro($_GET['p_id']);
					header("location:../ui/product_list.php");
			}
?>