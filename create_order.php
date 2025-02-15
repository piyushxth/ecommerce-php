<?php
include "./connectServer.php";
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:userLogin.php');
}

if (isset($_POST['delete'])) {
    $cart_id = $_POST['cart_id'];

    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->execute([$cart_id]);
}

function formatTimestamp($timestamp) {
    return date('M j, Y g:ia', strtotime($timestamp));
}

// Modify the SQL query to fetch orders ordered by the latest created_at timestamp
$sql = "SELECT * FROM orders ORDER BY created_at DESC";

$select_products = $conn->prepare($sql);
$select_products->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
    <link rel="stylesheet" href="style3.css" />
    <style>
.container .mains{
    gap:1rem;
 align-items:center;
    display:flex;
}
    </style>
</head>

<body>
  <?php  include "adminSidebar.php"; ?>
  <section class="main">
       <div class="top">
        <img src="profile-1.png" alt="" />
                <h2>ICO<span class="danger">NIC</span></h2>
                </div>

                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="right">
                <div class="theme-toggler" id="theme-toggle-button">
                    <span class="material-icons-sharp active"> light_mode </span>
                    <span class="material-icons-sharp"> dark_mode </span>
                </div>
                <div class="profile-photo">
                        <img src="profile-1.jpg" />
                    </div>
                    </div>
</section>

    <section class="container">
      <div class="mains">
        <a href="adminOrder.php">O</a>
        <h2>Create Order</h2>
      </div>
</section>


      <script src="script.js"></script>
</body>
</html>