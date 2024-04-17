<?php

session_name('author_session');
session_start();

if(isset($_SESSION['author']) && ($_SESSION['id'])){
  ?>



<!DOCTYPE html>
<html lang="en-GB">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/z19etwuwaxkvhz4ln5y4z30kch9czrh890lmd65iuz36xxuw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Drafts</title>
</head>
<body>
    <h1>Your Drafts</h1>
</body>
</html>

<?php

} else{
    header('location: /dashboard.php');
  //if (isset($_SESSION['author_session'])) {
  }
  ?>