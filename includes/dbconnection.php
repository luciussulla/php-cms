<?php 
  //1. Create db connection
  define("DB_SERVER", "localhost"); 
  define("DB_USER",   "root"); 
  define("DB_PASS",   ""); 
  define("DB_NAME",   "cms"); 

  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  
  if(mysqli_connect_errno()) {
    die("Databse connection failed: " . 
      mysqli_connect_error() . 
      " (" . mysqli_connect_errno() . ")" 
    ); 
  }
?>