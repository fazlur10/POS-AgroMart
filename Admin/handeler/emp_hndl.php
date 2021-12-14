<?php
	include_once("../lib/c_employee.php");
	include_once("../lib/c_user.php");

		$usr=new user();
		$res=$usr->new_uid();
		$emp=new employee();
		$res1=$emp->emp_id();

			if($_GET['type']=='reg_emp')
				$usr->u_id=$res;
				$usr->email=$_POST['mail'];
				$usr->pwd=md5($_POST['pass_confirmation']);
				$usr->conpwd=md5($_POST['pass']);
				$usr->user_type=$_POST['ut'];

				$usr->reg_userEmp();

				$emp->emp_id=$res1;
				$emp->u_id=$res;
				$emp->emp_name=$_POST['e_name'];
				$emp->addr=$_POST['adr'];
				$emp->cont=$_POST['con_n'];
				$emp->role_id=$_POST['rol'];		

				$emp->reg_emp();
?>
