<?php
	include_once("db_con.php");

		class scat{

			public $sub_cat_id;
			public $sub_cat;
			public $cat_id;
			public $cat;
			public $state;

			private $db;
			
				function __construct(){
					$this->db=new mysqli(server,user,pass,db);	
				}

				function new_sid(){
					$sql="SELECT sub_cat_id FROM tbl_subcat ORDER BY sub_cat_id DESC LIMIT 1;";
					$result=$this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
					$nor=$result->num_rows;
						if($nor==0){
							$sub_cat_id="S00001";
						}
						else{
							$rec=$result->fetch_assoc();
							$lid=$rec["sub_cat_id"];
							$num=substr($lid,1);
							$num++;
							$sub_cat_id=str_pad($num,5,'0',STR_PAD_LEFT);
							$sub_cat_id="S".$sub_cat_id;
						}
							return $sub_cat_id;
				}

				function load_cat(){
					$sql="SELECT cat_id,cat FROM tbl_cat WHERE state='Active';";
					$result=$this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
						while($record = $result->fetch_assoc() ){
							echo ("<option value=".$record['cat_id'].">".$record['cat']."</option>");
						}
				}
				
				function load_drop(){

					$sql="SELECT cat_id,cat FROM tbl_cat WHERE state='Active';";
					$send=mysqli_query($this->db,$sql);
					$array = array();
						while($data=mysqli_fetch_array($send)){
							array_push($array,array('cat_id' => $data['cat_id'],'cat' => $data['cat'],));
						}
						return $array;
				}

				function add_sub_cat(){
					$sql="INSERT INTO tbl_subcat(cat_id,sub_cat_id,sub_cat)
						  VALUES('$this->cat_id',
								 '$this->sub_cat_id',
								 '$this->sub_cat');";

					$ref=$this->db->query($sql);
						echo("DoneDone");
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
				}

				function view_subcat(){
					
					$sql="SELECT tbl_subcat.sub_cat_id,tbl_subcat.sub_cat,tbl_cat.cat,tbl_subcat.state FROM tbl_subcat LEFT JOIN tbl_cat ON tbl_subcat.cat_id=tbl_cat.cat_id ";

					$ref=$this->db->query($sql);

						while($row=$ref->fetch_array()){
							
							$sc=new scat();
							$sc->sub_cat_id=$row['sub_cat_id'];
							$sc->sub_cat=$row['sub_cat'];
							$sc->cat=$row['cat'];
							$sc->state=$row['state']; 

							$ar[]=$sc;
						}
							return $ar;
				}

				function get_sc_byid($sub_cat_id){
					$sql = "SELECT *
							FROM tbl_subcat
							WHERE sub_cat_id='$sub_cat_id';";

				    $result=$this->db->query($sql);//execute sql query
				    $row = $result->fetch_assoc();
				    	return $row;
				}

		 		function updateScat(){//update customer details
		 			$sql ="UPDATE tbl_subcat
		 				   SET cat_id='$this->cat_id',sub_cat='$this->sub_cat' 
		 			       WHERE sub_cat_id='$this->sub_cat_id'";

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

			    function removeS($sub_cat_id){
			    	$sql="UPDATE tbl_subcat
			    		  SET state='Inactive'
			    	      WHERE sub_cat_id='$sub_cat_id'";

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

			    function ActiveS($sub_cat_id){
			    	$sql="UPDATE tbl_subcat
			    		  SET state='Active'
			    		  WHERE sub_cat_id='$sub_cat_id'";

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