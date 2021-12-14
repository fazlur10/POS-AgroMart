<?php
	include_once("db_con.php");
	
		class report{
			public $cat_id;
			public $cat;
			public $sub_cat_id;
			public $sub_cat;
			public $sup_id;
			public $sup_name;
			public $p_id;
			public $model_number;
			public $description;
			public $re_ord_qty;
			public $return_status;
			public $sell_price;
			public $state;
			public $grn_no;
			public $stock_no;
			public $grn_date;
			public $ref_no;
			public $itm_des;
			public $unit_pri;
			public $sel_pri;
			public $qty;
			public $tot_qty;
			public $po_no;

			public $db;

				function __construct(){
					$this->db=new mysqli(server,user,pass,db);
				}

				function view_pro_list(){
					$sql="SELECT tbl_product.p_id,tbl_subcat.sub_cat,tbl_product.model_number,tbl_product.description,tbl_product.re_ord_qty,tbl_product.state 
						  FROM tbl_product 
						  LEFT JOIN tbl_subcat ON tbl_product.sub_cat_id=tbl_subcat.sub_cat_id 
						  WHERE tbl_product.state='Active'";

					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){

							$re= new report();
							$re->p_id=$row['p_id'];
							$re->sub_cat=$row['sub_cat'];
							$re->model_number=$row['model_number'];
							$re->description=$row['description'];
							$re->re_ord_qty=$row['re_ord_qty'];
							$re->state=$row['state'];

							$ar[]=$re;
						}

							return $ar;
				}

				function view_stock(){

					$sql="SELECT pro_grn.p_id,tbl_product.model_number,tbl_product.tot_qty,tbl_product.re_ord_qty
						  FROM pro_grn
						  LEFT JOIN tbl_product ON  pro_grn.p_id=tbl_product.p_id
						  GROUP BY p_id";

					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){

							$re=new report();
							$re->p_id=$row['p_id'];
							$re->model_number=$row['model_number'];
							$re->tot_qty=$row['tot_qty'];
							$re->re_ord_qty=$row['re_ord_qty'];
							$ar[]=$re;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function view_pro_by_cat(){

					$sql="SELECT tbl_subcat.sub_cat,tbl_product.model_number
						  FROM tbl_product
						  LEFT JOIN tbl_subcat ON tbl_product.sub_cat_id=tbl_subcat.sub_cat_id";

					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){

							$re=new report();
							$re->model_number=$row['model_number'];
							$re->sub_cat=$row['sub_cat'];
							$ar[]=$re;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function view_active_cus(){
					$sql="SELECT f_name,l_name,address,contact_no
						  FROM tbl_customer
						  WHERE user_status='Active'";

					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){

							$re=new report();
							$re->f_name=$row['f_name'];
							$re->l_name=$row['l_name'];
							$re->address=$row['address'];
							$re->contact_no=$row['contact_no'];
							$ar[]=$re;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function view_blocked_cus(){
					$sql="SELECT f_name,l_name,address,contact_no
						  FROM tbl_customer
						  WHERE user_status='Blocked'";

					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){

							$re=new report();
							$re->f_name=$row['f_name'];
							$re->l_name=$row['l_name'];
							$re->address=$row['address'];
							$re->contact_no=$row['contact_no'];
							$ar[]=$re;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function view_deleted_cus(){
					$sql="SELECT f_name,l_name,address,contact_no
						  FROM tbl_customer
						  WHERE user_status='Deleted'";

					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){

							$re=new report();
							$re->f_name=$row['f_name'];
							$re->l_name=$row['l_name'];
							$re->address=$row['address'];
							$re->contact_no=$row['contact_no'];
							$ar[]=$re;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function return_by_date($sdate, $edate){

					$sql="SELECT tbl_return.*,tbl_return_items.*,tbl_product.model_number
						  FROM tbl_return
						  LEFT JOIN tbl_return_items ON tbl_return.return_id=tbl_return_items.return_id
						  LEFT JOIN tbl_product ON tbl_return_items.p_id=tbl_product.p_id
						  WHERE tbl_return.r_date BETWEEN '$sdate' AND '$edate'";

					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){
							$re=new report();
							$re->return_id=$row['return_id'];
							$re->model_number=$row['model_number'];
							$ar[]=$re;
							}
							if(!empty($ar)){
								return $ar;
							}
							else{
								echo"No Records Found!";
							}
					}

				function return_by_product($p_id){
					$sql="SELECT tbl_product.*,tbl_return_items.*,tbl_return.*
						  FROM tbl_return
						  LEFT JOIN  tbl_return_items ON tbl_return.return_id=tbl_return_items.return_id
						  LEFT JOIN tbl_product ON tbl_return_items.p_id=tbl_product.p_id
						  WHERE tbl_return_items.p_id='$p_id'";

					$ref=$this->db->query($sql);
							while($row=$ref->fetch_array()){
								$re=new report();
								$re->return_id=$row['return_id'];
								$re->model_number=$row['model_number'];
								$ar[]=$re;
								}
								if(!empty($ar)){
									return $ar;
								}
								else{
									echo"No Records Found!";
								}
				}

				function return_product(){
					$sql="SELECT tbl_product.*,tbl_return_items.*,tbl_return.*
						  FROM tbl_return
						  LEFT JOIN  tbl_return_items ON tbl_return.return_id=tbl_return_items.return_id
						  LEFT JOIN tbl_product ON tbl_return_items.p_id=tbl_product.p_id";
						  
					$ref=$this->db->query($sql);
							while($row=$ref->fetch_array()){
								$re=new report();
								$re->return_id=$row['return_id'];
								$re->model_number=$row['model_number'];
								$ar[]=$re;
								}
								if(!empty($ar)){
									return $ar;
								}
								else{
									echo"No Records Found!";
								}
				}

				function return_by_cus($cus_id){
					$sql="SELECT tbl_customer.*,tbl_cus_ord.*,tbl_return.*
						  FROM tbl_return
						  LEFT JOIN  tbl_cus_ord ON tbl_return.cus_ord_no=tbl_cus_ord.cus_ord_no
						  LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id
						  WHERE tbl_cus_ord.cus_id='$cus_id'";
					$ref=$this->db->query($sql);

						  	while($row=$ref->fetch_array()){
								$re=new report();
								$re->return_id=$row['return_id'];
								$re->f_name=$row['f_name'];
								$re->l_name=$row['l_name'];
								$re->ordate=$row['ordate'];
								$re->order_type=$row['order_type'];
								$re->r_date=$row['r_date'];
								$re->cus_ord_no=$row['cus_ord_no'];
								$ar[]=$re;
								}
								if(!empty($ar)){
									return $ar;
								}
								else{
									echo"No Records Found!";
								}
				}

				function return_cus(){
					$sql="SELECT tbl_customer.*,tbl_cus_ord.*,tbl_return.*
						  FROM tbl_return
						  LEFT JOIN  tbl_cus_ord ON tbl_return.cus_ord_no=tbl_cus_ord.cus_ord_no
						  LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id";

						$ref=$this->db->query($sql);
						
						  	while($row=$ref->fetch_array()){
								$re=new report();
								$re->return_id=$row['return_id'];
								$re->f_name=$row['f_name'];
								$re->l_name=$row['l_name'];
								$re->ordate=$row['ordate'];
								$re->order_type=$row['order_type'];
								$re->r_date=$row['r_date'];
								$re->cus_ord_no=$row['cus_ord_no'];
								$ar[]=$re;
							}
								if(!empty($ar)){
									return $ar;
								}
								else{
									echo"No Records Found!";
								}
				}

				function po_by_date($sdate, $edate){
					$sql="SELECT tbl_product.model_number,tbl_po_items.*,tbl_pur_ord.*,tbl_supplier.comp_name 
					      from tbl_product 
					      LEFT JOIN tbl_po_items ON tbl_product.p_id=tbl_po_items.p_id 
					      LEFT JOIN tbl_pur_ord ON tbl_po_items.po_no=tbl_pur_ord.po_no 
					      LEFT JOIN tbl_supplier ON tbl_pur_ord.sup_id=tbl_supplier.sup_id 
					      WHERE tbl_pur_ord.po_date BETWEEN '$sdate' AND '$edate'";

						$ref=$this->db->query($sql);
						
						  	while($row=$ref->fetch_array()){
								$re=new report();
								$re->po_no=$row['po_no'];
								$re->model_number=$row['model_number'];
								$re->qty=$row['qty'];
								$re->comp_name=$row['comp_name'];
								$ar[]=$re;
								}
								if(!empty($ar)){
									return $ar;
							}
								else{
									echo"No Records Found!";
								}
				}

				function po_by_product($p_id){
					$sql="SELECT tbl_product.model_number,tbl_po_items.*,tbl_pur_ord.*,tbl_supplier.comp_name 
					      from tbl_product 
					      LEFT JOIN tbl_po_items ON tbl_product.p_id=tbl_po_items.p_id 
					      LEFT JOIN tbl_pur_ord ON tbl_po_items.po_no=tbl_pur_ord.po_no 
					      LEFT JOIN tbl_supplier ON tbl_pur_ord.sup_id=tbl_supplier.sup_id 
					      WHERE tbl_pur_ord.po_date BETWEEN '$sdate' AND '$edate'";

						$ref=$this->db->query($sql);
						
						  	while($row=$ref->fetch_array()){
								$re=new report();
								$re->po_no=$row['po_no'];
								$re->model_number=$row['model_number'];
								$re->qty=$row['qty'];
								$re->comp_name=$row['comp_name'];
								$ar[]=$re;
							}
								if(!empty($ar)){
									return $ar;
								}
								else{
									echo"No Records Found!";
								}
				}

				function po_pro(){
					$sql="SELECT tbl_product.model_number,tbl_po_items.*,tbl_pur_ord.*,tbl_supplier.comp_name 
						  from tbl_product
						  LEFT JOIN tbl_po_items ON tbl_product.p_id=tbl_po_items.p_id 
						  LEFT JOIN tbl_pur_ord ON tbl_po_items.po_no=tbl_pur_ord.po_no
						  LEFT JOIN tbl_supplier ON tbl_pur_ord.sup_id=tbl_supplier.sup_id";

					$ref=$this->db->query($sql);
						
						  	while($row=$ref->fetch_array()){
								$re=new report();
								$re->po_no=$row['po_no'];
								$re->model_number=$row['model_number'];
								$re->qty=$row['qty'];
								$re->comp_name=$row['comp_name'];
								$ar[]=$re;
							}
								if(!empty($ar)){
									return $ar;
								}
								else{
									echo"No Records Found!";
								}
				}

				function po_by_pro($p_id){
					$sql="SELECT tbl_product.model_number,tbl_po_items.*,tbl_pur_ord.*,tbl_supplier.comp_name 
					      from tbl_product
						  LEFT JOIN tbl_po_items ON tbl_product.p_id=tbl_po_items.p_id 
						  LEFT JOIN tbl_pur_ord ON tbl_po_items.po_no=tbl_pur_ord.po_no
						  LEFT JOIN tbl_supplier ON tbl_pur_ord.sup_id=tbl_supplier.sup_id
						  WHERE tbl_product.p_id='$p_id'";

					$ref=$this->db->query($sql);
				  	while($row=$ref->fetch_array()){
						$re=new report();
						$re->po_no=$row['po_no'];
						$re->model_number=$row['model_number'];
						$re->qty=$row['qty'];
						$re->comp_name=$row['comp_name'];
						$ar[]=$re;
					}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function sales_by_date($sdate, $edate){
					$sql="SELECT tbl_payment.*,tbl_cus_ord.*,tbl_ord_info.*,tbl_product.model_number,tbl_customer.f_name,tbl_customer.l_name
				          FROM tbl_cus_ord
						  LEFT JOIN tbl_ord_info ON tbl_cus_ord.cus_ord_no=tbl_ord_info.cus_ord_no
						  LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no
						  LEFT JOIN tbl_product ON tbl_ord_info.p_id=tbl_product.p_id
						  LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id
    					  WHERE tbl_cus_ord.ordate BETWEEN '$sdate' AND '$edate' AND tbl_ord_info.state='sold'";

					$ref=$this->db->query($sql);
				  	while($row=$ref->fetch_array()){
						$re=new report();
						$re->cus_ord_no=$row['cus_ord_no'];
						$re->f_name=$row['f_name'];
						$re->l_name=$row['l_name'];
						$re->model_number=$row['model_number'];
						$re->itm_qty=$row['itm_qty'];
						$re->ordate=$row['ordate'];
						$re->ntot=$row['ntot'];
						$ar[]=$re;
					}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function sales_by_pro($p_id){
					$sql="SELECT tbl_payment.*,tbl_cus_ord.*,tbl_ord_info.*,tbl_product.model_number,tbl_customer.f_name,tbl_customer.l_name
						  FROM tbl_cus_ord
						  LEFT JOIN tbl_ord_info ON tbl_cus_ord.cus_ord_no=tbl_ord_info.cus_ord_no
						  LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no
						  LEFT JOIN tbl_product ON tbl_ord_info.p_id=tbl_product.p_id
						  LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id
						  WHERE tbl_ord_info.p_id='$p_id'";

					$ref=$this->db->query($sql);

					while($row=$ref->fetch_array()){
						$re=new report();
						$re->cus_ord_no=$row['cus_ord_no'];
						$re->f_name=$row['f_name'];
						$re->l_name=$row['l_name'];
						$re->model_number=$row['model_number'];
						$re->itm_qty=$row['itm_qty'];
						$re->ordate=$row['ordate'];
						$re->ntot=$row['ntot'];
						$ar[]=$re;
					}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function sales_pro(){
					$sql="SELECT tbl_payment.*,tbl_cus_ord.*,tbl_ord_info.*,tbl_product.model_number,tbl_customer.f_name,tbl_customer.l_name
						  FROM tbl_cus_ord
						  LEFT JOIN tbl_ord_info ON tbl_cus_ord.cus_ord_no=tbl_ord_info.cus_ord_no
						  LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no
						  LEFT JOIN tbl_product ON tbl_ord_info.p_id=tbl_product.p_id
						  LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id";

					$ref=$this->db->query($sql);

					while($row=$ref->fetch_array()){
						$re=new report();
						$re->cus_ord_no=$row['cus_ord_no'];
						$re->f_name=$row['f_name'];
						$re->l_name=$row['l_name'];
						$re->model_number=$row['model_number'];
						$re->itm_qty=$row['itm_qty'];
						$re->ordate=$row['ordate'];
						$re->ntot=$row['ntot'];
						$ar[]=$re;
					}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}
		}
?>