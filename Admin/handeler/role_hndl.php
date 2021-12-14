<?php
	include_once("../lib/c_role.php");
		$rol=new role();

			$rol->role_id=$_POST['rid'];
			$rol->role_name=$_POST['ro'];

			$rol->add_role();
?>