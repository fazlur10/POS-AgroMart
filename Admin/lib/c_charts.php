<?php
	include_once("db_con.php");
	
		class charts{

			public $db;

				function __construct(){
					$this->db=new mysqli(server,user,pass,db);
				}

				function income_today_tot(){
					$today=date('Y-m-d');
					$sql="SELECT SUM(tbl_payment.ntot) AS netTot, tbl_cus_ord.* FROM tbl_payment
						LEFT JOIN tbl_cus_ord ON tbl_payment.cus_ord_no=tbl_cus_ord.cus_ord_no
						WHERE tbl_cus_ord.ordate='$today';";

					$result=$this->db->query($sql);
					$row = $result->fetch_assoc();
					if ($row['netTot']=='') {
						echo "0.00";
					}
					else {
						echo $row['netTot'];
					}
              		
				}				

				function income_month_tot(){
					$today =date('Y-m');
					$month = date('m');
					$year = date('Y');
					$sql="SELECT SUM(tbl_payment.ntot) AS netTot, tbl_cus_ord.* FROM tbl_payment
						LEFT JOIN tbl_cus_ord ON tbl_payment.cus_ord_no=tbl_cus_ord.cus_ord_no
						WHERE MONTH(tbl_cus_ord.ordate)= $month AND YEAR(tbl_cus_ord.ordate)=$year";

					$result=$this->db->query($sql);
					$row = $result->fetch_assoc();
					if ($row['netTot']=='') {
						echo "0.00";
						// echo $month;
					}
					else {
						echo $row['netTot'];
						// echo $year;
						// echo date('m');
					}
              		
				}
		}
?>