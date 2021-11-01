<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
<?php 
  $query = "SELECT * "; 
  $query .= "FROM subjects "; 
  $query .= "WHERE visible = 1"; 
  $query .= "ORDER BY position ASC"; 
  $result = msqli_query($connection, $query); 
  // Test if there was query error 
  confirm_query($result); 
?>
<?php include('../includes/layouts/header.php');?>
  <div class="main">
    <div class="navigation">
      <ul class="subjects">
        <?php while($subject = mysqli_fetch_assoc($result)) { ?>      
          <li><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")"; ?></li>
        <?php } ?>
      </ul>
    </div>
    <div class="page">
      <h2>Manage Content</h2>
     
    </div>
  </div>
<?php mysqli_free_result($result); ?>
<?php include('../includes/layouts/footer.php') ?>