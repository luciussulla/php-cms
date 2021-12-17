<?php 
$layout_context="admin"; 
if(!isset($layout_context)) {
  $layout_context="public";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Widget Corp <?php if($layout_context=="admin") {echo "Admin";} ?></title>
  <link href="styles/style.css" rel="stylesheet" />
</head> 
<body>
  <div class="header">
    <h1>Widget Corp
      <?php if($layout_context=="admin") {echo "Admin";} ?>
      <?php if($layout_context=="public") {echo "Public";} ?>
  </h1>
  </div>