<?php
	include_once("../lib/c_supplier.php");
	include_once("../lib/c_user.php");

		$usr=new user();
		$res=$usr->new_uid();
		$sup=new supplier();
		$res1=$sup->new_sid();

			if($_GET['type']=='reg_sup')
				$usr->u_id=$res;
				$usr->email=$_POST['mail'];
				$usr->pwd=md5($_POST['pass_confirmation']);
				$usr->conpwd=md5($_POST['pass']);
				$usr->user_type=$_POST['ut'];

				$usr->reg_userSup();

				$sup->sup_id=$res1;
				$sup->u_id=$res;
				$sup->sup_name=$_POST['s_n'];
				$sup->comp_name=$_POST['c_n'];
				$sup->comp_addr=$_POST['c_addr'];
				$sup->contact=$_POST['con'];

				$sup->reg_sup();
?>
