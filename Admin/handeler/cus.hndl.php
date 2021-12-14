<?php
	include_once("../lib/c_customer.php");
	include_once("../lib/c_user.php");

		$usr=new user();
		$res=$usr->new_uid();
		$cus=new customer();
		$res1=$cus->new_cus_id();


		if($_GET['type'] == 'reg_cus')

			$usr->u_id=$res;
			$usr->email=$_POST['mail'];
			$usr->pwd=md5($_POST['pass_confirmation']);
			$usr->conpwd=md5($_POST['pass']);
			$usr->user_type=$_POST['ut'];

			if($usr->validate_duplicate_email()===FALSE)
			{
				echo "duplicate_email";
				exit();
			}

			$usr->reg_userCus();

			$cus->cus_id=$res1;
			$cus->u_id=$res;
			$cus->f_name=$_POST['fi_name'];
			$cus->l_name=$_POST['la_name'];
			$cus->address=$_POST['adr'];
			$cus->contact_no=$_POST['con_n'];
			$cus->email = $_POST['mail'];
			$cus->reg_cus();
?>