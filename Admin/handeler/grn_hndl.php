<?php
	/*import the GRN Class*/
	include_once("../lib/c_grn.php");

		$gr=new grn();//Create GRN Object//
		$res=$gr->grn_no();//Call to grn_no function//

			/*check the type and catch the varibles form fornt end and pass the data into different functions into the class */ 
			if($_GET['type'] == "add_grn"){
				$gr->grn_no=$res;
				$gr->po_no=$_POST['pon'];
				$gr->grn_date=$_POST['txtdate'];
				$gr->ref_no=$_POST['ref'];
				$gr->sup_id=$_POST['sup'];
				$gr->add_grn();

				$gr->grn_no=$res;
				$gr->p_id=$_POST['pro'];
				$gr->qty=$_POST['qty'];
				$gr->unit_pri=$_POST['up'];
				$gr->sel_pri=$_POST['sp'];
				$feedback = $gr->add_pro_grn();

				$gr->p_id=$_POST['pro'];
				$gr->qty=$_POST['qty'];
				if($feedback == "Done"){
					$gr->update_stock($res);
				}

				$gr->p_id=$_POST['pro'];
				$gr->sel_pri=$_POST['sp'];
				$gr->update_sell_pri();
			}		
?>