<?php require_once('../includes/session.php'); ?>
<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
<?php find_selected_page(); ?>
<?php include('../includes/layouts/header.php');?>
<?php 
      if(!$current_subject) {
        // subject ID was missing
        // subject cound not be found in DB 
        redirect_to("manage_content.php");
      }
?>
  
  <div class="main"> 
    <div class="navigation"> 
      <?php echo navigation($current_subject, $current_page) ?>
    </div>

    <div class="page">
      <?php echo message(); ?>
      <?php $errors = errors(); ?>
      <?php echo form_errors($errors) ?>

      <h2>Edit Subejct <?php echo $current_subject["menu_name"] ?></h2>

      <form action="edit_subject.php" method="post">
        <p>Menu name: 
          <input type="text" name="menu_name" value="<?php echo $current_subject["menu_name"] ?>" />
        </p>
        <p>Position:
          <select name="position">
            <?php 
              $subject_set = find_all_subjects();
              $subject_count = mysqli_num_rows($subject_set);
              for ($count=1; $count<= $subject_count; $count++) {
                echo "<option value=\"{$count}\"";
                if($count == $current_subject["position"]) {echo " selected";}
                echo ">{$count}</option>";
              }
            ?>
          </select>
        </p>
        <p>Visible:  
          <input type="radio" name="visible" value="0" <?php if ($current_subject["visible"] === 0) { echo "checked=\"checked\"";} ?> />No &nbsp;
          <input type="radio" name="visible" value="1" <?php if ($current_subject["visible"] === 1) { echo "checked=\"checked\"";} ?> />Yes
        </p>
        <input type="submit" name="submit" value="Edit Subject">
      </form>

      <br/>
      <a href="manage_content.php">Cancel</a>
    </div>
  </div>

<?php include('../includes/layouts/footer.php') ?>