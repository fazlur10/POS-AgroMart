<?php
	include_once("db_con.php");

		class user{

			public $u_id;
			public $email;
			public $pwd;
			public $conpwd;
			public $usrname;
			public $psw;
			public $user_type;
			public $state;

			public $db;
			
				function __construct(){
					$this->db=new mysqli(server,user,pass,db);	
				}

				function new_uid(){
					$sql = "SELECT u_id FROM tbl_user ORDER BY u_id desc LIMIT 1;";
					$result = $this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
						$nor = $result->num_rows;
							if($nor==0){
								$u_id="U00001";
							}
							else{
								$rec=$result->fetch_assoc();
								$lid=$rec["u_id"];
								$num=substr($lid,1);
								$num++;
								$u_id=str_pad($num,5,'0',STR_PAD_LEFT);
								$u_id="U".$u_id;
							}
								return $u_id;
				}

			function reg_userCus(){

				$sql1="INSERT INTO tbl_user(u_id,email,pwd,conpwd,user_type)
				values('$this->u_id',
					   '$this->email',
					   '$this->pwd',
					   '$this->conpwd',
				       '$this->user_type');";

				$ref=$this->db->query($sql1);
					echo("Done");
			}

			function reg_userSup(){

				$sql1="INSERT INTO tbl_user(u_id,email,pwd,conpwd,user_type)
				values('$this->u_id',
					   '$this->email',
					   '$this->pwd',
					   '$this->conpwd',
				       '$this->user_type');";

				$ref=$this->db->query($sql1);
					echo("Done");
			}

			function reg_userEmp(){

				$sql1="INSERT INTO tbl_user(u_id,email,pwd,conpwd,user_type)
				values('$this->u_id',
					   '$this->email',
					   '$this->pwd',
					   '$this->conpwd',
					   '$this->user_type');";

				$ref=$this->db->query($sql1);
					echo("Done");
			}

			function user_login(){
				if(empty($_POST["email"]) || empty($_POST["password"])){//Check empty or not
					echo "empty";//if empty - return 'empty'
					exit;
				}

				else{//if variables are not empty
					$username=$_POST["email"];//catch username
					$password=md5($_POST["password"]);//catch pwd

						$sql = "SELECT * FROM tbl_user WHERE email='$username' AND pwd='$password'";//check uname and password against the user table

						$ref=$this->db->query($sql);//execute query
						$nor = $ref->num_rows;//check query
							if($nor==0){//if query is empty
									echo ("incorrect");//if not matches - return 'incorrect'
									exit;
							}
							else{
								while($row=$ref->fetch_assoc()){//if query is not empty
									$usr=new user();
									$usr->u_id = $row['u_id'];
									$usr->email = $row['email'];
									$usr->pwd =$row['pwd'];
									$usr->state =$row['state'];
									$usr->user_type =$row['user_type'];
								}

								if($usr->user_type=="1"){//check user type is 'Customer' or not
									include_once("c_customer.php");
										$cus=new customer();
											if($usr->state=='0'){
												echo "Disable";//if state is Disable return 'Disable'
												exit;
											}
											// elseif($usr->state=='Block'){
											// 	echo "Block";//if state is block return 'Block'
											// 	exit;
											// }
											else{//if customer state is 'Enable'
												$cus=$cus->get_ucus_byid("$usr->u_id");//Collect customer details into variable
												session_start();//session start
													$_SESSION['user']['cus']=$cus;//session create and assign session variable
														echo"Active";//return 'Enable'
														exit;
											}
								}
								elseif($usr->user_type!="1"){
									include_once("c_employee.php");
										$emp=new employee();
											if($usr->state=='0'){
												echo "Disable";//if state is Disable return 'Disable'
												exit;
											}
									// elseif($usr->user_state=='Block'){
									// 	echo "Block";//if state is block return 'Block'
									// 	exit;
									// }
											else{//if Employee state is 'Enable'
												$emp=$emp->get_uemp_byid("$usr->u_id");//Collect employee details into variable
												session_start();//session start
													$_SESSION['user']['emp']=$emp;//session create and assign session variable
														echo ("Active");//return 'Active'
														exit;
											}
								}
								else{
									echo "Not registered user type!";
								}
							}
				}
			}

			function validate_duplicate_email(){
				$sql = "SELECT u_id FROM tbl_user WHERE email = '".$this->email."';";
				//echo $sql;
				//exit();
				$result = $this->db->query($sql);
				$nor = $result->num_rows;
				if($nor > 0)
				{
					return FALSE;
				}
				else
				{
					return TRUE;
				}

			}			
		}
?>