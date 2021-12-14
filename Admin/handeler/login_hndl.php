<?php
	include_once("../lib/c_user.php");
		$usr=new user();
			if($_GET["type"] == "user_login"){
				$usr=new user();
				$usr->email = $_POST['email'];
				$usr->password = $_POST['password'];
				$usr->user_login();
			}
?>