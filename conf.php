<?php
//Connection information
$host = "localhost";
$dbname = "testdatabasemk1";
$user = "postgres";
$password = "simpsonwave";

// Connection
$dsn = "pgsql:host=$host;dbname=$dbname;user=$user;password=$password";
$conn= new PDO($dsn);

//connection check
if(!$conn) {
    die("Connection failed: " . pg_last_error());
}




?>