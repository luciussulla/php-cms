<?php require_once('../includes/session.php'); ?>
<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
<?php include('../includes/layouts/header.php');?>
<?php find_selected_page(); ?>

  <div class="main"> 
    <div class="navigation"> 
      <?php echo navigation($current_subject, $current_page) ?>
      <br/>
      <a href="new_subject.php">+ Add new subject</a>
    </div>

    <div class="page">
      <?php echo message(); ?>
      <?php if($current_subject) { ?>
       <h2>Manage Subject</h2> 
        Menu Name: <?php echo $current_subject["menu_name"]; ?> <br/>
        <a href="edit_subject.php?subject=<?php echo $current_subject["id"];?>">Edit subject</a>
      <?php } elseif($current_page) { ?>
        <h2>Manage Page</h2>
         Menu Name: <?php echo $current_page["menu_name"] ?> <br/>
      <?php  } else { ?>
         Please selcect subject or a page.
       <?php } ?>
    </div>
  </div>

<?php include('../includes/layouts/footer.php') ?>