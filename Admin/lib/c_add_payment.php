<?php
	include_once("db_con.php");

		class apayment{

			public $p_m_id;
			public $payment_method;
			public $state;
			private $db;
			
				function __construct(){
					$this->db=new mysqli(server,user,pass,db);	
				}

				function new_p_m_id(){
					$sql="SELECT p_m_id FROM tbl_payment_types ORDER BY p_m_id DESC LIMIT 1;";
					$result=$this->db->query($sql);

						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
							$nor=$result->num_rows;
						if($nor==0){
							$p_m_id="P00001";
						}
						else{
							$rec=$result->fetch_assoc();
							$lid=$rec["p_m_id"];
							$num=substr($lid,1);
							$num++;
							$p_m_id=str_pad($num,'5','0',STR_PAD_LEFT);
							$p_m_id="P".$p_m_id;
						}
							return $p_m_id;
				}

				function add_npay(){
					$sql="INSERT INTO tbl_payment_types(p_m_id,payment_method)
						  VALUES('$this->p_m_id',
								 '$this->payment_method');";

					$ref=$this->db->query($sql);
						echo("DoneDone");
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}						   
				}

				function view_n_pay(){
					$sql="SELECT * FROM tbl_payment_types;";
					$ref=$this->db->query($sql);
						while($row=$ref->fetch_array()){
							$apay=new apayment();
							$apay->p_m_id=$row['p_m_id'];
							$apay->payment_method=$row['payment_method'];
							$apay->state=$row['state'];

							$ar[]=$apay;
						}

							return $ar;
				}

				function get_pt_byid($p_m_id){
					$sql = "SELECT *
							FROM tbl_payment_types
							WHERE p_m_id='$p_m_id';";

				    	$result=$this->db->query($sql);//execute sql query
				    	$row = $result->fetch_assoc();
				    		return $row;
				}

		 		function updatePt(){//update customer details
		 			$sql ="UPDATE tbl_payment_types
		 				   SET payment_method='$this->payment_method'
		 				   WHERE p_m_id='$this->p_m_id'";

				    	$result=$this->db->query($sql);//execute sql quary
					    	if($this->db->errno){
					    		echo($this->db->error);
					    		exit;
					    	}
					    	if($result>0){
					        	echo("Done");//Pass message to frontend if successful
					        }
					        else{
					        	echo("Error");//Pass message to frontend if error occur
					        }
			    }

			    function removePt($p_m_id){
			    	$sql="UPDATE tbl_payment_types
			    		  SET state='Inactive'
			    	      WHERE p_m_id='$p_m_id'";

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

			    function ActivePt($p_m_id){
			    	$sql="UPDATE tbl_payment_types
			    		  SET state='Active'
			    		  WHERE p_m_id='$p_m_id'";

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