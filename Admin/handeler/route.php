<?php
  include_once("../lib/c_customer.php");
  include_once("../lib/c_employee.php");
    $emp= new employee();
    $cus=new customer();

      session_start();
        if(!isset($_SESSION['user'])){
          header("location:Admin/ui/test.php");
        }
        if(isset($_SESSION['user']['emp'])){ 
          $emp=$_SESSION['user']['emp'];
            $role=$emp->user_type;
              switch ($role){
                case "0":
                  header("location:../ui/Admin.php");
                  break;

                case "Company Staff":
                  header("location:Admin/ui/header.php");
                  break;
            }
        }
        else if(isset($_SESSION['user']['cus'])){
          header("location:../../../ShoppingCart/ui/index.php");
        }
?>
