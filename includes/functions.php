<?php 

  function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit; 
  }

  function mysql_prep($string) {
    global $connection;
    return mysqli_real_escape_string($connection, $string);
  }

  function confirm_query($result_set) {
    if(!$result_set) {
      die("Database query failed"); 
    }
  }

  function find_all_subjects($public=true) { 
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM subjects ";
    if($public) {
      $query .= "WHERE visible = 1 ";
    }
    $query .= "ORDER BY position ASC"; 
    $subject_set = mysqli_query($connection, $query); 
    confirm_query($subject_set);
    return $subject_set;
  }

  function find_all_pages($subject_id, $public=true) {
    global $connection; 
    
    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE subject_id={$subject_id} ";
    if($public) {
      $query .= "AND visible = 1 ";
    }
    $query .= "ORDER BY position ASC"; 
    
    $page_set = mysqli_query($connection, $query); 
    confirm_query($page_set);  
    return $page_set;
  }  

  function find_subject_by_id($subject_id) {
    global $connection;
    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
     
    $query =  "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id={$safe_subject_id} ";
    $query .= "LIMIT 1";

    $subject_set = mysqli_query($connection, $query); 
    confirm_query($subject_set);
    if($subject = mysqli_fetch_assoc($subject_set)) {
      return $subject; 
    } else {
      return null;
    }
  }

  function find_page_by_id($page_id) {
    global $connection; 
    $safe_page_id = mysqli_real_escape_string($connection, $page_id);

    $query = "SELECT * FROM pages "; 
    $query .= "WHERE id={$safe_page_id} ";
    $query .= "LIMIT 1"; 

    $page_set = mysqli_query($connection, $query);
    confirm_query($page_set); 

    if($page = mysqli_fetch_assoc($page_set)) {
      return $page;  
    } else {
      return null; 
    }
  }

  function find_selected_page() {
    global $current_page;
    global $current_subject;

    if (isset($_GET["page"]) && isset($_GET["subject"])) { // this option is for the edit_page.php since it receives both subject and page ids
      $current_page =    find_page_by_id($_GET["page"]); 
      $current_subject = find_subject_by_id($_GET["subject"]);
    } elseif (isset($_GET["subject"])) {
      $current_subject = find_subject_by_id($_GET["subject"]);
      $current_page = null; 
    } elseif(isset($_GET["page"])) {
      $current_page = find_page_by_id($_GET["page"]); 
      $current_subject = null; 
    } else {
      $current_subject = null; 
      $current_page = null;
    }
  }
  // passing object arguments 
  function navigation($subject_assoc, $page_assoc) {
    $output = "<ul class=\"subjects\">";
    $subject_set = find_all_subjects(false); // false makes sure we can see all items not only thosw with visibility=1 
    while($subject = mysqli_fetch_assoc($subject_set)) {      
      $output .= "<li ";  
        if($subject_assoc && $subject["id"]==$subject_assoc["id"]) {
          $output .= "class=\"selected\"";
        }  
        $output .= ">";
        $output .= "<a href=\"manage_content.php?subject=";
        $output .= urlencode($subject["id"]);
        $output .= "\">";
        $output .= htmlentities($subject["menu_name"]) . " (" . $subject["id"] . ")";
        $output .= "</a>";
        
        $page_set = find_all_pages($subject["id"], false);
        $output .= "<ul class=\"pages\">";
          while($page = mysqli_fetch_assoc($page_set)) {
            $output .= "<li";
            if($page_assoc && $page["id"]==$page_assoc["id"]) {
              $output .= " class=\"selected\"";
            }
            $output .= ">";
            $output .= "<a href=\"manage_content.php?page=";
            $output .= urlencode($page["id"]);
            $output .= "\">";
            $output .= htmlentities($page["menu_name"]); 
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

  function public_navigation($subject_assoc, $page_assoc) {
    // echo print_r($page_assoc); 
    $output = "<ul class=\"subjects\">";
    $subject_set = find_all_subjects(); 
    while($subject = mysqli_fetch_assoc($subject_set)) {      
      $output .= "<li ";  
      if($subject_assoc && $subject["id"]==$subject_assoc["id"]) {
        $output .= "class=\"selected\"";
      }  
      $output .= ">";
      $output .= "<a href=\"index.php?subject=";
      $output .= urlencode($subject["id"]);
      $output .= "\">";
      $output .= htmlentities($subject["menu_name"]);
      $output .= "</a>";
      // show only pages for selected subject 
      if($subject_assoc) {
        if($subject["id"]==$subject_assoc["id"]) {
          $page_set = find_all_pages($subject["id"]);
          $output .= "<ul class=\"pages\">";
            while($page = mysqli_fetch_assoc($page_set)) {
              $output .= "<li";
              if($page_assoc && $page["id"]==$page_assoc["id"]) {
                $output .= " class=\"selected\"";
              }
              $output .= ">";
              $output .= "<a href=\"index.php?subject={$subject_assoc["id"]}&page=";
              $output .= urlencode($page["id"]);
              $output .= "\">";
              $output .= htmlentities($page["menu_name"]); 
              $output .= "</a>";
              $output .= "</li>";
            }  
            mysqli_free_result($page_set);
          $output .= "</ul>";   
        }
      }    
      $output .= "</li>"; // end of subject li
    } 
    mysqli_free_result($subject_set);
    $output .= "</ul>";
    return $output; 
  }  

  function form_errors($errors = array()) {
    $output = "";
    if(!empty($errors)) {
      $output .=  "<div class=\"error\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach($errors as $key=>$error) {
        $output .= "<li>";
        $output .= $error; 
        $output .= "</li>";
      }    
      $output .= "</ul>";
      $output .= "</div>";
    }    
    return $output;
  }

?>