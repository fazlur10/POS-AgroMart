<?php
	include_once("../lib/c_role.php");

		$rol=new role();
		$ty=$_GET['type'];
		$ty();

			function update_role(){
				global $rol;
					$rol->role_id=$_POST["rid"];
					$rol->role_name=$_POST["ro"];
					$rol->updaterole();
			}

			function deactive_role(){
				global $rol;
					$rol->removerole($_GET['role_id']);
					header("location:../ui/New_role.php");
			}

			function Active_role(){
				global $rol;
					$rol->Activerole($_GET['role_id']);
					header("location:../ui/New_role.php");
			}
?>