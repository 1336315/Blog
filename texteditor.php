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
    <title>New Article</title>
</head>
<body>
    
    <form action="publish.php" method="POST" enctype="multipart/form-data" class="forms">
        <div class="texteditor"></div>
            <div class="compform">
                <label for="Article_Title">Title</label></div>
                <input type="text" id="article_title" name="Article_Title" class="titleinput" value="" placeholder="Your Title">
            </div>
            <div class="compform">
                <label for="mainimage">Upload your main image</label></div>
                <input type="file" accept="image/*"  name="mainimage" class="" value="">
            </div>
            
            <div class="compform">
                <!--<label for="articlecontent">Text</label></br>-->
                <div id="quilleditor">
                
                    <textarea name="tinyeditor" id="tinyeditor" placeholder="Start writing!"></textarea>
                    
                </div>   
            </div>
        </div>
            
            <input method='POST' type="submit" enctype="multipart/form-data" type="submit" class="editorsubmit" name="Publish" value="Publish">
            <input method='POST' type="submit" enctype="multipart/form-data" class="editorsubmit" name="Save Draft" value="Save Draft">
            
            <a href="articles.php" class="editorsubmit">Return</a>


        <!--</div>-->
        
    </form>
    <script src="editortiny.js"></script>

</body>
</html>

<?php

} else{
    header('location: /dashboard.php');
  //if (isset($_SESSION['author_session'])) {
  }
  ?>