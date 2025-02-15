<?php
include "./connectServer.php";

$sql = "CREATE DATABASE IF NOT EXIST $dbname";
if ($conn->query($sql)) {
    echo 'Database connected';
} else {
    echo "Database already exist or failed creation";
}
?>