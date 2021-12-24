<?php $layout_context="public"; ?>

<?php require_once('../includes/session.php'); ?>
<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
<?php include('../includes/layouts/header.php');?>
<?php find_selected_page(true); ?>

  <div class="main">  
    <div class="navigation"> 
      <a href="admin.php">&laquo; Main Menu</a><br/>
      <?php 
        echo public_navigation($current_subject, $current_page); 
      ?>
      <br/>
      <a href="new_subject.php">+ Add new subject</a><br/>
    </div>

    <div class="page">
      <?php if($current_page) { ?>
  
        <h2>Manage Page</h2>

         <div class="view-content">
           <?php echo $current_page["content"]; ?>
         </div>

      <?php  } else { ?>
         Please selcect subject or a page.
       <?php } ?>
    </div>
  </div>

<?php include('../includes/layouts/footer.php') ?>