<?php
include "./connectServer.php";

session_start();
session_unset();
session_destroy();

header('Location:iconicWebsite.php');
exit();
?>