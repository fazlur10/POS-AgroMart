<?php
	include_once("../lib/c_purchese_ord.php");
		$po=new pur();
		$res2=$po->poid();

			$po->po_no=$res2;
			$po->sup_id=$_POST['sup'];
			$po->po_date=$_POST['or_d'];
			$po->ship_date=$_POST['sd'];

			$po->new_po();

			$po->po_no=$res2;
			$po->p_id=$_POST['pro'];
			$po->qty=$_POST['qty'];

			$po->add_pur_itm();
?>