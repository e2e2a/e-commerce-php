<?php
$servername = "localhost";
$port = 3306;
$dbname = "commerce"; 
$username = "root";     
$password = "";     

try {
    $con = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>