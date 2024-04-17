<?php

session_name('author_session');
session_start();

if(isset($_SESSION['author']) && ($_SESSION['id'])){
  ?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    </head>
    <body>
      <h1>Dashboard</h1>  
      <div>
        <ul>
            <li><a href="articles.php">Articles</a></li>
            <li><a href='texteditor.php'>New Article</a></li>
            <li><a href="drafts.php">Drafts</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </body>
    </html>

<?php
 
} else{
  header('location: /admlogin.html');
//if (isset($_SESSION['author_session'])) {
}
?>



