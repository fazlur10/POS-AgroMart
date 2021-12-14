<?php
	include_once("db_con.php");

		class employee{

			public $emp_id;
			public $emp_name;
			public $addr;
			public $cont;
			public $user_status;
			public $u_id;
			public $email;
			public $role_id;
			private $db;
			
				function __construct(){
					
					$this->db=new mysqli(server,user,pass,db);	
				}

				function emp_id(){
					$sql = "SELECT emp_id FROM tbl_employee ORDER BY emp_id DESC LIMIT 1;";
					$result= $this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
						$nor=$result->num_rows;
							if($nor==0){
								$emp_id="E00001";
							}
							else{
								$rec=$result->fetch_assoc();
								$lid=$rec["emp_id"];
								$num=substr($lid,1);
								$num++;
								$emp_id=str_pad($num,5,'0',STR_PAD_LEFT);
								$emp_id="E".$emp_id;
							}
								return $emp_id;
				}
			
				function load_role(){
					$sql="SELECT * FROM tbl_e_role WHERE state ='Active'";
					$result=$this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
						while($record = $result->fetch_assoc()){
							echo ("<option value=".$record['role_id'].">".$record['role_name']."</option>");
						}
				}

				function get_uemp_byid($u_id){
					$sql ="SELECT tbl_employee.*,tbl_user.*,tbl_e_role.role_name
						   FROM tbl_user
						   LEFT JOIN tbl_employee ON tbl_user.u_id=tbl_employee.u_id
						   LEFT JOIN tbl_e_role ON tbl_employee.role_id=tbl_e_role.role_id
						   WHERE tbl_user.u_id='$u_id';";

			    	$result=$this->db->query($sql);//execute sql query
			    	$row=$result->fetch_assoc();

					$emp=new employee();
					$emp->u_id=$row['u_id'];
					$emp->emp_id=$row['emp_id'];
					$emp->emp_name=$row['emp_name'];
					$emp->email=$row['email'];
					$emp->user_type=$row['user_type'];
					$emp->user_status=$row['user_status'];
					$emp->role_name=$row['role_name'];
					
						if(!empty($emp)){
							return $emp;
						}
						else{
							echo"No Records Found!";
						}
			    }

				function reg_emp(){
					$sql = "INSERT INTO tbl_employee(u_id,emp_id,emp_name,addr,cont,role_id)
							VALUES('$this->u_id',
								   '$this->emp_id',
								   '$this->emp_name',
					     		   '$this->addr',
								   '$this->cont',
								   '$this->role_id');";

					$ref=$this->db->query($sql);
						echo("Done");
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
				}

				function view_emp(){
					
					$sql = "SELECT tbl_employee.emp_id,tbl_employee.emp_name,tbl_e_role.role_name,tbl_employee.addr,tbl_employee.cont,tbl_employee.user_status 
							FROM tbl_employee 
							LEFT JOIN tbl_e_role ON tbl_e_role.role_id=tbl_employee.role_id 
							LEFT JOIN tbl_user ON tbl_employee.u_id=tbl_user.u_id";
					
					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){

							$emp=new employee();
							$emp->emp_id=$row['emp_id'];
							$emp->emp_name=$row['emp_name'];
							$emp->role_name=$row['role_name'];
							$emp->addr=$row['addr'];
							$emp->cont=$row['cont'];
							$emp->user_status=$row['user_status'];
							$ar[]=$emp;
						}

						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}	
				}

				function get_emp_byid($emp_id){
					$sql = "SELECT *
							FROM tbl_employee
							WHERE emp_id='$emp_id';";

				    	$result=$this->db->query($sql);//execute sql query
				    	$row = $result->fetch_assoc();
				    		return $row;
				}

		 		function updateEmp(){//update customer details
		 			$sql = "UPDATE tbl_employee
		 					SET role_id='$this->role_id',emp_name='$this->emp_name', addr='$this->addr', cont='$this->cont'
		 					WHERE emp_id='$this->emp_id'";

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

			    function removeEmp($emp_id){
			    	$sql= "UPDATE tbl_employee
			    		   SET user_status='Inactive'
			    		   WHERE emp_id='$emp_id'";

			    	$sql2= "UPDATE tbl_user
			    			SET state='0'
			    			WHERE u_id='$emp_id';";

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

			    function ActiveEmp($emp_id){
			    	$sql= "UPDATE tbl_employee
			    		   SET user_status='Active'
			    		   WHERE emp_id='$emp_id'";

			    	$sql2="UPDATE tbl_user
			    		   SET state='1'
			    		   WHERE u_id='$emp_id';";

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