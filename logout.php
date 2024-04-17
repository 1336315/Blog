<?php

   //Here, we are trying to end the session that we've started
    session_name('author_session');
    session_start();

    if(isset($_SESSION)){
    
    session_unset();
    session_destroy();
    header('location: index.php');

    exit();

 } else{
   
    header('location: index.php');
    exit();
 }

?>