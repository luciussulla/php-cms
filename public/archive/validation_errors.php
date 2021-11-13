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

   // presence 
   $value = trim("0");
   if(!isset($value) || $value ==="") {
     echo "Validation failed.</br>";
     $errors['value'] = "Value can't be blank";
   }    
   // string length 
   // minimumlen 
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