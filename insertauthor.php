<?php
//Connecting
require('conf.php');

//Defining hash parameters
$salt= utf8_encode(openssl_random_pseudo_bytes(16));
$iterations = 678;

//Collecting data
$author = $_POST['author_name'];
$email = $_POST['authoremail'];
$passphrase = utf8_encode((hash_pbkdf2("sha256", $_POST['passphrase'], $salt, $iterations)));

//Validating and preventing XSS


//parameterized SQL query
$code = "INSERT INTO author (author_name, passphrase, authoremail, salt) VALUES (:author_name, :passphrase, :authoremail, :salt)";
$stmt = $conn->prepare($code);

//bindind parameters
$stmt->bindParam(':author_name', $author);
$stmt->bindParam(':passphrase', $passphrase);
$stmt->bindParam(':authoremail', $email);
$stmt->bindParam(':salt', $salt);

// Execute SQL query
$stmt -> execute();



?>
