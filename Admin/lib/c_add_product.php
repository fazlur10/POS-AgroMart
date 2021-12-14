<?php
	include_once("db_con.php");

	class product{

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
		private $db;

			function __construct(){
				$this->db=new mysqli(server,user,pass,db);
			}

			function pid(){
				$sql="SELECT p_id FROM tbl_product ORDER BY p_id DESC LIMIT 1;";
				$result=$this->db->query($sql);
					if($this->db->errno){
						echo($this->db->error);
						exit;
					}
					$nor=$result->num_rows;
						if($nor==0){
							$p_id="P00001";
						}
						else{
							$rec=$result->fetch_assoc();
							$lid=$rec['p_id'];
							$num=substr($lid,1);
							$num++;
							$p_id=str_pad($num,5,'0',STR_PAD_LEFT);
							$p_id="P".$p_id;
						}
							return $p_id;
			}

			function load_cat(){
				$sql="SELECT cat_id,cat FROM tbl_cat WHERE state='Active'";
				$result=$this->db->query($sql);
					if($this->db->errno){
						echo($this->db->error);
						exit;
					}
					while($record = $result->fetch_assoc() ){
						echo ("<option value=".$record['cat_id'].">".$record['cat']."</option>");
					}
			}

			function load_scat(){
				$sql="SELECT sub_cat_id,sub_cat FROM tbl_subcat WHERE state='Active'";
				$result=$this->db->query($sql);
					if($this->db->errno){
						echo($this->db->error);
						exit;
					}
					while($record = $result->fetch_assoc() ){
						echo ("<option value=".$record['sub_cat_id'].">".$record['sub_cat']."</option>");
					}
			}

			function load_sup(){
				$sql="SELECT sup_id,comp_name FROM tbl_supplier WHERE user_status='Active'";
				$result=$this->db->query($sql);
					if($this->db->errno){
						echo($this->db->error);
						exit;
					}
					while($record = $result->fetch_assoc() ){
						echo ("<option value=".$record['sup_id'].">".$record['comp_name']."</option>");
					}
			}

			function load_mno(){
				$sql="SELECT * FROM tbl_product WHERE state='Active'";
				$result=$this->db->query($sql);
					if($this->db->errno){
						echo($this->db->error);
						exit;
					}
					while($record = $result->fetch_assoc()){
						echo ("<option value=".$record['p_id'].">".$record['model_number']."</option>");
						
					}
			}

			function load_payment(){
				$sql="SELECT * FROM tbl_payment_types WHERE p_m_id='P00001'";
				$result=$this->db->query($sql);
					if($this->db->errno){
						echo($this->db->error);
						exit;
					}
					while($record = $result->fetch_assoc()){
						echo ("<option value=".$record['p_m_id'].">".$record['payment_method']."</option>");
						
					}
			}

			function get_sub_by_cid($cat_id){
				$sql="SELECT * FROM tbl_subcat WHERE cat_id='$cat_id' AND state ='Active'";
				$ref=$this->db->query($sql);
				
					while($row=$ref->fetch_array()){

						$pro= new product();
						$pro->sub_cat_id=$row['sub_cat_id'];
						$pro->sub_cat=$row['sub_cat'];

						$ar[]=$pro;
					}
					return $ar;

			}

			function add_pro(){
				$sql= "INSERT INTO tbl_product(p_id,sub_cat_id,model_number,description,re_ord_qty)
					   VALUES('$this->p_id',
					          '$this->sub_cat_id',
					          '$this->model_number',
					          '$this->description',
					          '$this->re_ord_qty');";

				$ref=$this->db->query($sql);

				/*--Add Product Image--*/

				$pid=$this->p_id;
					move_uploaded_file($_FILES["e_img"]["tmp_name"],"../ui/product/$pid.jpg");
						if($ref>0){
							echo("Done");
						}
						else{
							echo ("error");
						}
			}

			function view_pro(){
				$sql= "SELECT tbl_product.p_id,tbl_subcat.sub_cat,tbl_product.model_number,tbl_product.description,tbl_product.re_ord_qty,tbl_product.state 
					   FROM tbl_product LEFT JOIN tbl_subcat ON tbl_product.sub_cat_id=tbl_subcat.sub_cat_id";

				$ref=$this->db->query($sql);

					while($row=$ref->fetch_array()){

						$pro= new product();
						$pro->p_id=$row['p_id'];
						$pro->sub_cat=$row['sub_cat'];
						$pro->model_number=$row['model_number'];
						$pro->description=$row['description'];
						$pro->re_ord_qty=$row['re_ord_qty'];
						$pro->state=$row['state'];

						$ar[]=$pro;
					}
					if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Products Found!";
						}
			}

			function get_pro_byid($p_id){
				$sql = "SELECT *
						FROM  tbl_product
						WHERE p_id='$p_id';";

			    $result=$this->db->query($sql);//execute sql query
			    $row = $result->fetch_assoc();
			    	return $row;
			}

	 		function updateProduct(){//update customer details
	 			$sql= "UPDATE tbl_product
	 				   SET p_id='$this->p_id',sub_cat_id='$this->sub_cat_id',model_number='$this->model_number',re_ord_qty='$this->re_ord_qty',description='$this->description' 
	 				   WHERE p_id='$this->p_id'";


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

		    function removePro($p_id){
		    	$sql= "UPDATE tbl_product
		    		   SET state='Inactive'
		    		   WHERE p_id='$p_id'";

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

		    function ActivePro($p_id){
		    	$sql= "UPDATE tbl_product
		    		   SET state='Active'
		    		   WHERE p_id='$p_id'";

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

		    function load_by_id($p_id){
		    	$sql= "SELECT *
		    		   FROM  tbl_product
		    		   WHERE p_id='$p_id';";

		    	$result=$this->db->query($sql);//execute sql query

			    	if($row=$result->fetch_array()){
			    		$this->p_id=$row['p_id'];
			    		$this->model_number=$row['model_number'];
			    		$this->sell_price=$row["sell_price"];
			    		$this->tot_qty=$row["tot_qty"];
			    	}
			    		return $this;
		    }
	}
?>