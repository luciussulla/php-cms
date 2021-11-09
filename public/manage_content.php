<?php require_once('../includes/dbconnection.php');?>
<?php require_once('../includes/functions.php');?>
<?php include('../includes/layouts/header.php');?>

<?php 
  if (isset($_GET["subject"])) {
    $selected_subject_id = $_GET["subject"];
    $selected_page_id = null;
  } elseif(isset($_GET["page"])) {
    $selected_page_id = $_GET["page"];
    $selected_subject_id = null; 
  } else {
    $selected_subject_id = null; 
    $selected_page_id = null;
  }
?>

  <div class="main"> 
    <div class="navigation"> 
      <ul class="subjects">
        <?php $subject_set = find_all_subjects(); ?> 
        
        <?php while($subject = mysqli_fetch_assoc($subject_set)) { ?>      
            <?php 
             echo "<li ";
             if($subject["id"]==$selected_subject_id) {
               echo "class=\"selected\"";
             }  
             echo ">";
            ?>
            <a href="manage_content.php?subject=<?php echo $subject["id"]?>"><?php echo $subject["menu_name"] . " (" . $subject["id"] . ")";?></a>
            <?php $page_set = find_all_pages($subject["id"]); ?>

            <ul class="pages">
               <?php while($page = mysqli_fetch_assoc($page_set)) { ?>
                  <?php 
                    echo "<li";
                    if($page["id"]==$selected_page_id) {
                      echo " class=\"selected\"";
                    }
                    echo ">";
                  ?>
                  <a href="manage_content.php?page=<?php echo $page["id"]?>"><?php echo $page["menu_name"]; ?></a></li>
               <?php } ?> 
               <?php mysqli_free_result($page_set); ?>
            </ul>
                
          </li>
        <?php } ?>
        <?php mysqli_free_result($subject_set); ?>
      </ul>
    </div>

    <div class="page">
      <h2>Manage Content</h2>
      <?php echo $selected_page_id ?>
      <?php echo $selected_subject_id ?>
    </div>
  </div>

<?php include('../includes/layouts/footer.php') ?>