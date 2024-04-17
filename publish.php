<?php
//ISSUES: CHANGE THE ARTICLE TITLE UPLOAD TO CHANGE ALL SPACES TO UNDESCORES!

//In this file, we want to publish articles written in texteditor.php and publish then in the website

//Required files

require('conf.php');

//verify if the session is started

session_name('author_session');
session_start();

if(isset($_SESSION['author']) && ($_SESSION['id'])){

    if(isset($_POST['Publish']) || isset($_POST['Save Draft']) ){

        //main loop

        if(isset($_POST['Article_Title']) || isset($_POST['mainaimage']) || isset($_POST['tinyeditor'])) {
            //error cases
            if(strlen($_POST['Article_Title']==0)) {
                //header()
                echo "Please, write your Title";
                
            } elseif($_FILES['mainimage']['size']==0){
                echo "Please, upload your main image";

            } else if(strlen($_POST['tinyeditor']==0)) {
                echo "Please, write your article";
            } else{
            //main code
            if (isset($_POST['Publish'])) {

                //variable declaration
                $artitle = $_POST['Article_Title'];
                $uartitle = str_replace(' ', '_', $artitle);
                $mainimage = $_FILES['mainimage'];
                $arttext = $_POST['tinyeditor'];
                $date = date('Y-m-d');
                $authorid = $_SESSION['id'];

                if ($_FILES['mainimage']['error'] === 0) {
                    if ($_FILES['mainimage']['size'] > 125000) {
                        echo 'Sorry, your main image is too large';
                    } else {

                        $mainimgext = pathinfo($_FILES['mainimage']['name'], PATHINFO_EXTENSION); 
                        $getmainimgext = strtolower($mainimgext);
                        $acceptableexs = array('jpg', 'jpeg', 'png');

                        if(in_array($getmainimgext, $acceptableexs)){
                        $nmainimgname = uniqid("IMG-", true).'.'.$getmainimgext;
                        $imgpath = 'uploads/'.$nmainimgname;
                           move_uploaded_file($_FILES['mainimage']['tmp_name'], $imgpath);
                        } else{
                            echo "Sorry, this file's type is not accepted. The accepted types are: jpg, jpeg and png.";

                        }
                    }

                }


                //SQL QUERY 

                $query = "INSERT INTO article(authorid, articletitle, articledate, articlelink, mainimage) VALUES (:authorid,:articletitle, :articledate, :articlelink, :mainimage)";
                $stmt = $conn->prepare($query);

                //binding parameters
                $stmt->bindParam(':authorid' , $authorid );
                $stmt->bindParam(':articletitle', $uartitle);
                $stmt->bindParam(':articledate', $date);
                $stmt->bindParam(':articlelink', $arttext);
                $stmt->bindParam(':mainimage', $nmainimgname);

                
                
                //Executing the SQL query
                $stmt->execute();

                if ($stmt !== false) {
                echo "Your file was successfully uploaded!";
                header('location: dashboard.php');
            
                } else{
                    echo "Sorry, there was an error.";
                }
                
                header('location: dashboard.php');
                die();
            
            } else if(isset($_POST['Save Draft'])){
            //Save for later SQL Query
            $savequery = "INSERT INTO todolist(authorid, incompart_title, lastdate, incompartcontent, mainimage) VALUES (:authorid, :incompart_title, :lastdate, :incompartcontent, :mainimage)";

            //binding parameters
            $stmt->bindParam(':authorid' , $authorid);
            $stmt->bindParam(':imcompart_title', $uartitle);
            $stmt->bindParam(':lsatdate', $date);
            $stmt->bindParam(':incompartcontent', $arttext);
            $stmt->bindParam(':mainimage', $nmainimgname);

            //Executing the SQL Query
            $stmt->execute();

            //Checking if it's saved
            if ($stmt !== false) {
                echo "'Your file was successfully saved!'";
                header('location: dashboard.php');
                } else{
                    echo "Sorry, there was an error.";
                }
                header('location: dashboard.php');
                die();

            }
            
            
        }
        }


    } else{
        header('location: /admlogin.html');
    }    
} else{
    header('location: /admlogin.html');
}
?>