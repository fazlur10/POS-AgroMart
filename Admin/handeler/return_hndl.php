<?php
	include_once("../lib/c_return.php");

		$re=new return_itm();
		$res=$re->return_id();
			if($_GET['type'] == 'return_itm_details'){
			    $ic=$_GET['ic'];
			    $re->get_bill_details($ic);
			}
			else if($_GET['type'] == 'return_i'){
			    $re->return_id=$res;
			    $re->r_date=$_POST['dte'];
			    $re->cus_ord_no=$_POST['ono'];
			    $re->remark=$_POST['re'];
			    $re->return_itm();    
			    
			    $re->itm_code=$_POST['icode'];
			    $re->return_itm_details();

			    $re->return_id=$res;
			    $re->reason=$_POST['res'];
			    $re->p_id=$_POST['p_id'];
			    $re->cus_ord_no=$_POST['ono'];
			    $re->return_itm_info();
			}
			else if($_GET['type'] == 'return_up'){
				$re->p_id=$_POST['p_id'];
			    $re->qty=$_POST['qty'];
			    $re->promo_price=$_POST['sp'];
			    $re->cus_ord_no=$_POST['onu'];
			    $re->add_return();
			    // $feedback = $re->add_return();

				// $re->p_id=$_POST['p_id'];
				// $re->qty=$_POST['qty'];
				// if($feedback == "Done"){
				// 	$re->update_stock($res);
				// }
			}     
?>