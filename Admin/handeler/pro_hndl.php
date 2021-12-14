<?php
	include_once("../lib/c_add_product.php");
		if(isset($_GET['type'])){
			$type=$_GET['type'];
			switch ($type){
				case "onchangep":
					$obj=new product();
					$x=$_GET['id'];
					$res=$obj->get_sub_by_cid($x); 
					echo json_encode($res);
					break;

				case "add":
					$pro=new product();
					$res2=$pro->pid();

					$pro->p_id=$res2;
					$pro->sub_cat_id=$_POST['scat'];
					$pro->model_number=$_POST['mn'];
					$pro->description=$_POST['des'];
					$pro->re_ord_qty=$_POST['roq'];
					

					$pro->add_pro();
					break;
				
				default:

			}
		}
?>