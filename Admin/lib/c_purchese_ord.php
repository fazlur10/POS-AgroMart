<?php
	include_once("db_con.php");

		class pur{

			public $po_no;
			public $sup_id;
			public $po_date;
			public $ship_date;
			public $qty;
			public $u_price;
			public $tot_price;
			public $po_product_itm;
			public $p_id;

			private $db;

				function __construct(){
					$this->db=new mysqli(server,user,pass,db);
				}

				function poid(){
					$sql="SELECT po_no FROM tbl_pur_ord ORDER BY po_no DESC LIMIT 1;";
					$result=$this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
					$nor=$result->num_rows;
						if($nor==0){
							$po_no="P00001";
						}
						else{
							$rec=$result->fetch_assoc();
							$lid=$rec['po_no'];
							$num=substr($lid,1);
							$num++;
							$po_no=str_pad($num,5,'0',STR_PAD_LEFT);
							$po_no="P".$po_no;
						}
							return $po_no;
				}

				function get_po_by_id($po_no){
					$sql="SELECT tbl_pur_ord.po_no,tbl_pur_ord.po_date,tbl_pur_ord.ship_date,tbl_po_items.qty,tbl_product.model_number,tbl_supplier.sup_name,tbl_supplier.sup_id,tbl_product.p_id,tbl_supplier.comp_name
						  FROM tbl_pur_ord 
						  LEFT JOIN tbl_po_items ON tbl_pur_ord.po_no = tbl_po_items.po_no 
						  LEFT JOIN tbl_product ON tbl_product.p_id = tbl_po_items.p_id 
						  LEFT JOIN tbl_supplier ON tbl_supplier.sup_id = tbl_pur_ord.sup_id
						  WHERE tbl_pur_ord.po_no='$po_no'";

					$result=$this->db->query($sql);//execute sql query
					$row = $result->fetch_assoc();
						return $row;
				}

				function get_po_details($po_no){
					$sql="SELECT tbl_po_items.*, tbl_product.model_number FROM tbl_po_items 
						  JOIN tbl_product ON tbl_po_items.p_id = tbl_product.p_id
						  WHERE tbl_po_items.po_no='$po_no';";
					$result=$this->db->query($sql);//execute sql query

						while($row=$result->fetch_array()){
							$po=new pur();
							$po->po_no=$row['po_no'];
							$po->p_id=$row['p_id'];
							$po->model=$row['model_number'];
							$po->qty=$row['qty'];
							$ar[]=$po;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function new_po(){
					$sql="INSERT INTO tbl_pur_ord(po_no,sup_id,po_date,ship_date)
						  VALUES('$this->po_no','$this->sup_id',now(),'$this->ship_date');";
					$ref=$this->db->query($sql);
						if($ref>0){
							echo("Done");
						}
				}

				function add_pur_itm(){
					$cv=0;
						foreach($this->p_id as $key=>$value){
							$sql="INSERT INTO tbl_po_items(po_no,p_id,qty) values('$this->po_no','".$this->p_id[$cv]."','".$this->qty[$cv]."')";
							$res=$this->db->query($sql);
							$cv++;

								if($this->db->errno){
									echo($this->db->error);
									exit;
								}
								if($res==0){
									echo ("Error");
								}          
						}   
				}
					
				function view_po(){

					$sql="SELECT tbl_pur_ord.po_no,tbl_pur_ord.po_date,tbl_supplier.comp_name 
						  FROM tbl_pur_ord
					   	  LEFT JOIN tbl_supplier ON tbl_supplier.sup_id = tbl_pur_ord.sup_id
						  WHERE tbl_pur_ord.state='Active'";

					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){

							$po=new pur();
							$po->po_no=$row['po_no'];
							$po->po_date=$row['po_date'];
							$po->comp_name=$row['comp_name'];
							$ar[]=$po;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}	
				}

				function updatePo(){//update customer details
					$sql ="UPDATE tbl_pur_ord
						   SET po_no='$this->po_no',sup_id='$this->sup_id',po_date=now(),ship_date='$this->ship_date'
						   WHERE po_no='$this->po_no'";
					
					$sql2="DELETE  
					       FROM tbl_po_items
					       WHERE po_no='$this->po_no'"; 

					$result=$this->db->query($sql);//execute sql quary
					$result2=$this->db->query($sql2);
					if($this->db->errno){
						echo($this->db->error);
						exit;
					}
					if ($result>0){
			        	echo("Done");//Pass message to frontend if successful
			        }
			        else{
			        	echo("Error");//Pass message to frontend if error occur
			        }
			    }

			    function update_itm_po(){
			    	$cv=0;
						foreach($this->p_id as $key=>$value){
							$sql="INSERT INTO tbl_po_items(po_no,p_id,qty) values('$this->po_no','".$this->p_id[$cv]."','".$this->qty[$cv]."')";
							$res=$this->db->query($sql);
							$cv++;

								if($this->db->errno){
									echo($this->db->error);
									exit;
								}
								if($res==0){
									echo ("Error");
								}          
						}   
			    }

			    function removePo($po_no){
		 			$sql="UPDATE tbl_pur_ord
		 				  SET state='Inactive'
		 				  WHERE po_no='$po_no'";

		 			$result=$this->db->query($sql);//execute sql quary
				    	if($this->db->errno){
				        	echo($this->db->error);
				        	exit;
				    	}
				    	if ($result>0){
				        	echo("Done");//Pass message to frontend if successful
				    	}
				    	else{
				        	echo("Error");//Pass message to frontend if error occur
				    	}
		 		}
	}
?>