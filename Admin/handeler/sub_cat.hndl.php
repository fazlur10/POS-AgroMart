<?php
	include_once("../lib/c_sub_cat.php");
		$sc=new scat();
		$res2=$sc->new_sid();

			$sc->cat_id=$_POST['cata'];//cat id
			$sc->sub_cat=$_POST['s_c'];//sub cat name catch
			$sc->sub_cat_id=$res2;//sub cat id catch

			$sc->add_sub_cat();
?>