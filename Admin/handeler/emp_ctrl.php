<?php

	include_once("../lib/c_employee.php");
	include_once("../lib/c_user.php");

		$emp=new employee();
		$ty=$_GET['type'];
		$ty();

			function update_emp(){
				global $emp;
					$emp->role_id=$_POST["rol"];
					$emp->emp_id= $_POST["e_id"];
					$emp->emp_name=$_POST["e_name"];
					$emp->addr=$_POST["adr"];
					$emp->cont=$_POST["con_n"];

					$emp->updateEmp();
					header("location:../ui/emp_mng.php");
			}

			function deactive_emp(){
				global $emp;
					$emp->removeEmp($_GET['emp_id']);
					header("location:../ui/emp_mng.php");
			}

			function Active_emp(){
				global $emp;
					$emp->ActiveEmp($_GET['emp_id']);
					header("location:../ui/emp_mng.php");
			}
?>