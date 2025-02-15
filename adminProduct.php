<?php
// include "./connectServer.php";
// session_start();

// // Check if the user is authenticated (logged in)
// if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
//     // Redirect to the login page or display an error message
//     header("Location: adminLogin.php"); // Redirect to the login page
//     exit;
// }
include "./connectServer.php";
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:userLogin.php');
};

if(isset($_POST['delete'])){
    $cart_id = $_POST['cart_id'];
  
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->execute([$cart_id]);
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
    <link rel="stylesheet" href="style3.css" />
    <style>
    .recent-order table {
        border: 1px solid rgb(222, 226, 230);
    }
    </style>
</head>

<body>
    <?php $currentPage='adminProducts.php';include "adminSidebar.php"; ?>
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
            <h2>Products</h2>
        </div>

        <div class="productsMain">
            <button>Active</button>
            <button>Active</button>
            <button>Active</button>
            <div class="right">
                <input type="text" id="searchInput" placeholder="Search for products...">
                <a href="add_product.php"> <button>Add Product</button></a>
            </div>
        </div>


        <div class="recent-order">

            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Inventory</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
        $select_products = $conn->prepare("SELECT * FROM products"); 
        $select_products->execute();
        function formatTimestamp($timestamp) {
            return date('M j, Y g:ia', strtotime($timestamp));
        }
        if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
                    <form action="" method="post" class="box">
                        <tr>
                            <td><input type="checkbox" class="rowCheckbox"></td>
                            <td><?= $fetch_product['ProductName']; ?></td>
                            <td><?= $fetch_product['ProductPrice']; ?></td>
                            <td><?= $fetch_product['inventory']; ?></td>
                            <td class="warning">Pending</td>
                            <td class="primary"><?= formatTimestamp($fetch_product['created_at']); ?></td>
                            <td></td>
                        </tr>

                        <?php
}
}else{
echo '<p class="empty">Your Cart is empty!</p>';
}
?>
                    </form>
                </tbody>
            </table>
            <a href="#">Show All</a>
        </div>
    </section>


    <script src="script.js"></script>
</body>

</html>