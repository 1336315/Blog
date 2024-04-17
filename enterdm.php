<?php

//This file is supposed to log authors from adminlogin.html into the dashboard panel in order to manage the blog and its contents

//Step 0 - Connecting the file to the connection file that connects to the database

require('conf.php');

//Step 1 - Verifying if this page was accessed via a POST method from the entry form

if(isset($_POST['enter'])){
    
    //Here we have the main code

//Step2 - Checking if the entries are filled correctly
    $authorname = htmlspecialchars($_POST['author_name']);
    $authoremail = htmlspecialchars($_POST['authoremail']);
    $password = htmlspecialchars($_POST['passphrase']);

    if(isset($authorname) || isset($authoremail) || isset($password)) {
        if(strlen($authorname)==0){
        echo "Please, fill in your name";
        } else if (strlen($authoremail)==0){
            echo "Please, fill in your email";
        } else if (strlen($password)==0){
            echo "Please, write your password";
        } else{

            //Here the code will proceed if the variables are filled in correctly

//Step 3 - Variable declaration
           
            
            $authorname = htmlspecialchars($_POST['author_name']);
            $authoremail = htmlspecialchars($_POST['authoremail']);
            $password = htmlspecialchars($_POST['passphrase']);
            
            
//Step 4- Declaring the SQL Query
            $sql = "SELECT * FROM author WHERE author_name = :authorname AND authoremail = :authoremail";
            $stmt = $conn->prepare($sql);

            //Binding parameters
            $stmt->bindParam(':authorname', $authorname);  
            $stmt->bindParam(':authoremail', $authoremail);
            

            //Executing the query
            $stmt->execute();       
            
            //fetching the result

            $author_name = $stmt->fetch(PDO::FETCH_ASSOC);

            
            //Hashing variables
            $salt = ($author_name['salt']);
            $iterations = 678;
            $ssalt = ($salt);

            //Comparing the hashes
            $hashedPassword = (hash_pbkdf2('sha256', htmlspecialchars($_POST['passphrase']), $ssalt, $iterations ));
          
            
                    
            if ($hashedPassword == htmlspecialchars($author_name['passphrase'])){

                if($stmt->rowCount()==1 ){
                    
                    //"Congrats! You've logged in."; 
                    if(!isset($_SESSION)) {
                        session_name('author_session');
                        session_start();
                        $_SESSION['author'] = $author_name['author_name'];
                        $_SESSION['id'] = $author_name['authorid'];
                        header('location: dashboard.php');
                    
                        
                        exit();
                    }
            
                } else{
                    echo "Sorry, your query couldn't be found. Please try again.";
                }
            } else{
                echo 'Sorry, your password is incorrect';
            }    

        }
}
}else{

    //If this file was accessed by means other than the login pages

    header('location: /index.php');
}
?>