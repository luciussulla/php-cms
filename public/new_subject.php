<?php require_once('../includes/session.php'); ?>
<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
<?php $layout_context="public"?>
<?php include('../includes/layouts/header.php');?>
<?php find_selected_page(); ?>
  
  <div class="main"> 
    <div class="navigation"> 
      <?php echo navigation($current_subject, $current_page) ?>
    </div>
    
    <div class="page">
      <?php echo message(); ?>
      <?php $errors = errors(); ?>
      <?php echo form_errors($errors) ?>

      <h2>Create Subject</h2>
      
      <form action="create_subject.php" method="post">
        <p>Menu name: 
          <input type="text" name="menu_name" value="" />
        </p>
        <p>Position:  
          <select name="position">
            <?php 
              $subject_set = find_all_subjects();
              $subject_count = mysqli_num_rows($subject_set);
              // the plus one is for a position where the item is last 
              for ($count=1; $count<= $subject_count+1; $count++) {
                echo "<option value=\"{$count}\">{$count}</option>";
            }?>
          </select>
        </p>
        <p>Visible:  
          <input type="radio" name="visible" value="0" />No &nbsp;
          <input type="radio" name="visible" value="1" />Yes
        </p>
        <input type="submit" name="submit" value="Create Subject">
      </form>

      <br/>
      <a href="manage_content.php">Cancel</a>
    </div>
  </div>

<?php include('../includes/layouts/footer.php') ?>