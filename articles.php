<?php

//required files

require('conf.php');
      
session_name('author_session');
session_start();

if(isset($_SESSION['author']) && ($_SESSION['id'])){
 ?> 

<!DOCTYPE html>
    <html lang="en-GB">
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Articles</title>
    </head>
    <body>
      <h1>Your Articles</h1>  
        <table>
          <tr>
              <th>Article ID</th>
              <th>Title</th>
              <th>Date</th>
              <th>Edit</th>
              <th>Delete</th>
          </tr>


          
          <?php 
          //SQL Query
          $query= "SELECT * FROM article WHERE authorid= :authorid";
          $stmt= $conn->prepare($query);

          //Binding parameters
          $stmt->bindParam(':authorid', $_SESSION['id']);
          
         //Executing
          $stmt->execute();

          while($stored = $stmt->fetch(PDO::FETCH_ASSOC)){?>
          <tr>
            <td><?php echo $stored['articleid']; ?> </td>
            <td><?php echo $stored['articletitle']; ?> </td>
            <td><?php echo $stored['articledate']; ?> </td>
            
            <td><a href= "edit.php?id=<?php echo $stored['articleid']; ?>">Edit</a> </td>
            <td><a href="deleteart.php?id=<?php echo $stored['articleid']; ?>">Delete</a> </td>
            
          </tr>
            <?php }?>
        </table>
      
      <div>
      <a href="dashboard.php" class="editorsubmit">Return</a>
      </div>
    </body>
    </html>
  <?php

} else{
    header('location: /dashboard.php');
  
  }
  ?>