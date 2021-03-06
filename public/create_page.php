<?php require_once('../includes/session.php'); ?>
<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
<?php require_once('../includes/validation_functions.php');?>

<?php 
  if (isset($_POST['submit'])) {

    // process the form   
    $menu_name = mysql_prep($_POST["menu_name"]);
    $position = (int) $_POST["position"];
    $visible = (int) $_POST["visible"]; // this will be typecast by mysql into boolean
    $content = $_POST["content"];
    $subject_id = (int) $_POST["subject_id"];
    
    // validations
    $required_fields = array("menu_name", "position", "visible", "content");
    validate_presences($required_fields); // this function internally uses suberglobal $_POST variable

    $fields_with_max_lengths = array("menu_name"=>30); 
    validate_max_lengths($fields_width_max_lengths);//this function internally uses suberglobal $_POST variable

    // display errors 
    if (!empty($errors)) { // errors created in validation functions and made a global variable 
      $_SESSION["errors"] = $errors; 
      redirect_to("new_page.php");
      // the redirect has exit after it so it will not call anything after 
    }
    
    // Perform db query
    $query  = "INSERT INTO pages (";
    $query .= "subject_id, menu_name, position, visible, content"; 
    $query .= ") VALUES (";
    $query .= "{$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}'";
    $query .= ")";

    // redirect 
    $result = mysqli_query($connection, $query);
    if($result) {
      $_SESSION["message"] = "Page created.";
      redirect_to("manage_content.php");
    } else {
      $_SESSION["message"] = "Page creation failed.";
      redirect_to("new_page.php");
    }
    
  } else {
    // Probably a GET request
    redirect_to("new_page.php");
  }
?>

<?php if(isset($connection)) { mysqli_close($connection);} ?>