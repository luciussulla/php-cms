<?php 
  $errors = array();  
 
  function fieldname_as_text($fieldname) {
    $fieldname = str_replace("_", " ", $fieldname);
    $fieldname = ucfirst($fieldname);
    return $fieldname; 
  }

  function has_presence($value) {
    return isset($value) && $value !== '';
  }    

  function has_max_length($value, $max) {
   return strlen($value) <= $max;
  }

  function has_inclusion_in($value, $set) {
    return in_array($value, $set);
  }

  function validate_max_lengths($fields_with_max_lengths) {
    global $errors;
    foreach($fields_with_max_lengths as $field => $max) {
      $value = trim($_POST[$field]);
      if(!has_max_length($value, $max)) {
        $error[$field] = fieldname_as_text($field) . " is too long";
      }
    }
  }

  function validate_presences($required_fields) {
    global $errors;
    foreach($required_fields as $field) {
      // let's check that user 've sent the visible variable at all, otherewise we'll get an error
      if(isset($_POST[$field])) {
        $value = trim($_POST[$field]); 
      } else {
        $value = "";
      }

      if(!has_presence($value)) {
        $errors[$field] = fieldname_as_text($field) . " can't ba blank";
      }
    }
  }
?>