<?php
	include_once("../lib/c_cat.php");

		$cat=new category();
		$res=$cat->new_cid();

			$cat->cat_id=$res;
			$cat->cat=$_POST['ca'];

			$cat->reg_cat();
?>