<?php
 
session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['username'])) 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
 <div  class="formcard"></div>
  <section>
   
    <form action="enter2.php" method="POST" class="forms">
        <h1>Login Here</h1>
        <div class="compform">
            <label for="username" >Your Name</label></br>
            <input type="text" id="username" name="username" class="datainput" value=""></br>
        </div> 
        <div class="compform">
            <label for="useremail">Your Email Address</label></br>
            <input type="text" id="useremail" name="useremail" class="datainput" value=""></br>
        </div> 
        <div class="compform">  
            <label for="password">Your Password</label>
            </br>
            <input type="password" id="password" name="password" class="datainput" value="">
        </div>        
        </br>
        <input type="submit" class="submitbutton" value="Enter" name="submit">
    </form>
  </section>
 </div>   

   ?>
</body>
</html>