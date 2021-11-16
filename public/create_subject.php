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
    
    // validations
    $required_fields = array("menu_name", "position", "visible");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("menu_name"=>30); 
    validate_max_lengths($fields_width_max_lengths);
    
    if (!empty($errors)) {
      $_SESSION["errors"] = $errors; 
      redirect_to("new_subject.php");
      // the redirect has exit after it so it will not call anything after 
    }

    // Perform db query
    $query  = "INSERT INTO subjects (";
    $query .= " menu_name, position, visible"; 
    $query .= ") VALUES (";
    $query .= " '{$menu_name}', {$position}, {$visible}";
    $query .= ")";

    // redirect 
    $result = mysqli_query($connection, $query);
    if($result) {
      $_SESSION["message"] = "Subject created.";
      redirect_to("manage_content.php");
    } else {
      $_SESSION["message"] = "Subject creation failed.";
      redirect_to("new_subject.php");
    }
    
  } else {
    // Probably a GET request
    redirect_to("new_subject.php");
  }
?>

<?php if(isset($connection)) { mysqli_close($connection);} ?>