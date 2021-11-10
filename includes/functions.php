<?php 

  function confirm_query($result_set) {
    if(!$result_set) {
      die("Database query failed"); 
    }
  }

  function find_all_subjects() { 
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE visible = 1 ";
    $query .= "ORDER BY position ASC"; 
    $subject_set = mysqli_query($connection, $query); 
    confirm_query($subject_set);
    return $subject_set;
  }

  function find_all_pages($subject_id) {
    global $connection; 

    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE visible = 1 ";
    $query .= "AND subject_id = {$subject_id} ";
    $query .= "ORDER BY position ASC"; 
    $page_set = mysqli_query($connection, $query); 
    confirm_query($page_set);  
    return $page_set;
  }  

  function navigation() {
    global $selected_subject_id; 
    global $selected_page_id;

    $output = "<ul class=\"subjects\">";
    $subject_set = find_all_subjects(); 
    while($subject = mysqli_fetch_assoc($subject_set)) {      
      $output .= "<li ";
        if($subject["id"]==$selected_subject_id) {
          $output .= "class=\"selected\"";
        }  
        $output .= ">";
        $output .= "<a href=\"manage_content.php?subject=";
        $output .= $subject["id"];
        $output .= "\">";
        $output .= $subject["menu_name"] . " (" . $subject["id"] . ")";
        $output .= "</a>";
    
        $page_set = find_all_pages($subject["id"]);
        $output .= "<ul class=\"pages\">";
          while($page = mysqli_fetch_assoc($page_set)) {
            $output .= "<li";
            if($page["id"]==$selected_page_id) {
              $output .= " class=\"selected\"";
            }
            $output .= ">";
            $output .= "<a href=\"manage_content.php?page=";
            $output .= $page["id"];
            $output .= "\">";
            $output .= $page["menu_name"]; 
            $output .= "</a>";
            $output .= "</li>";
          }  
          mysqli_free_result($page_set);
        $output .= "</ul>";    
      $output .= "</li>";
    } 
    mysqli_free_result($subject_set);
    $output .= "</ul>";
    return $output; 
  }  
?>