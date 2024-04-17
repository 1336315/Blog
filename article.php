<?php 
//ISSUES: DB: USE TITLES AS PRIMARY KEY(TWO ARTICLES WITH SAME TITLE WOULD BRAKE THE SYSTEM)

//List required files
require('conf.php');

//Dealing with sessions
session_name('author_session');
session_start();

/*if(isset($_SESSION['author']) && ($_SESSION['id'])){
?>
<?php 
} else{
    header('location: /login.php');
}*/

$title = htmlspecialchars($_GET['title']);
//Getting the data passed
if(isset($title)){
    
//SQL Query
$query= "SELECT * FROM article WHERE articletitle=:articletitle";
$stmt= $conn->prepare($query);

$arttitle = htmlspecialchars($_GET['title']);

//Binding parameters
$stmt->bindParam(':articletitle', $arttitle);
$stmt->execute(); 

$result = $stmt->fetch(PDO::FETCH_ASSOC);

$imgname = $result['mainimage'];

$imgpath = 'uploads/' . $imgname;



$eartitle = str_replace('_', " ", $arttitle);
?>
<?php include("header.php");?>

        <title><?php echo $eartitle; ?></title>
    </head>
    <body>
    
    <h1 style="color:#003153;"><?php echo $eartitle; ?> </h1>
    <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; text-align: center; color: #003153;"><?php echo $result['articledate']; ?></p>
    <!--<p><//?php echo $result['author_name']?></p>-->

    <?php if(file_exists($imgpath)){
    echo '<img src =" ' . $imgpath . '" alt=Image">';
    }?>

    <div>
    <p id="article"><?php echo $result['articlelink']; ?></p>
    </div>
    <h2 style="color:#003153;">Comments</h2>

    <?php if (isset($_SESSION['user_session'])){?>
        <textarea placeholder="Write your comment..."></textarea>
    <?php }else{?>
        <h2 style="color:#003153;">Please login to write your comment</h2>
    <?php } ?>

    <?PHP //Here we'll need a second SQL Query to pick comments from the comment table
    //SQL Query(Alter later to pick the article's title instead)
    $queryc= "SELECT * FROM cmmt WHERE articleid = :articleid";
    $secstmt= $conn->prepare($query);  

    //Variables
    //$articleid = echo $result['articleid'];
     
    //$secstmt->bindParam(':cmmtid', $arttitle);
    $secstmt->bindParam(':articleid', $arttitle);

    ?>

    </body>
<?php 
} else{
    header('location: /index.php');
}
?>