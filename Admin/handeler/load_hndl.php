<?php
	if(isset($_POST['txtActMode'])){
		include_once("../lib/c_sub_cat.php");
			$s_cat=new scat();
			$x=$_POST['txtActMode'];

				if($x == 'load_drop'){
					$res=$s_cat->load_drop();
					echo json_encode($res);
				}
	}
?>