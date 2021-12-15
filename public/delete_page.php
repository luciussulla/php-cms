<?php require_once('../includes/session.php'); ?>
<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
<?php require_once('../includes/validation_functions.php');?>

<?php find_selected_page(); ?>

<?php
  $page = find_page_by_id($_GET["page"]); 
  if(!$page) {
    $_SESSION["message"] = "Page was missing";
    redirect_to("manage_content.php");
  }

  

  $id = $current_page["id"]; 
  $query = "DELETE FROM pages "; 
  $query .= "WHERE id={$id} "; 
  $query .= "LIMIT 1"; 

  $result = mysqli_query($connection, $query);
  if ($result && mysqli_affected_rows($connection) == 1) {
    $_SESSION["message"] = "Page deleted";
    redirect_to("manage_content.php");
  } else {
    $_SESSION["message"] = "Error deleting page";
    redirect_to("manage_content.php?page={$id}");
  }

?>