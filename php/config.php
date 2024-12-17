<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "site_3008";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }

$baseUrl = 'http://localhost/SendBox-Chat-main/php/';

?>
