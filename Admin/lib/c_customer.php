<?php
	include_once("db_con.php");
	include_once("c_email.php");

	 	class customer{

	 		public $cus_id;
	 		public $first_name;
	 		public $last_name;
	 		public $email;
	 		public $user_type;
	 		public $usr_state;
	 		public $u_id;
	 		public $state;
	 		public $address;
	 		public $contact_no;

	 		public $db;
	 		
		 		function __construct(){
		 			$this->db=new mysqli(server,user,pass,db);	
		 		}

		 		function new_cus_id(){
					$sql = "SELECT cus_id FROM tbl_customer ORDER BY cus_id DESC LIMIT 1;";
					$result = $this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
					$nor = $result->num_rows;
						if($nor==0){
							$cus_id="C00001";
						}
						else{
							$rec=$result->fetch_assoc();
							$lid=$rec["cus_id"];
							$num=substr($lid,1);
							$num++;
							$cus_id=str_pad($num,5,'0',STR_PAD_LEFT);
							$cus_id="C".$cus_id;
						}
							return $cus_id;
				}

		 		function reg_cus(){
		 			$sql = "INSERT INTO tbl_customer(u_id,cus_id,f_name,l_name,address,contact_no)
							values('$this->u_id',
								   '$this->cus_id',
								   '$this->f_name',
								   '$this->l_name',
								   '$this->address',
								   '$this->contact_no');";

		 			$ref=$this->db->query($sql);
		 				echo("Done");		
			 			if($this->db->errno){
							echo($this->db->error);
							exit;
						}
						else{
							$message = "Dear ".$this->f_name."\n"."Thank you for registering.";
							$c_email = new c_email();
							$c_email->send($this->email,"Registration Successful",'info@localhost',$message);
						}
		 		}

		 		function get_ucus_byid($u_id){
		 			$sql = "SELECT tbl_employee.*,tbl_user.*
							FROM tbl_user
							LEFT JOIN tbl_employee ON tbl_user.u_id=tbl_employee.u_id
							WHERE tbl_user.u_id='$u_id';";

			    	$result=$this->db->query($sql);//execute sql query

			    	$row=$ref->fetch_array();
					$cus=new customer();
					$cus->u_id=$row['u_id'];					
					$cus->cus_id=$row['cus_id'];
					$cus->first_name=$row['f_name'];
					$cus->last_name=$row['l_name'];
					$cus->email=$row['email'];
					$cus->user_status=$row['user_status'];	
					 	
					if(!empty($cus)){
						return $cus;
					}
					else{
						echo"No Records Found!";
					}
		 		}

		 		function view_cus(){

		 			$sql = "SELECT tbl_customer.cus_id,tbl_customer.f_name,tbl_customer.user_status,tbl_customer.l_name,tbl_customer.address,tbl_customer.contact_no,tbl_user.email 
		 					FROM tbl_customer 
		 					LEFT JOIN tbl_user ON tbl_customer.u_id=tbl_user.u_id 
		 					WHERE user_type='1'";

		 				$ref=$this->db->query($sql);
		 				
		 				while($row=$ref->fetch_array()){
							$cus=new customer();
							$cus->cus_id=$row['cus_id'];
							$cus->first_name=$row['f_name'];
							$cus->last_name=$row['l_name'];
							$cus->address=$row['address'];
							$cus->contact_no=$row['contact_no'];
							$cus->email=$row['email'];
							$cus->user_status=$row['user_status'];	
							$ar[]=$cus;	
					 	}
					 	
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}			
		 		}

		 		function get_cus_byid($cus_id){
			    	$sql = "SELECT *
			            	FROM tbl_customer
			            	WHERE cus_id='$cus_id';";

			    	$result=$this->db->query($sql);//execute sql query

			    	$row = $result->fetch_assoc();
			    		return $row;
		 		}

		 		function updateCustomer(){//update customer details
			    	$sql = "UPDATE tbl_customer
			           		SET f_name='$this->first_name', l_name='$this->last_name' ,address='$this->address',contact_no='$this->contact_no'
			           		WHERE cus_id='$this->cus_id'";

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
				
				
				function updateDept(){//update Dept details
				$result1 = "select count(1) FROM tbl_payment";
                $ref=$this->db->query($result1);
		 				
		 				while($row=$ref->fetch_array()){
							$rowcount = $row['count(1)'];
							
					 	}
				  for ($x = 0; $x < $rowcount; $x++)
                    {
						$TempBal = $this->pay_bal;
                      
                        $Cid = $this->cus_id;
					
				  
				  while ($TempBal > 0)
                        {
							$sqlSearch= "SELECT tbl_payment.cus_ord_no, tbl_payment.bal 
							FROM tbl_cus_ord LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id 
							LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no 
							WHERE tbl_customer.cus_id='$Cid' AND tbl_payment.bal > 0 ORDER BY tbl_payment.cus_ord_no ASC LIMIT 1";
							
							$ref=$this->db->query($sqlSearch);
		 				
		 				while($row=$ref->fetch_array()){
							$OrderId = $row['cus_ord_no'];
							$Balance = $row['bal'];
					 	}
						
						if ($Balance > $TempBal)
                            {
                                $Balance = $Balance - $TempBal;
                                $TempBal = 0;
                            }
                            else
                            {
                                $TempBal = $TempBal - $Balance;
                                $Balance = 0;
                            }
					 	$sql = "UPDATE tbl_payment
			           		SET bal=$Balance
			           		WHERE cus_ord_no='OrderId'";

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
				}

				function removeCus($cus_id){
		 			$sql = "UPDATE tbl_customer
		 					SET user_status='Inactive'
		 					WHERE cus_id='$cus_id'";

		 			$sql2 ="UPDATE tbl_user
		 					SET state='0'
		 					WHERE u_id='$cus_id';";

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

		 		function ActiveCus($cus_id){
		 			$sql = "UPDATE tbl_customer
		 					SET user_status='Active'
		 					WHERE cus_id='$cus_id'";

		 			$sql2= "UPDATE tbl_user
		 					SET state='1'
		 					WHERE u_id='$cus_id';";

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