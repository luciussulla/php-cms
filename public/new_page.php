<?php require_once('../includes/session.php'); ?>
<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
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
        <p>Position:  
          <select name="position">
            position here...
          </select>
        </p>
        <p>Subject:
          <select>
            <?php $subjects = find_all_subjects();
                  foreach($subjects as $subject_obj) {
                    echo "<option value=\"{$subject_obj["position"]}\">{$subject_obj["position"]}</option>"; 
                  } 
            ?>
          </select>     
        </p>
        <p>Visible:  
          <input type="radio" name="visible" value="0" />No &nbsp;
          <input type="radio" name="visible" value="1" />Yes
        </p>
        <p>Content: 
            <textarea name="content">
            </textarea>
        </p>
        <input type="submit" name="submit" value="Create Page">
      </form>

      <br/>
      <a href="manage_content.php">Cancel</a>
    </div>
  </div>

<?php include('../includes/layouts/footer.php') ?>