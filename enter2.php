<?php

//This is an experimental action file for login.php

//Step 0 - Declaration of required files

require('conf.php');

//Step 1 Verify if submit button is setted

if(isset($_POST['submit'])){

    //the main code goes in here

    if(isset($_POST['username']) || isset($_POST['useremail']) || isset($_POST['password'])) {
        
        if(strlen($_POST['username'])== 0) {
            echo "Please, write your username";
        } else if(strlen($_POST['useremail'])== 0) {
            echo 'Please, write your email address';
        } else if(strlen($_POST['password'])==0) {
            echo 'Please, write your password';
        } else{

            //Variable declaration goes in here 
            $usernamecheck = $_POST['username']; 
            $emailcheck = $_POST['useremail'];
            $salt = openssl_random_pseudo_bytes(16);
            //$passcheck = hash_pbkdf2('sha256',$_POST['password'], $salt, 48, 52);

            //sql query
            $sql = "SELECT * FROM users WHERE username = :usernamecheck AND useremail = :useremail";
            $stmt = $conn->prepare($sql);

            //Assigning parameters

            $stmt->bindParam(':usernamecheck', $usernamecheck);
            $stmt->bindParam(':useremail', $emailcheck);
            $stmt->bindParam(':passcheck', $passcheck);

            $stmt->execute();

            //Counting the rows

            $rowquantity = $stmt->rowCount();

            //Starting the session (or not)

            if($rowquantity ==1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if(!isset($_SESSION)) {
                    session_name('user_session');
                    session_start();
                }
                $_SESSION['user'] = $row['username'];
                $_SESSION['id'] = $row['userid'];
                header('location:  /index.php');
            } else {
                echo "Sorry, your entries couldn't be found. Please try again.";
            }
        } 

        
    }
} else{
        
    // if this file was accessed by means other than the post method

    header('location: /login.php');
}
?>