<?php
	include_once("../lib/c_add_payment.php");

		$apay=new apayment();
		$res=$apay->new_p_m_id();

			$apay->p_m_id=$res;
			$apay->payment_method=$_POST['ap'];

			$apay->add_npay();
?>