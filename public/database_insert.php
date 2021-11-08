<?php require_once('../includes/dbconnection.php') ?>

<?php 
  $menu_name =  "Edit me"; 
  $position = 4; 
  $visible = 1; 

  //$query = "INSERT INTO subjects (menu_name, position, visible) 
  //VALUES ('{$menu_name}', {$position}, {$visible})"; 

  $query =  "INSERT INTO subjects (";
  $query .= "menu_name, position, visible"; 
  $query .= ") VALUES (";
  $query .= " '{$menu_name}', {$position}, {$visible}";
  $query .= ")";

  $result = mysqli_query($connection, $query); 
  
  if(!$result) {
    die("Db query failed"); 
  }
?>