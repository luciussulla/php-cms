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
      <?php echo form_errors($errors); ?>

      <h2>Create Page</h2>
      
      <form action="create_page.php" method="post">
        
        <p>Menu name: 
          <input type="text" name="menu_name" value="" />
        </p>
        
        <p>Subject:
          <select name="subject_id">
            <?php 
              $subjects = find_all_subjects();
              foreach($subjects as $subject_obj) {
                echo "<option value=\"{$subject_obj["position"]}\">{$subject_obj["position"]}</option>"; 
              } 
            ?>
          </select>     
        </p>
        
        <p>Position:
          <select name="position">
            <?php $pages = find_all_pages($current_subject["id"]);
              $num_pages = mysqli_num_rows($pages);
              for ($i=1;$i<=$num_pages+1;$i++) {
                echo "<option value=\"{$i}\">{$i}</option>";
              }
            ?>
          </select>
        </p>
        
        <p>Visible:  
          <input type="radio" name="visible" value="0" />No &nbsp;
          <input type="radio" name="visible" value="1" />Yes
        </p>

        <p>Content: 
            <textarea name="content" value="">
            </textarea>
        </p>
        
        <input type="submit" name="submit" value="Create Page">
      </form>

      <br/>
      <a href="manage_content.php">Cancel</a>
    </div>
  </div>

<?php include('../includes/layouts/footer.php') ?>