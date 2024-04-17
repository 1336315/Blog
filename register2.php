<?php
//this file is an experimental one to generate code in a linear manner instead of functions for signin.php

if (isset($_POST['submit'])) {
//input variables
$username = $POST_['username'];
$useremail = $POST_['useremail'];
$password = hash_pbkdf2('sha256',$_POST['password'], $salt, $iterations, 52);

//handling empty entries
    if (empty($username || $useremail || $password)) {
        header('location:  /signin.php?error=missinginput');
    }

    //Validating E-mails
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        header('location: /signin.php?error=email');
    }
    
    //Verifying Passwords
    if ($password != $verpassword) {
        header('location: /signin.php?error=mismatchedpasswords');
    }

    //Checking the Database
    
    $stmt = $conn->prepare('SELECT userid, username, useremail FROM users WHERE username = ? AND userpassphrase = ?');
    $stmt->execute([$username, $password]);
    $stmt->fetch();
}
else{
    header('location: /login.php');
    exit();
}
?>