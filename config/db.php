<?php

$host = 'localhost'; 
$dbname = 'bookstore';
$username = 'root'; 
$password = '';      

try {
    // PDO instance 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Connected to the database successfully!";
    
} catch (PDOException $e) {

    die("Connection failed: " . $e->getMessage());
}
?>
