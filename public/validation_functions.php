<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<?php 
  $errors = array();

  function has_presence($value) {
    return isset($value) && $value !== "") {
  }    

  function has_max_length($value, $max) {
   return strlen($value) <= $max;
  }

  function has_inclusion_in($value, $set) {
    return in_array($value, $set)
  }

  function form_errors($errors = array()) {
    $output = "";
    if(!empty($errors)) {
      $output .=  "<div class=\"error\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach($errors as $key=>$error) {
        $output .= "<li>{$error}</li>";
      }    
      $output .= "</ul>";
      $output .= "</div>";
    }    
    return $output;
  }

  function validate_max_lengths($fields_with_max_lengths) {
    global $errors;
    $fields_with_max_lengths = array("username"=> 30, 
    "password"=> 8);
    foreach($fields_with_max_lengths as $field => $max) {
      $value = trim($_POST[$field]);
      if(!has_max_length($value, $max)) {
        $error[$field] = ucfirst($field) . " is too long";
      }
    }
  }


   $min = 3;  
   //max len 
   $max = 6; 
   $value = "abcd";
   if(strlen($value) < $min ) {
    echo "Validation failed.</br>";
   }

   // type
   $value = "1";
   if(!is_string($value)) {
     echo "Validation failed.<br .>";
   }

   // inclusion in a set 
   $value = "1";
   $set = array("1","2","3","4");
   if(!in_array($value, $set)) {
     echo "Validation failed.<br .>";
   }

   //uniqueness 
  
   // format
   $regex = "/PHP/";
   $subject = "PHP is fund";
   if (preg_match($regex, $subject)) {
     echo "A match was found.";
   } else {
     echo "A match was not found.";
   }

   $value = "nobody@owhere.com";
   if(!preg_match("/@/", $value)) {
     echo "Validation failed.<br />";
   }

   print_r($errors);
?> 

<?php 
function form_errors($errors = array()) {
  $output = "";
  if(!empty($errors)) {
    $output .=  "<div class=\"error\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $key=>$error) {
      $output .= "<li>{$error}</li>";
    }    
    $output .= "</ul>";
    $output .= "</div>";
  }    
  return $output;
}
?>
<?php echo form_errors($errors); ?>
  
</body>
</html>