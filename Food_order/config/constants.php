<?php

//   Start the session
   session_start();

  //Create constants to store non-repeating values
  define('SITEURL','http://localhost/food_order/');
  define('LOCALHOST','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_NAME','food_order');

  // 3.Execute the query and set the data in database
  $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn)); //Database Connection
  $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error($conn)); //selecting database

?>