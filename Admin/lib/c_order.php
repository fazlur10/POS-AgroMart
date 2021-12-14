<?php
	include_once("db_con.php");

		class order{

			public $cus_ord_no;
			public $cus_id;
			public $payment_id;
			public $p_id;
			public $itm_code;
			public $itm_qty;
			public $sel_pri;
			public $sub_tot;
			public $gtot;
			public $dis;
			public $ntot;
			public $amt;
			public $bal;
			public $p_m_id;
			public $order_type;


			private $db;

				function __construct(){
					$this->db=new mysqli(server,user,pass,db);
				}

				function order_id(){
					$sql= "SELECT cus_ord_no FROM tbl_cus_ord ORDER BY cus_ord_no DESC LIMIT 1;";
					$result=$this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
					$nor=$result->num_rows;
						if($nor==0){
							$cus_ord_no="O00001";
						}
						else{
							$rec=$result->fetch_assoc();
							$lid=$rec['cus_ord_no'];
							$num=substr($lid,1);
							$num++;
							$cus_ord_no=str_pad($num,5,'0',STR_PAD_LEFT);
							$cus_ord_no="O".$cus_ord_no;
						}
							return $cus_ord_no;
				}

				function load_cus(){
					$sql="SELECT * FROM tbl_customer WHERE user_status='Active'";
					$result=$this->db->query($sql);
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}
						while($record = $result->fetch_assoc()){
							echo ("<option value=".$record['cus_id'].">".$record['f_name']." ".$record['l_name']."</option>");
						}
				}

				function load_payment_type(){
					$sql="SELECT p_m_id,payment_method FROM  tbl_payment_types WHERE p_m_id='P00001';";
					$send=mysqli_query($this->db,$sql);
					$array =array();
						while($data=mysqli_fetch_array($send)){
							array_push($array,array('p_m_id'=>$data['p_m_id'],'payment_method'=>$data['payment_method'],));
						}
							return $array;
				}

				function add_cus_order(){
					$sql="INSERT INTO tbl_cus_ord(cus_ord_no,cus_id,ordate,order_type,status)
						  values('$this->cus_ord_no', '$this->cus_id', now(), '$this->order_type','1');";
					$ref=$this->db->query($sql);
						echo("Done");		
							if($this->db->errno){
								echo($this->db->error);
								exit;
							}	
				}

				function add_ord_info(){
					if(is_array($this->p_id)){
						$cv=0;
						foreach($this->p_id as $id){
							$sql= "INSERT INTO tbl_ord_info(cus_ord_no,p_id,itm_code,itm_qty,sel_pri,sub_tot) 
								   values('$this->cus_ord_no','".$this->p_id[$cv]."','".$this->itm_code[$cv]."','".$this->itm_qty[$cv]."','".$this->sel_pri[$cv]."','".$this->sub_tot[$cv]."')";

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

				function make_payment(){
					$sql= "INSERT INTO tbl_payment(payment_id,p_m_id,cus_ord_no,gtot,dis,ntot,amt,bal)
						   values('$this->payment_id',
								  '$this->p_m_id',
								  '$this->cus_ord_no',
								  '$this->gtot',
								  '$this->dis',
								  '$this->ntot',
								  '$this->amt',
								  '$this->bal');";

					$ref=$this->db->query($sql);
						echo("Done");		
						if($this->db->errno){
							echo($this->db->error);
							exit;
						}	
				}

				function view_orders(){
					$sql= "SELECT tbl_ord_info.itm_code,tbl_cus_ord.cus_ord_no,tbl_cus_ord.ordate,tbl_customer.f_name,
                           tbl_product.model_number,tbl_product.p_id,tbl_payment.ntot 
						   FROM tbl_cus_ord 
						   LEFT JOIN tbl_ord_info ON tbl_cus_ord.cus_ord_no=tbl_ord_info.cus_ord_no 
						   LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id 
						   LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no 
					  	   LEFT JOIN tbl_product ON tbl_ord_info.p_id=tbl_product.p_id
						   WHERE tbl_ord_info.state='sold' 
						   ORDER BY tbl_cus_ord.cus_ord_no DESC";

					$ref=$this->db->query($sql);
						while($row=$ref->fetch_array()){

							$or=new order();
							$or->itm_code=$row['itm_code'];
							$or->cus_ord_no=$row['cus_ord_no'];
							$or->ordate=$row['ordate'];
							$or->f_name=$row['f_name'];
							$or->model_number=$row['model_number'];
							$or->ntot=$row['ntot'];

							$ar[]=$or;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}	
				}

            function view_walking_orders(){
                $sql = "SELECT tbl_cus_ord.cus_ord_no,tbl_cus_ord.ordate,tbl_customer.f_name,tbl_customer.l_name,tbl_payment.gtot,
                        tbl_payment.dis, tbl_payment.ntot 
                        FROM tbl_cus_ord 
                        LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id 
                        LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no 
                        WHERE tbl_cus_ord.order_type = 'walking order' AND tbl_cus_ord.status = '1'
                        ORDER BY tbl_cus_ord.cus_ord_no DESC";

                $ref=$this->db->query($sql);
                while($row=$ref->fetch_array()){

                    $or=new order();
                    $or->cus_ord_no=$row['cus_ord_no'];
                    $or->ordate=$row['ordate'];
                    $or->f_name=$row['f_name'];
                    $or->l_name=$row['l_name'];
                    $or->gtot=$row['gtot'];
                    $or->dis=$row['dis'];
                    $or->ntot=$row['ntot'];

                    $ar[]=$or;
                }
                if(!empty($ar)){
                    return $ar;
                }
                else{
                    echo"No Records Found!";
                }
            }
			
			            function view_dept_orders(){
                $sql = "SELECT tbl_customer.cus_id, tbl_customer.f_name,tbl_customer.l_name,SUM(tbl_payment.gtot), 
				SUM(tbl_payment.amt), SUM(tbl_payment.ntot), SUM(tbl_payment.bal) 
				FROM tbl_cus_ord LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id 
				LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no 
				WHERE tbl_cus_ord.order_type = 'walking order' AND tbl_cus_ord.status = '1' GROUP BY tbl_customer.cus_id";

                $ref=$this->db->query($sql);
                while($row=$ref->fetch_array()){

                    $or=new order();
                    $or->dcus_id=$row['cus_id'];
                    $or->df_name=$row['f_name'];
                    $or->dl_name=$row['l_name'];
                    $or->dgtot=$row['SUM(tbl_payment.gtot)'];
                    $or->damt=$row['SUM(tbl_payment.amt)'];
                    $or->dntot=$row['SUM(tbl_payment.ntot)'];
                    $or->dbal=$row['SUM(tbl_payment.bal)'];
                    $ar[]=$or;
                }
                if(!empty($ar)){
                    return $ar;
                }
                else{
                    echo"No Records Found!";
                }
            }
			
			function get_dept_byid($cus_id){
			    	$sql = "SELECT tbl_customer.cus_id, tbl_customer.f_name,tbl_customer.l_name,SUM(tbl_payment.gtot), 
				SUM(tbl_payment.amt), SUM(tbl_payment.ntot), SUM(tbl_payment.bal) 
				FROM tbl_cus_ord INNER JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id 
				INNER JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no 
				WHERE tbl_cus_ord.order_type = 'walking order' AND tbl_cus_ord.status = '1' AND tbl_customer.cus_id='$cus_id';";

			    	$result=$this->db->query($sql);//execute sql query

			    	$row = $result->fetch_assoc();
			    		return $row;
		 		}

            function online_orders(){
                $sql = "SELECT tbl_cus_ord.cus_ord_no,tbl_cus_ord.ordate,tbl_customer.f_name,tbl_customer.l_name,tbl_payment.gtot,
                        tbl_payment.dis, tbl_payment.ntot 
                        FROM tbl_cus_ord 
                        LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id 
                        LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no 
                        WHERE tbl_cus_ord.order_type = 'online order' AND tbl_cus_ord.status = '1'
                        ORDER BY tbl_cus_ord.cus_ord_no DESC";

                $ref=$this->db->query($sql);
                while($row=$ref->fetch_array()){

                    $or=new order();
                    $or->cus_ord_no=$row['cus_ord_no'];
                    $or->ordate=$row['ordate'];
                    $or->f_name=$row['f_name'];
                    $or->l_name=$row['l_name'];
                    $or->gtot=$row['gtot'];
                    $or->dis=$row['dis'];
                    $or->ntot=$row['ntot'];

                    $ar[]=$or;
                }
                if(!empty($ar)){
                    return $ar;
                }
                else{
                    echo"No Records Found!";
                }
            }

				function return_pro($cus_ord_no){
					$sql= "UPDATE tbl_ord_info
						   SET state='return'
						   WHERE cus_ord_no='$cus_ord_no'";

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
			    
			    function update_stock2($cus_ord_no){
			    	$sql="SELECT tbl_product.p_id, (tot_qty-itm_qty) AS CUR_STOCK
			    		  FROM tbl_ord_info
			    		  LEFT JOIN tbl_product ON tbl_ord_info.p_id=tbl_product.p_id 
			    		  WHERE cus_ord_no ='".$cus_ord_no."'";
			    	
			    	$ref=$this->db->query($sql);
				    	while($row=$ref->fetch_array()){
				    		$or=new order();
				    		$p_id=$row['p_id'];
				    		$cus_stock = $row['CUR_STOCK'];
				    		
				    		$ar[]=$or;

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

				function getdetails_for_bill($cus_ord_no){
					$sql="SELECT tbl_payment.*
						  FROM tbl_payment 
						  WHERE tbl_payment.cus_ord_no='$cus_ord_no'";
					
					$result=$this->db->query($sql);//execute sql query
             		$row = $result->fetch_assoc();
                		return $row;
				}

				function get_bill_details($cus_ord_no){
					$sql= "SELECT tbl_payment.*,tbl_cus_ord.*,tbl_ord_info.*,tbl_customer.f_name,tbl_customer.l_name,tbl_product.model_number
						   from tbl_cus_ord
						   LEFT JOIN tbl_payment ON tbl_cus_ord.cus_ord_no=tbl_payment.cus_ord_no
						   LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id
						   LEFT JOIN tbl_ord_info ON tbl_cus_ord.cus_ord_no=tbl_ord_info.cus_ord_no
						   LEFT JOIN tbl_product ON tbl_ord_info.p_id=tbl_product.p_id
						   WHERE tbl_cus_ord.cus_ord_no='$cus_ord_no'";

					$result=$this->db->query($sql);//execute sql query
             	
					while($row=$result->fetch_array()){

							$or=new order();
							$or->p_id=$row['p_id'];
							$or->model_number=$row['model_number'];
							$or->sel_pri=$row['sel_pri'];
							$or->itm_qty=$row['itm_qty'];
							$or->sub_tot=$row['sub_tot'];

							$ar[]=$or;
						}
						if(!empty($ar)){
							return $ar;
						}
						else{
							echo"No Records Found!";
						}	
				}

				function getNotifyCount(){
                    $sql = "SELECT COUNT(*) as notify_count
                            FROM tbl_cus_ord
                            WHERE order_type = 'online order';";
                    $ref=$this->db->query($sql);//execute sql query

                    $row = $ref->fetch_assoc();//fetch result into an associative array
                    echo(json_encode($row));//pass result to the frontend using json
                }

            //function to get notification details in to the list
            function getNotifyDetails(){
                $sql = "SELECT tbl_customer.f_name, tbl_customer.l_name
                        FROM tbl_customer
                        JOIN tbl_cus_ord ON tbl_customer.cus_id = tbl_cus_ord.cus_id
                        WHERE order_type = 'online order'
                        ORDER BY tbl_cus_ord.cus_ord_no DESC;";
                $result=$this->db->query($sql);//execute sql query

                if($this->db->errno){
                    echo($this->db->error);//if database error occurs..echo it to the frontend
                    exit;//exit from the function
                }
                $nDetailsarr = array(); //define an array to make an associative array

                while($record = $result->fetch_assoc() ){
                    $nDetails['fname'] = $record["f_name"];
                    $nDetails['lname'] = $record["l_name"];
                    array_push($nDetailsarr, $nDetails); //INSERT the retrieved records INTO the defined array
                }
                echo (json_encode($nDetailsarr)); //echo the array to front end
            }

            function getMonthWiseOrders(){
                $year = $_POST['year'];
                $sql = "SELECT MONTHNAME(tbl_cus_ord.ordate) AS month_name, COUNT(*)
                        AS No_of_orders
                        FROM tbl_cus_ord
                        WHERE YEAR(tbl_cus_ord.ordate) = '$year' AND tbl_cus_ord.order_type = 'online order'
                        GROUP BY MONTH(tbl_cus_ord.ordate);";

                $result=$this->db->query($sql);

                if($this->db->errno){
                    echo($this->db->error);
                    exit;
                }

                $data = array();
                foreach ($result as $row) {
                    $data[] = $row;
                }
                echo json_encode($data);
            }

            function getMonthWiseSales(){
                $year = $_POST['year'];
                $sql = " SELECT MONTHNAME(tbl_cus_ord.ordate) AS month_name, SUM(tbl_payment.ntot)
                         AS Balance
                         FROM tbl_cus_ord
                         JOIN tbl_payment ON tbl_cus_ord.cus_ord_no = tbl_payment.cus_ord_no
                         WHERE YEAR(tbl_cus_ord.ordate) = '$year'
                         GROUP BY MONTH(tbl_cus_ord.ordate);";

                $result=$this->db->query($sql);

                if($this->db->errno){
                    echo($this->db->error);
                    exit;
                }

                $data = array();
                foreach ($result as $row) {
                    $data[] = $row;
                }
                echo json_encode($data);
            }
						
		}
?>