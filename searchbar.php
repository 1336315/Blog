<?php 
//We want to use this file to search for articles for the searchbar at header.php

//List required documents
require('conf.php');

//Declare GET 
$text = htmlspecialchars($_GET['s']);

//Declare variables
$originalquery = ("%"."$text"."%");
$searchquery = ($originalquery);

//SQL query
$sql="SELECT * FROM  article WHERE UPPER(articletitle) LIKE UPPER(:searchquery)";

$stmt = $conn->prepare($sql);

//Bind parameters
$stmt->bindParam(':searchquery', $originalquery);

//Execute
$stmt->execute();

//Retrieving content
/*$returned = $stmt->fetch(PDO::FETCH_ASSOC);

$title = $returned['articletitle'];
$convttitle = str_replace('_', " ", $title);*/

while ($returned = $stmt->fetch(PDO::FETCH_ASSOC)){
    $title= $returned['articletitle'];
    $convttitle = str_replace('_', " ", $returned['articletitle']);
    $image=$returned['mainimage'];
    $path = "uploads/" . $image;
    
    //echo $convttitle['articletitle'];?>
    <a href="article.php?title=<?php echo $title?>"<div id="searchquery"><img src="<?php echo $path; ?>"/><?php echo $convttitle; ?></div></a>

<?php    
}

//Sending the JSON
/*header('Content-type: application/json');
echo json_encode($convttitle);*/

?>