<?php
	include_once("db_con.php");

		class supplier{

			public $sup_id;
			public $sup_name;
			public $comp_name;
			public $comp_addr;
			public $contact;
			public $type;
			public $user_status;
			public $u_id;
			public $email;
			public $pwd;
			public $conpwd;

			private $db;
			
				function __construct(){
					$this->db=new mysqli(server,user,pass,db);	
				}

				function new_sid(){
					$sql= "SELECT sup_id FROM tbl_supplier ORDER BY sup_id DESC LIMIT 1;";
					$result= $this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
					$nor=$result->num_rows;
						if($nor==0){
							$sup_id="S00001";
						}
						else{
							$rec=$result->fetch_assoc();
							$lid=$rec["sup_id"];
							$num=substr($lid,1);
							$num++;
							$sup_id=str_pad($num,5,'0',STR_PAD_LEFT);
							$sup_id="S".$sup_id;
						}
							return $sup_id;
				}

				function reg_sup(){
					$sql="INSERT INTO tbl_supplier(u_id,sup_id,sup_name,comp_name,comp_addr,contact)
						  VALUES('$this->u_id',
								 '$this->sup_id',
								 '$this->sup_name',
								 '$this->comp_name',
								 '$this->comp_addr',
								 '$this->contact');";

					$ref=$this->db->query($sql);
						echo("Done");
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
				}

				function view_sup(){
					
					$sql="SELECT tbl_supplier.sup_id,tbl_supplier.sup_name,tbl_supplier.comp_name,tbl_supplier.comp_addr,tbl_supplier.contact,tbl_user.email,tbl_supplier.user_status 
						  FROM tbl_supplier LEFT JOIN tbl_user ON tbl_supplier.u_id=tbl_user.u_id 
						  WHERE user_type='2'";
					
					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){

							$sup=new supplier();
							$sup->sup_id=$row['sup_id'];
							$sup->sup_name=$row['sup_name'];
							$sup->comp_name=$row['comp_name'];
							$sup->comp_addr=$row['comp_addr'];
							$sup->contact=$row['contact'];
							$sup->email=$row['email'];
							$sup->user_status=$row['user_status'];
							$ar[]=$sup;
						}

						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function get_sup_byid($sup_id){
					$sql = "SELECT *
							FROM tbl_supplier
							WHERE sup_id='$sup_id';";

				    $result=$this->db->query($sql);//execute sql query
				    $row = $result->fetch_assoc();
				    	return $row;
				}

		 		function updateSupplier(){//update customer details
		 			$sql ="UPDATE tbl_supplier
	 					   SET sup_name='$this->sup_name', comp_name='$this->comp_name', comp_addr='$this->comp_addr', contact='$this->contact' 
		 				   WHERE sup_id='$this->sup_id'";

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

			    function removeSup($sup_id){
			    	$sql="UPDATE tbl_supplier
			    		  SET user_status='Inactive'
			    		  WHERE sup_id='$sup_id'";

			    	$sql2="UPDATE tbl_user
			    		   SET state='0'
			    	 	   WHERE u_id='$sup_id';";

		 			$result=$this->db->query($sql);//execute sql quary
		 			$result=$this->db->query($sql2);
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

			    function ActiveSup($sup_id){
			    	$sql="UPDATE tbl_supplier
			    		  SET user_status='Active'
			    	      WHERE sup_id='$sup_id'";

			    	$sql2="UPDATE tbl_user
			    	       SET state='1'
			    		   WHERE u_id='$sup_id';";

		 			$result=$this->db->query($sql);//execute sql quary
		 			$result=$this->db->query($sql2);
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