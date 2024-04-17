<?php 
//We want this file to update already published articles

//List required files

require('conf.php');

//verify if the session is started

session_name('author_session');
session_start();

if (isset($_POST['Update'])){

    if (isset($_GET['id'])){
        //If no image is passed(do conditional)
        if ($_FILES['newimage']['size'] == 0){

        //Declare variables
        $newtitle = $_POST['New_Title'];
        $newcontent = $_POST['tinyeditor'];
        $artid = $_GET['id'];

        //SQL Query
        $query1 = "UPDATE article SET articletitle=:articletitle, articlelink=:articlelink WHERE articleid=:articleid";
        $stmt= $conn->prepare($query1);

        //Bind the parameters
        $stmt->bindParam(':articletitle', $newtitle);
        $stmt->bindParam(':articlelink', $newcontent);
        $stmt->bindParam(':articleid', $artid);

        //Execute the query
        $stmt->execute();

        echo "Your article was successfully updated! Please, proceed to the dashboard.";
        die();
        
        } else{

        //Declare variables
        $newtitle = $_POST['New_Title'];
        $newcontent = $_POST['tinyeditor'];
        $artid = $_GET['id'];
        $newimg = $_FILES['newimage'];

            //treating the new image
            if ($_FILES['newimage']['error'] === 0) {
                if ($_FILES['newimage']['size'] > 125000) {
                    echo 'Sorry, your new image is too large';
                    die();
                } else {

                    $newimgext = pathinfo($_FILES['newimage']['name'], PATHINFO_EXTENSION); 
                    $getnewimgext = strtolower($newimgext);
                    $acceptableexs = array('jpg', 'jpeg', 'png');

                    if(in_array($getnewimgext, $acceptableexs)){
                    $newimgname = uniqid("IMG-", true).'.'.$getnewimgext;
                    $imgpath = 'uploads/'.$newimgname;
                    move_uploaded_file($_FILES['newimage']['tmp_name'], $imgpath);
                    } else{
                        echo "Sorry, this file's type is not accepted. The accepted types are: jpg, jpeg and png.";
                        die();
                    }
                }

            }   
        }
        //SQL Query
        $query2 = "UPDATE article SET articletitle=:articletitle, articlelink=:articlelink, mainimage=:mainimage WHERE articleid=:articleid";
        $stmt= $conn->prepare($query2);

        //Bind the parameters
        $stmt->bindParam(':articletitle', $newtitle);
        $stmt->bindParam(':articlelink', $newcontent);
        $stmt->bindParam(':mainimage', $newimg);
        $stmt->bindParam(':articleid', $_GET['id']);

        //Execute the query
        $stmt->execute();
        
        header('location: /articles.php');
    } else{
        echo "Sorry, we couldn't get the required id";
    }

} else{
    header('location: /dashboard.php');
}
?>