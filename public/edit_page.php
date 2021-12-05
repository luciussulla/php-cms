<?php require_once('../includes/session.php'); ?>
<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
<?php require_once('../includes/validation_functions.php'); ?>
<?php find_selected_page(); ?>
<?php include('../includes/layouts/header.php'); ?>
<?php 
  if (isset($_POST['submit'])) {
    // validations set the errors global variable to use in the conditional
    $required_fields = array("menu_name", "visible", "position");
    validate_presences($required_fields);

    $fields_width_max_lengths = array("menu_name"=>30); 
    validate_max_lengths($fields_width_max_lengths);
    
    if (empty($errors)) {
      // process the form   
      $id = $current_page["id"];
      $menu_name = mysql_prep($_POST["menu_name"]);
      $position = (int) $_POST["position"];
      $visible = (int) $_POST["visible"]; 
      // this will be typecast by mysql into boolean
      
      // Perform db query
      $query  = "UPDATE pages SET "; 
      $query .= "menu_name='{$menu_name}', ";
      $query .= "position={$position}, ";
      $query .= "visible={$visible} ";
      $query .= "WHERE id={$id} ";
      $query .= "LIMIT 1"; 
      // send query
      $result = mysqli_query($connection, $query);
      // more equal because if values are the same it will return 0 not 1. When we have error we will get -1;
      if($result && mysqli_affected_rows($connection)>=0) {
        $_SESSION["message"] = "Subject edited.";
        redirect_to("manage_content.php");
      } else {
        $message = "Subject edit failed.";
      }
    }   
  } else {
    // Probably a GET request when you visite the edit page for the 1st time
    // just display the form
  }
?>  

<?php 
  if(!$current_page) {
    // page ID was missing
    // page cound not be found in DB 
    redirect_to("manage_content.php");
  }
?>
  
<div class="main"> 
  <div class="navigation"> 
    <?php echo navigation($current_subject, $current_page) ?>
  </div>

  <div class="page">
    <?php 
      if(isset($_GET["subject"])) {
        echo "<p>Subject is {$_GET["subject"]} </p>";
      }
      if(isset($_GET["page"])) {
        echo "<p>Page is set {$_GET["page"]} </p>";
      }

      // if there were any error on the DB side
      if(!empty($message)) {
        // $message is just a variable (look up) it does not use the session variable;
        echo "<div class=\"message\">" . htmlentities($message) ."</div>";
      }
    ?>
    <!-- errors are stored as global $errors variable in the validation_functions.php --> 
    <?php echo form_errors($errors) ?>

    <h2>Edit Page <?php echo htmlentities($current_page["menu_name"]); ?></h2>

    <form action="edit_page.php?page=<?php echo urlencode($current_page["id"]);?>" method="post">
      <!-- we need to send the page's hidden id -->
      <p>Page's Subject id: <?php echo $current_page["subject_id"] ?> </p>
      <input type="hidden" value="<?php echo $current_page["subject_id"] ?>" /> 

      <p>Page's menu name: 
        <input type="text" name="menu_name" value="<?php echo htmlentities($current_page["menu_name"]); ?>" />
      </p>

      <p>Position:
        <select name="position">
          <?php 
            $page_set = find_all_pages($current_page["subject_id"]);
            $page_count = mysqli_num_rows($page_set);
            for ($count=1; $count<= $page_count; $count++) {
              echo "<option value=\"{$count}\"";
              if($count == $current_page["position"]) {echo " selected";}
              echo ">{$count}</option>";
            }
          ?>
        </select>
      </p>

      <p>Visible:  
        <input type="radio" name="visible" value="0" <?php if ($current_page["visible"] === 0) { echo "checked=\"checked\"";} ?> />No &nbsp;
        <input type="radio" name="visible" value="1" <?php if ($current_page["visible"] === 1) { echo "checked=\"checked\"";} ?> />Yes
      </p>

      <input type="submit" name="submit" value="Edit Page">
    </form>

    <br/>
    <a href="manage_content.php">Cancel</a>
    &nbsp;
    &nbsp;
    <a href="delete_page.php?page=<?php echo urlencode($current_page["id"]);?>" onclick="return confirm('Are you sure?');">Delete page</a>
  </div>
</div>

<?php include('../includes/layouts/footer.php') ?>