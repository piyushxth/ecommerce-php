<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ICONIC';


    // Create a PDO connection
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
  
?>
