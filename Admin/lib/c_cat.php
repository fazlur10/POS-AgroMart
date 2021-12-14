<?php
	include_once("db_con.php");

		class category{
			public $cat_id;
			public $cat;
			public $state;
			public $db;

				function __construct(){
					$this->db=new mysqli(server,user,pass,db);
				}

				function new_cid(){
					$sql="SELECT cat_id FROM tbl_cat ORDER BY cat_id DESC LIMIT 1;";
					$result=$this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
						$nor=$result->num_rows;
							if($nor==0){
								$cat_id="C00001";
							}
							else{
								$rec=$result->fetch_assoc();
								$lid=$rec["cat_id"];
								$num=substr($lid,1);
								$num++;
								$cat_id=str_pad($num,5,'0',STR_PAD_LEFT);
								$cat_id="C".$cat_id;
							}
								return $cat_id;
				}

				function reg_cat(){
					$sql="INSERT INTO tbl_cat(cat_id,cat)
						  VALUES('$this->cat_id',
								 '$this->cat');";
					$ref=$this->db->query($sql);
						echo("DoneDone");
							if($this->db->errno){
								echo($this->db->error);
								exit;
							}
				}

				function view_cat(){
					$sql="SELECT * FROM tbl_cat ";
					$ref=$this->db->query($sql);
						while($row=$ref->fetch_array()){
							$cat=new category();
							$cat->cat_id=$row['cat_id'];
							$cat->cat=$row['cat'];
							$cat->state=$row['state'];

							$ar[]=$cat;
						}
							return $ar;
				}

				function get_cat_byid($cat_id){
					$sql = "SELECT *
							FROM tbl_cat
							WHERE cat_id='$cat_id';";

				    	$result=$this->db->query($sql);//execute sql query
				    	$row = $result->fetch_assoc();
				    		return $row;
				    }

		 		function updateCat(){//update customer details
		 			$sql = "UPDATE tbl_cat
		 					SET cat='$this->cat'
		 					WHERE cat_id='$this->cat_id'";

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

			    function removeCat($cat_id){
			    	$sql = "UPDATE tbl_cat
			    			SET state='Inactive'
			    			WHERE cat_id='$cat_id';";

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

			    function ActiveCat($cat_id){
			    	$sql = "UPDATE tbl_cat
			    			SET state='Active'
			    			WHERE cat_id='$cat_id'";
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
				    
			    function display(){
			    	$sql = "SELECT tbl_cat.cat_id,tbl_cat.cat,tbl_subcat.sub_cat_id,tbl_subcat.sub_cat
			    			FROM tbl_subcat
			    			LEFT JOIN tbl_cat ON tbl_cat.cat_id=tbl_subcat.cat_id
			    			ORDER BY tbl_cat.cat,tbl_subcat.sub_cat";

			    	$ref=$this->db->query($sql);
				    	while($row=$ref->fetch_array()){
				    		$cat=new category();
				    		$cat->cat_id=$row['cat_id'];
				    		$cat->cat=$row['cat'];
				    		$cat->sub_cat_id=$row['sub_cat_id'];
				    		$cat->sub_cat=$row['sub_cat'];

				    		$ar[]=$cat;
				    	}
			    			return $ar;
			    }
		}
?>