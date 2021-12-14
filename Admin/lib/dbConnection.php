<?php

 // query connect to database
$con=mysqli_connect("localhost","root","","agro_project");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


?>