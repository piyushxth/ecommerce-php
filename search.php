<?php
include "./connectServer.php";
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search Bar</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style1.css" />
    <style>
        /* Search Section */

        .search-container {
            display: flex;
            margin: 2rem;
            align-items: center;
        }

        #searchInput {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            flex-grow: 1;
        }

        #searchButton {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
        }

        #searchButton:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<?php $currentPage='search.php'; include "user_header.php"; ?>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search for products...">
        <div id="suggestions" class="suggestions"></div>
    </div>




    <div id="productDetails" class="product-details">
        <!-- Product details will be displayed here -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="script1.js"></script>
</body>

</html>