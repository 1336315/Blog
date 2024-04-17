<?php 
//List required files
require('conf.php');

//verify if the session is started

session_name('author_session');
session_start();

//Declaring XSS safe variables
$author=htmlspecialchars($_SESSION['author']);
$sessionid=htmlspecialchars($_SESSION['id']);
$getid=htmlspecialchars($_GET['id']);


if(isset($author) && ($id)){
    
    if(isset($getid)){

        //variables
        $artid=htmlspecialchars($_GET['id']);
        
        //SQL Query
        $query = "DELETE FROM article WHERE articleid=:articleid";
        $stmt= $conn->prepare($query);

        //Bind the parameters
        
        $stmt->bindParam(':articleid', $artid);

        //Execute the query
        $stmt->execute();

        echo "Your article was successfully deleted! Please, return to the dashboard.";
    } else{
        echo "Sorry, we couldn't get the required id";
    }
} else{
    header('location: /admlogin.html');
}
?>