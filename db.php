<?php
$host = "localhost";
$user = "USERNAME";
$pass = "PASSWORD";
$db = "DBNAME";

//mySQLi connection
$mysqli = new mysqli($host,$user,$pass,$db);
// Check connection
 if ($mysqli -> connect_errno) {
   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
   exit();
 }else{
    echo "mySQLi conn successful";
 }

//PDO Connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

?>
