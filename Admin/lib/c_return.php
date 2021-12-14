<?php
  /*import the datbase connection*/
  include_once("db_con.php");

    /*create a veribles that are required*/
    class return_itm{
      public $return_id;
      public $reason;
      public $r_date;
      public $cus_ord_no;
      public $p_id;
      public $qty;
      public $model_number;
      public $ordate;
      public $itm_code;
      PUBLIC $promo_price;
      public $itm_qty;
      public $sel_pri;
      public $remark;
      Public $RT;
      public $db;

      /*call to database function*/
        function __construct(){
          $this->db=new mysqli(server,user,pass,db);
        }

        function return_id(){
          $sql= "SELECT return_id FROM tbl_return ORDER BY return_id DESC LIMIT 1;";
            $result=$this->db->query($sql);
              if($this->db->errno){
                echo($this->db->error);
                exit;
              }
            $nor=$result->num_rows;
              if($nor==0){
                $return_id="R00001";
              }
              else{
                $rec=$result->fetch_assoc();
                $lid=$rec["return_id"];
                $num=substr($lid,1);
                $num++;
                $return_id=str_pad($num,5,'0',STR_PAD_LEFT);
                $return_id="R".$return_id;
              }
                return $return_id;
        }
       
        function get_bill_details($itm_code){
          $sql="SELECT tbl_cus_ord.cus_ord_no,tbl_customer.f_name,tbl_customer.l_name,tbl_cus_ord.ordate,tbl_product.model_number,tbl_ord_info.itm_code,tbl_ord_info.sel_pri,tbl_ord_info.p_id
                FROM tbl_ord_info
                LEFT JOIN tbl_product ON tbl_ord_info.p_id=tbl_product.p_id
                LEFT JOIN tbl_cus_ord ON tbl_ord_info.cus_ord_no=tbl_cus_ord.cus_ord_no
                LEFT JOIN tbl_customer ON tbl_cus_ord.cus_id=tbl_customer.cus_id
                WHERE tbl_ord_info.itm_code='$itm_code'";
          
          $send=mysqli_query($this->db,$sql);
          $row = $send->fetch_assoc();
            echo(json_encode($row));
        }

        function return_itm(){
          $sql="INSERT INTO tbl_return(return_id,r_date,cus_ord_no,remark)
                VALUES ('$this->return_id',
                        '$this->r_date',
                        '$this->cus_ord_no',
                        '$this->remark')";
          
          $res=$this->db->query($sql);
            if($this->db->errno){
             echo($this->db->error);
             exit;
            }
            if($res>0){
             echo ("Done");
            }
            else {
              echo ("Error");
            }
        }

        function return_itm_details(){
          $sql="UPDATE tbl_ord_info
                SET state ='Returned'
                WHERE itm_code='$this->itm_code'";

          $result=$this->db->query($sql);
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

        function return_itm_info(){
           $sql="INSERT INTO tbl_return_items(return_id,p_id,reason,cus_ord_no)
                 VALUES ('$this->return_id',
                         '$this->p_id',
                         '$this->reason',
                         '$this->cus_ord_no')";
          
          $res=$this->db->query($sql);
            if($this->db->errno){
             echo($this->db->error);
             exit;
            }
            if($res>0){
            }
            else {
              echo ("Error");
            }
        }

        function view_return(){
          $sql="SELECT tbl_return.return_id,tbl_return.remark,tbl_return.r_date,tbl_product.model_number,tbl_return_items.reason
                FROM tbl_return
                LEFT JOIN tbl_return_items ON tbl_return.return_id=tbl_return_items.return_id
                LEFT JOIN tbl_product ON tbl_return_items.p_id=tbl_product.p_id
                WHERE tbl_return_items.reason='Customer Request';";

          $result=$this->db->query($sql);//execute sql query

          while ( $row=$result->fetch_array()) {
            $re=new return_itm();
            $re->return_id=$row['return_id'];          
            $re->model_number=$row['model_number'];          
            $re->r_date=$row['r_date'];
            $re->remark=$row['remark'];
            $re->reason=$row['reason'];
            $ar[]=$re;  
          } 
          if(!empty($ar)){
            return $ar;
          }
          else{
            echo"No Records Found!";
          }
        }

        function get_info_return_back($return_id){
          $sql="SELECT tbl_return_items.cus_ord_no,tbl_product.model_number,tbl_return_items.p_id,tbl_return_items.return_id,tbl_return_items.reason
                FROM tbl_return_items
                LEFT JOIN tbl_product ON tbl_return_items.p_id=tbl_product.p_id
                WHERE tbl_return_items.reason='Customer Request' AND tbl_return_items.return_id='$return_id'";
          
          $result=$this->db->query($sql);//execute sql query
            $row = $result->fetch_assoc();
              return $row;

        }

        function add_return(){
          $ono = $this->cus_ord_no;
          $pid = $this->p_id;
          $sql="INSERT INTO tbl_return_new_itms(p_id,qty,promo_price)
                VALUES('$this->p_id',
                       '$this->qty',
                       '$this->promo_price')";

          $res=$this->db->query($sql);
            if($this->db->errno){
             echo($this->db->error);
             exit;
            }
            if($res>0){
              $sql="SELECT tbl_product.p_id, (tot_qty+qty) AS CUR_STOCK
                FROM tbl_return_new_itms
                LEFT JOIN tbl_product ON tbl_return_new_itms.p_id=tbl_product.p_id 
                where tbl_return_new_itms.p_id ='".$this->p_id."'";
          
              $ref=$this->db->query($sql);
                while($row=$ref->fetch_array()){
                  $re=new return_itm();
                  $p_id=$row['p_id'];
                  $cus_stock = $row['CUR_STOCK'];
                  $ar[]=$re;

                  $sql1="UPDATE tbl_product
                         SET tot_qty='".$cus_stock."'
                         WHERE p_id='$p_id'";
                  $result=$this->db->query($sql1);//execute sql quary
                    if($this->db->errno){
                      echo($this->db->error);
                      exit;
                    }
                }
                if($result>0) {
                  echo "Done";
                  $this->change_reason($ono, $pid);
                }
              }
              else {
                echo ("Error");
              }       
        }

        function change_reason($ono, $pid){
          $sql1="UPDATE tbl_return_items
                 SET reason='Done'
                 WHERE cus_ord_no='$ono' AND p_id='$pid'";
          $result=$this->db->query($sql1);//execute sql quary
            if($this->db->errno){
              echo($this->db->error);
              exit;
            }            
        }
  }
?>
