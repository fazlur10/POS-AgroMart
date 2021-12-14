<?php
	include_once("db_con.php");

		class Role{

			public $role_id;
			public $role_name;
			public $state;

			private $db;
			
				function __construct(){
					$this->db=new mysqli(server,user,pass,db);	
				}

				function new_r_id(){
					$sql="SELECT role_id FROM tbl_e_role ORDER BY role_id DESC LIMIT 1;";
					$result=$this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
					$nor=$result->num_rows;
						if($nor==0){
							$role_id="R00001";
						}
						else{
							$rec=$result->fetch_assoc();
							$lid=$rec["role_id"];
							$num=substr($lid,1);
							$num++;
							$role_id=str_pad($num,5,'0',STR_PAD_LEFT);
							$role_id="R".$role_id;
						}
							return $role_id;
				} 

				function add_role(){
					$sql="INSERT INTO tbl_e_role(role_id,role_name)
						  VALUES('$this->role_id','$this->role_name');";
					
					$ref=$this->db->query($sql);		
						echo ("Done");
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}			   
				}

				function view_role(){
					$sql="SELECT * FROM tbl_e_role ";
					$ref=$this->db->query($sql);
						while($row=$ref->fetch_array()){
							$rol=new role();
							$rol->role_id=$row['role_id'];
							$rol->role_name=$row['role_name'];
							$rol->state=$row['state'];

							$ar[]=$rol;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}
				}

				function get_role_byid($role_id){
					$sql = "SELECT *
							FROM tbl_e_role
							WHERE role_id='$role_id';";

				    $result=$this->db->query($sql);//execute sql query
				    $row = $result->fetch_assoc();
				    	return $row;
				}

		 		function updaterole(){//update customer details
		 			$sql ="UPDATE tbl_e_role
		 				   SET role_name='$this->role_name'
		 				   WHERE role_id='$this->role_id'";

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

			    function removerole($role_id){
			    	$sql="UPDATE tbl_e_role
			    		  SET state='Inactive'
			    		  WHERE role_id='$role_id'";

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

			    function Activerole($role_id){
			    	$sql="UPDATE tbl_e_role
			    		  SET state='Active'
			    		  WHERE role_id='$role_id'";

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