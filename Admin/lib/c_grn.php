<?php
	/*import the datbase connection*/
	include_once("db_con.php");
		/*create a veribles that are required*/
		class grn{
			public $p_id;
			public $grn_no;
			public $stock_no;
			public $grn_date;
			public $ref_no;
			public $itm_des;
			public $unit_pri;
			public $sel_pri;
			public $qty;
			public $tot_qty;
			public $re_ord_qty;
			public $sup_id;
			public $po_no;

			private $db;

				/*call to database function*/
				function __construct(){
					$this->db=new mysqli(server,user,pass,db);
				}
				/*grnerate automated grn id*/
				function grn_no(){
					$sql= "SELECT grn_no FROM tbl_grn ORDER BY grn_no DESC LIMIT 1;";
						$result=$this->db->query($sql);
							if($this->db->errno){
								echo($this->db->error);
								exit;
							}
						$nor=$result->num_rows;
							if($nor==0){
								$grn_no="G00001";
							}
							else{
								$rec=$result->fetch_assoc();
								$lid=$rec["grn_no"];
								$num=substr($lid,1);
								$num++;
								$grn_no=str_pad($num,5,'0',STR_PAD_LEFT);
								$grn_no="G".$grn_no;
							}
								return $grn_no;
				}

				function sup_load(){
					$sql="SELECT sup_id,sup_name 
						  FROM  tbl_supplier 
						  WHERE user_status='Active';";

					$send=mysqli_query($this->db,$sql);
					$array =array();
						while($data=mysqli_fetch_array($send)){
							array_push($array,array('sup_id'=>$data['sup_id'],'sup_name'=>$data['sup_name'],));
						}
							return $array;
				}

				function load_itm(){
					$sql="SELECT p_id,model_number FROM tbl_product WHERE state='Active';";
					$send=mysqli_query($this->db,$sql);
					$array = array();
						while($data=mysqli_fetch_array($send)){
							array_push($array,array('p_id'=>$data['p_id'],'model_number'=>$data['model_number'],));
						}
							return $array;
				}
				/* add basic details into "tbl_grn table" */
				function add_grn(){
					$sql= "INSERT INTO tbl_grn(grn_no,po_no,grn_date,ref_no,sup_id) 
						   values('$this->grn_no','$this->po_no',now(),'$this->ref_no','$this->sup_id')";

					$res=$this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
						if($res>0){
							echo ("Done");
						}
						else{
							echo ("Error");
						}
				}
				/* add product informations into "pro_grn" Table */
				function add_pro_grn(){
					if(is_array($this->p_id)){
						$cv=0;
							foreach($this->p_id as $id){
								$sql= "INSERT INTO pro_grn(grn_no,p_id,qty,unit_pri,sel_pri) 
									   values('$this->grn_no','".$this->p_id[$cv]."','".$this->qty[$cv]."','".$this->unit_pri[$cv]."','".$this->sel_pri[$cv]."')";
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
							if(count($this->p_id) == $cv){
								return "Done";
							}
					}       
				}
				/*Updte the Selling price "tbl_product" table*/
				function update_sell_pri(){
					if(is_array($this->p_id)){
						$cv=0;
							foreach($this->p_id as $id){
								$sql= "UPDATE tbl_product 
									   SET sell_price='".$this->sel_pri[$cv]."'
									   WHERE p_id='".$this->p_id[$cv]."'";

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
							if(count($this->p_id) == $cv){
								return "Done";
							}
					}      
				}
				/*View all added grn items */
				function view_grn(){

					$sql= "SELECT tbl_grn.grn_no,tbl_grn.grn_date,tbl_grn.ref_no,tbl_supplier.sup_name,pro_grn.p_id,pro_grn.qty,pro_grn.unit_pri,pro_grn.sel_pri,tbl_product.model_number 
						   FROM tbl_grn
						   LEFT JOIN pro_grn ON tbl_grn.grn_no=pro_grn.grn_no 
						   LEFT JOIN tbl_supplier ON tbl_grn.sup_id=tbl_supplier.sup_id
						   LEFT JOIN tbl_product ON pro_grn.p_id=tbl_product.p_id ";

					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){
							$gr=new grn();
							$gr->grn_no=$row['grn_no'];
							$gr->grn_date=$row['grn_date'];
							$gr->ref_no=$row['ref_no'];
							$gr->sup_name=$row['sup_name'];
							$gr->model_number=$row['model_number'];
							$gr->qty=$row['qty'];
							$gr->unit_pri=$row['unit_pri'];
							$gr->sel_pri=$row['sel_pri'];
							$ar[]=$gr;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}	
				}
				/*get total quentity of the items*/
				function get_itm_qty($id){
					$sql="SELECT qty 
						  FROM  pro_grn 
						  WHERE p_id='$id';";
					$result=$this->db->query($sql);
					$tot=0;
						while($row = $result->fetch_assoc()) {
							$tot += $row['qty'];
						}
							return $tot;
				}

				function view_stock(){

					$sql="SELECT pro_grn.p_id,tbl_product.model_number,tbl_product.tot_qty,tbl_product.re_ord_qty
						  FROM pro_grn
						  LEFT JOIN tbl_product ON  pro_grn.p_id=tbl_product.p_id
					 	  GROUP BY p_id";

					$ref=$this->db->query($sql);
						while($row=$ref->fetch_array()){
							$gr=new grn();
							$gr->p_id=$row['p_id'];
							$gr->model_number=$row['model_number'];
							$gr->re_ord_qty=$row['re_ord_qty'];
							$gr->tot_qty=$row['tot_qty'];
							$ar[]=$gr;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}	
				}
				/*Get total qentity of the products*/
				function update_stock($grn_no){
					$sql="SELECT tbl_product.p_id, (tot_qty+qty) AS CUR_STOCK
						  FROM pro_grn
						  LEFT JOIN tbl_product ON pro_grn.p_id=tbl_product.p_id 
						  where grn_no ='".$grn_no."'";
					
					$ref=$this->db->query($sql);
						while($row=$ref->fetch_array()){
							$gr=new grn();
							$p_id=$row['p_id'];
							$cus_stock = $row['CUR_STOCK'];
							$ar[]=$gr;

							$sql1="UPDATE tbl_product
								   SET tot_qty='".$cus_stock."'
								   WHERE p_id='$p_id'";
							$result=$this->db->query($sql1);//execute sql quary
								if($this->db->errno){
									echo($this->db->error);
									exit;
								}
						}		  	      
				}
		}
?>