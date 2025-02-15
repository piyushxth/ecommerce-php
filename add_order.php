<?php
include "./connectServer.php";
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:userLogin.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="style3.css">
    <style>
    .container .mains {
        gap: 1rem;
        align-items: center;
        display: flex;
    }

    form label {
        display: inline-block;
        font-size: 14px;
        font-weight: 500;
        color: var(--color-dark-variant);
    }

    form input {
        background: var(--color-white);
        border: 1px solid rgb(206, 212, 218);
        padding: 5px;
        color: var(--color-dark-variant);
        margin-bottom: 10px;
    }

    .form-container {
        line-height: 1.55;
        margin-top: 1rem;
        margin-left: 1rem;
    }

    .product-select {
        background: var(--color-white);
        margin-bottom: 15px;
        padding-top: 10px;
    }

    .product-select h2 {
        padding: 10px;

    }

    .product-select input {
        background: rgb(136, 48, 247);
        color: rgb(255, 255, 255);
        border: none;
        border-radius: 6px;
        padding: 8px 15px;
        margin-bottom: 20px;
        cursor: pointer;
        margin-left: 1rem;
    }

    .add_order input {
        border-radius: 4px;
    }

    .customer_details,
    .delivery-group,
    .discount-group {
        display: flex;
        flex-direction: column;
        background: var(--color-white);
        padding: 10px;
        margin-bottom: 15px;
    }

    .form-row,
    .delivery-group .form-row:nth-child(1),
    .discount-group .form-row:nth-child(1) {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }

    .form-row:nth-child(1) {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
        gap: 10px;
    }

    .input-group {
        flex-basis: 100%;
        display: flex;
        flex-direction: column;
    }

    .input-group label {
        margin-bottom: 5px;
    }


    .input-group input,
    .input-group textarea {
        border: 1px solid rgb(206, 212, 218);
        color: var(--color-dark-variant);
        border-radius: 4px;
    }

    #submit,
    #select-products {
        background: rgb(136, 48, 247);
        color: rgb(255, 255, 255);
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        margin-bottom: 15px;
        margin-left: 1rem;
    }

    .quick-view {
        position: fixed;
        top: 0;
        left: 0;
        min-height: 100vh;
        width: 100%;
        background: rgb(0, 0, 0, .8);
        display: none;
        justify-content: center;
    }

    .quick-view.show {
        display: flex;
    }

    .quick-view .search {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 5px;
        margin-top: 1rem;
    }

    .quick-view .search #select-close {
        padding: 5px;
        border: none;
        border-radius: 4px;
        background-color: rgb(136, 48, 247);
        color: rgb(255, 255, 255);
        cursor: pointer;
    }

    .quick-view .search input {
        flex-grow: 1;
        width: auto;
        border: 1px solid rgb(206, 212, 218);
        color: var(--color-dark-variant);
        font-size: 0.88rem;
        padding: 10px;
        border-radius: 4px;
    }

    .quick-view .view {
        border-radius: 4px;
        background: var(--color-white);
        padding: 15px;
        margin: 5rem;
        width: 40rem;
    }

    .quick-view .product-info {
        display: flex;

    }

    .quick-view .view .top {
        display: flex;
        justify-content: space-between;
    }

    .quick-view .view .top i {
        padding-right: 15px;
        cursor: pointer;
    }

    .quick-view .view img {
        margin: 5px;
        width: 25px;
        height: 25px;
        border-radius: 4px;
    }

    .quick-view .tick {
        display: flex;
    }
    </style>
</head>

<body>
    <?php $currentPage='adminOrder.php';include "adminSidebar.php"; ?>
    <?php include "adminTop.php"; ?>

    <section class="container">
        <div class="mains">
            <a href="adminOrder.php"><i class="fa-solid fa-arrow-left"></i></a>
            <h2>Add Order</h2>
        </div>

        <div class="add_order">
            <div class="form-container">
                <form action="submit_order.php" method="POST">

                    <div class="product-select">
                        <h2>Products</h2>
                        <button type="button" id="select-products">Select Products</button>
                    </div>

                    <div class="customer_details">
                        <div class="form-row">
                            <div class="input-group">
                                <label for="full_name">Full Name:</label>
                                <input type="text" id="full_name" name="full_name" required>
                            </div>
                            <div class="input-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="input-group">
                                <label for="phone_number">Phone Number:</label>
                                <input type="tel" id="phone_number" name="phone_number" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <label for="address">Address:</label>
                            <input id="address" name="address" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="delivery-group">
                        <div class="form-row">
                            <h2>Delivery Charge</h2>
                            <label for="delivery_charge">Custom delivery Charge:</label>
                            <input type="number" id="delivery_charge" name="delivery_charge" step="0.01" required>
                        </div>
                    </div>
                    <div class="discount-group">
                        <div class="form-row">
                            <h2>Discounts</h2>
                            <label for="discount">Custom Discount Amount:</label>
                            <input type="number" id="discount" name="discount" step="0.01" required>
                        </div>
                    </div>
                    <input type="submit" value="Submit" id="submit">

                </form>
            </div>
        </div>

        <div class="quick-view">
            <div class="view">
                <div class="top">
                    <h3>Select Products</h3>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="search">
                    <input type="text" placeholder="Search Products">
                    <button id="select-close">Select & Close</button>
                </div>
                <?php
// Perform a database query to fetch data from the 'pro1' table
$select_products = $conn->prepare("SELECT * FROM pro1");
$select_products->execute();

// Check if there are rows returned from the query
if ($select_products->rowCount() > 0) {
    // Loop through each row of data and display it in HTML table format
    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
   
  ?>
                <div class="product-info">
                    <img src="uploads/<?= $fetch_product['ProductImg']; ?>" alt="Product Image">
                    <h5><?= $fetch_product['ProductName']; ?></h5>
                </div>
                <div class="tick">
                    <i class="fa-regular fa-square"></i>
                    <h3>Select this product</h3>
                </div>
                <?php
    }
} else {
    // If no rows are found, display a message
    echo "<tr><td colspan='10'>No products found!</td></tr>";
}?>
            </div>
        </div>
    </section>


    <script src="script.js"></script>
    <script src="script2.js"> </script>
    <script>
    const selectProductsButton = document.getElementById('select-products');
    const quickViewDiv = document.querySelector('.quick-view');
    const closeIcon = document.querySelector('.quick-view .view .top i');

    // Function to toggle the quick-view display
    function toggleQuickView() {
        quickViewDiv.classList.toggle('show');
        const isQuickViewVisible = quickViewDiv.classList.contains('show');
        document.body.style.overflow = isQuickViewVisible ? 'hidden' : 'auto';

        // Store the quick-view state in sessionStorage
        sessionStorage.setItem('quickViewVisible', isQuickViewVisible);

        if (!isQuickViewVisible) {
            document.body.style.overflow = 'auto'; // Reset overflow when closing quick-view
        }
    }

    selectProductsButton.addEventListener('click', toggleQuickView);
    closeIcon.addEventListener('click', toggleQuickView);

    // Function to set the quick-view state on page load
    window.addEventListener('load', () => {
        const isQuickViewVisible = sessionStorage.getItem('quickViewVisible') === 'true';
        if (isQuickViewVisible) {
            quickViewDiv.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    });
    </script>



</body>

</html>