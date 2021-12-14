<?php
	include_once("../lib/c_order.php");
	include_once("../lib/c_add_product.php");

		if(isset($_GET["type"])){
			$type = $_GET["type"];
			
			switch ($type) {
				case 'insert':
					insert();
					break;
				case 'onchange':
					get_p_id();
					break;
				case 'onchangeSub':
					// echo "f1";
					get_model();
					break;
			}
		}

		function get_p_id(){
			
			$obj=new product();
			$res = $obj->load_by_id($_GET["pro"]);
			echo json_encode($res);
		}
		function get_model(){
			// echo('test');
			$obj=new product();
			$res = $obj->get_ItemsbySubcat($_GET["subc"]);
			echo json_encode($res);
		}
		
	$or=new order();
	$res=$or->order_id();

		if($_GET['type']=='add_ord_info'){
			$or->cus_ord_no=$res;
			$or->cus_id=$_POST['cus'];
			$or->order_type=$_POST['otype'];
			$or->add_cus_order();

			$or->cus_ord_no=$res;
			$or->p_id=$_POST['pro'];
			$or->itm_code=$_POST['code'];
			$or->itm_qty=$_POST['qty'];
			$or->sel_pri=$_POST['sp'];
			$or->sub_tot=$_POST['sbt'];
			$feedback =$or->add_ord_info();
			
			$or->cus_ord_no=$res;
			$or->gtot=$_POST['gtot'];
			$or->dis=$_POST['dis'];
			$or->ntot=$_POST['nt_amt'];
			$or->amt=$_POST['amount'];
			$or->bal=$_POST['bal'];
			$or->p_m_id=$_POST['c'];
			$or->make_payment();
			
			$or->p_id=$_POST['pro'];
			$or->qty=$_POST['qty'];
			if($feedback =="Done"){
				$or->update_stock2($res);
			}
		}
		else if($_GET['type']=='getNotifyCount'){
            $or->getNotifyCount();
        }
        else if($_GET['type']=='getNotifyDetails'){
            $or->getNotifyDetails();
        }
        else if($_GET['type']=='getMonthWiseOrders'){
            $or->getMonthWiseOrders();
        }
        else if($_GET['type']=='getMonthWiseSales'){
            $or->getMonthWiseSales();
        }
?>