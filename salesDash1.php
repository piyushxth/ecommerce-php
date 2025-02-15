<?php
include "./connectServer.php";
session_start();

// Check if the user is authenticated (logged in)
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    // Redirect to the login page or display an error message
    header("Location: adminLogin.php"); // Redirect to the login page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
    <link rel="stylesheet" href="style2.css" />
</head>

<body>
    <section class="aside">
        <div class="top">
            <div class="logo">
                <img src="logo.png" alt="" />
                <h2>ICO<span class="danger">NIC</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        <div class="sidebar">
            <a href="" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp"> person_outline </span>
                <h3>Customer</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp"> receipt_long </span>
                <h3>Orders</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp"> analytics </span>
                <h3>Analytics</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp"> chat </span>
                <h3>Messages</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">inventory</span>
                <h3>Products</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Reports</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">settings</span>
                <h3>Settings</h3>
            </a>
            <a href="addProduct.php">
                <span class="material-icons-sharp">add</span>
                <h3>Add Product</h3>
            </a>
            <a href="">
                <span class="material-icons-sharp">logout</span>
                <h3>Log Out</h3>
            </a>
        </div>
    </section>

<section class="container">

      <div class="main">
        <h2>iconic</h2>
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
      </div>

      <div class="mains">
        <h2>Good Morning, Piyush</h2>
        <p>Here are your stats for today</p>
      </div>

      <div class="insights">
            <div class="column1">Column 1</div>
            <div class="column2">Column 2</div>
            <div class="column3">Column 3</div>
      </div>
    
</section>


</body>
</html>