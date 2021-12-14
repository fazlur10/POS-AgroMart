<?php
	include_once("../lib/c_cat.php");

	$cat=new category();

	$ty=$_GET['type'];
	$ty();


	function update_cat(){
		global $cat;
			$cat->cat_id=$_POST["cid"];
			$cat->cat=$_POST["ca"];
			$cat->updateCat();
	}

	function deactive_cat(){
		global $cat;
			$cat->removeCat($_GET['cat_id']);
			header("location:../ui/New_cat.php");
	}

	function Active_cat(){
		global $cat;
			$cat->ActiveCat($_GET['cat_id']);
			header("location:../ui/New_cat.php");
	}
?>