<?php 
//We want to edit articles with this file

//required files

require('conf.php');
      
//verify if the session is started

session_name('author_session');
session_start();

if(isset($_SESSION['author']) && ($_SESSION['id'])){

    if(isset($_GET['id'])){
    
    //SQL Query
    $query= "SELECT * FROM article WHERE articleid= :articleid";
    $stmt= $conn->prepare($query);

    $artid = $_GET['id'];

    //Binding parameters
    $stmt->bindParam(':articleid', $artid);
    $stmt->execute(); 

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

   

    
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
        <title>Edit your article</title>
    </head>
    <body>
        
        <form action="update.php?id=<?php echo $artid; ?>" method="POST" enctype="multipart/form-data" class="forms">
        <h2>Edit your article</h2>
        <div class="texteditor"></div>
            <div class="compform">
                <label for="Article_Title">Title</label></div>
                <input type="text" id="article_title" name="New_Title" class="titleinput" value="<?php echo $result['articletitle'] ?>" placeholder="Your Title">
            </div>
            <div class="compform">
                <label for="newimage">Change your main image</label></div>
                <input type="file" accept="image/*"  name="newimage" class="" value="">
            </div>
            
            <div class="compform">
                
                <div id="quilleditor">
                
                <textarea name="tinyeditor" id="tinyeditor"><?php echo $result['articlelink'] ?></textarea>
                    
                </div>   
            </div>
        </div>
                   
            <input method='POST' type="submit" enctype="multipart/form-data" class="editorsubmit" name="Update" value="Update">
            
            <a href="articles.php" class="editorsubmit">Return</a>
            <script src="editortiny.js"></script>
    </body>
</html>

<?php 
}else{
    //header('location: /dashboard.php');}
    echo "We couldn't get your article ID";}
} else{
    header('location: /dashboard.php');
}
?>