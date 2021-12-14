<?php
	include_once("../lib/c_sub_cat.php");

		$sc =new scat();
		$ty=$_GET['type'];
		$ty();

			function update_Scat(){
				global $sc;
					$sc->cat_id= $_POST["cate"];
					$sc->sub_cat= $_POST["s_c"];
					$sc->sub_cat_id= $_POST["s_c_id"];
					
					$sc->updateScat();
			}

			function deactive_Scat(){
				global $sc;
					$sc->removeS($_GET['sub_cat_id']);
					header("location:../ui/New_sub_cat.php");
			}

			function Active_Scat(){
				global $sc;
					$sc->ActiveS($_GET['sub_cat_id']);
					header("location:../ui/New_sub_cat.php");
			}
?>