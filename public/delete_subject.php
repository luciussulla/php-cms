<?php require_once('../includes/session.php'); ?>
<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
<?php require_once('../includes/validation_functions.php');?>

<?php find_selected_page(); ?>

<?php 
  $current_subject = find_subject_by_id($_GET["subject"]);
  if(!$current_subject) {
    // subject ID was missing
    // subject cound not be found in DB 
    redirect_to("manage_content.php");
  }
  // make sure all pages from subject are deleted before we delete the subject 
  $pages_for_subject = find_all_pagses($current_subject["id"]);
  if(mysqli_num_rows($pages_for_subject)>0) {
    $_SESSION["message"] = "Can't delete subject with pages";
    redirect_to("manage_content.php");
  }

  $id = $current_subject["id"];
  $query = "DELETE FROM subjects ";
  $query .= "WHERE id={$id} ";
  $query .= "LIMIT 1";

  $result = mysqli_query($connection, $query); 
  if($result && mysqli_affected_rows($connection) == 1) {
    // success
    $_SESSION["message"] = "Subject deleted";
    redirect_to("manage_content.php");
  } else {
    // failure
    $_SESSION["message"] = "Subject delete failed";
    redirect_to("manage_content.php?subject={$id}"); 
  }
?>