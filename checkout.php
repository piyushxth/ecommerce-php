<?php
include "./connectServer.php";
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

if (isset($_POST['add-to-cart_orders'])) {
    // Your database connection should be established in connectServer.php
    if (!isset($conn)) {
        die("Connection to database failed");
    }

    $name = $_POST['name'] ?? '';
    $number = $_POST['number'] ?? '';
    $email = $_POST['email'] ?? '';
    $ProductPrice = $_POST['ProductPrice'] ?? '';
    $address = $_POST['address'] ?? '';
    $Quantity = $_POST['Quantity'] ?? '';
    $ProductImg = $_POST['ProductImg'] ?? '';
    $method = $_POST['method'] ?? '';

    try {
        // Insert form data into cart_orders table
        $insert_order = $conn->prepare("INSERT INTO cart_orders (customerName, email, user_id, CustomerNumber, CustomerAddress, PaymentMethod, ProductPrice, Quantity, ProductImg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_order->execute([$name, $email, $user_id, $number, $address, $method, $ProductPrice, $Quantity, $ProductImg]);
        $delete_cart_items = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $delete_cart_items->execute([$user_id]);
        // Redirect after successful insertion
        header("Location: shop.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Display any potential error
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ICONIC</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style1.css" />
    <style>
    .container {
        padding: 10px 80px;
    }

    /* #successMessage {
        display: none;
    }

    #successMessage h3 {
        text-align: center;
        margin: 15px;
        background-color: #088178;
        color: #fff;
        padding: 20px;
        margin: 10rem 10rem 0;
        border-radius: 6px;
    }

    #successMessage a {
        justify-content: center;
    } */

    .form-container {
        border: 1px solid black;
        padding: 10px;
    }

    .flex-row {
        display: flex;
        margin-bottom: 20px;
    }

    .half-width {
        width: 50%;
        padding-right: 10px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    form h4 {
        text-align: center;
        margin: 15px;
        background-color: #088178;
        color: #fff;
        padding: 10px;
        border-radius: 6px;
    }

    label,
    input,
    textarea,
    .select {
        height: 3rem;
        width: 100%;
        border-radius: 6px;
        box-sizing: border-box;
        padding: 10px;
    }

    input[type="submit"] {
        padding: 10px;
        background-color: #088178;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: green;
    }

    .payment-method select {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        box-sizing: border-box;
        height: 3rem;
    }



    .cart-orders {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: #e74c3c;
    }

    .cart-orders img {
        width: 70px;
    }

    .grand-total {
        margin-top: 15px;
        margin-bottom: 20px;
        text-align: center;
        font-size: 22px;
        color: #e74c3c;
    }

    .grand-total span {
        color: #666
    }
    </style>
</head>

<body>
    <?php $currentPage='userOrders.php';include "user_header.php"; ?>
    <!-- <div id="successMessage">
        <h3>Order Successfully created</h3>
        <a href="userOrders.php"><button>View Orders</button></a>
    </div> -->
    <section class="container">
        <div class="place-order">

            <div class="form-container">
                <form action="" method="post" class="order-form" onsubmit="return validateForm()">
                    <h4>YOUR ORDERS</h4>
                    <?php 
                    $total = 0;
            $select_products = $conn->prepare("SELECT * FROM cart WHERE user_id=?"); 
            $select_products->execute([$user_id]);
            if($select_products->rowCount() > 0){
                while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
                    $sub_total = $fetch_product['ProductPrice'] * $fetch_product['Quantity'];
                    $total += $sub_total; // Add to the total
            ?>
                    <div class="cart-orders">
                        <input type="hidden" name="ProductPrice" value="<?= $fetch_product['ProductPrice']; ?>">
                        <input type="hidden" name="Quantity" value="<?= $fetch_product['Quantity']; ?>">
                        <input type="hidden" name="ProductImg" value="<?= $fetch_product['ProductImg']; ?>">
                        <img src="uploads/<?= $fetch_product['ProductImg']; ?>" alt="Product Image">
                        Rs <?= intval($fetch_product['ProductPrice']) ?>/- X <?= $fetch_product['Quantity']; ?>

                    </div>
                    <?php
                }
            } else {
                echo '<tr><td colspan="6"><p class="empty">Your Cart is empty!</p></td></tr>';
            }
            ?>
                    <div class="grand-total">
                        <span> Grand Total:</span> Rs <?= $total ?>
                    </div>
                    <h4>PLACE YOUR ORDERS</h4>
                    <div class="form-group">
                        <div class="flex-row">
                            <div class="half-width">
                                <label for="name">Your Name:</label>
                                <input type="text" id="name" name="name" pattern="[A-Za-z][A-Za-z ]+"
                                    title="Please enter a valid name" required>
                            </div>
                            <div class="half-width">
                                <label for="number">Your Number:</label>
                                <input type="text" id="number" name="number" pattern="[0-9]+"
                                    title="Please enter number value" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="flex-row">
                            <div class="half-width">
                                <label for="email">Your Email:</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="half-width">
                                <label>Payment Method:</label>
                                <div class="payment-method">
                                    <select name="method" class="box" required>
                                        <option value="cash on delivery">Cash on Delivery</option>
                                        <option value="Esewa">Esewa</option>
                                        <option value="Khalti">Khalti</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea id="address" name="address" pattern="[A-Za-z0-9\s]+" required></textarea>
                    </div>

                    <div class="form-group">
                        <input name="add-to-cart_orders" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include "./user_footer.php"; ?>

    <script src="script1.js"></script>
    <script>
    function validateForm() {
        // Name validation (should not start with a number)
        const nameField = document.getElementById('name');
        if (!/^[A-Za-z][A-Za-z ]+$/.test(nameField.value)) {
            alert('Please enter a valid name. It should start with a letter and contain only letters and spaces.');
            return false;
        }

        // Number validation (should contain only numbers)
        const numberField = document.getElementById('number');

        if (!/^[0-9]{10,}$/.test(numberField.value)) {
            alert('Please enter a valid number. It should contain only numbers and be at least 10 digits.');
            return false;
        }

        // Address validation (should contain only alphanumeric characters and spaces)
        const addressField = document.getElementById('address');
        if (!/^[A-Za-z0-9\s]+$/.test(addressField.value)) {
            alert('Please enter a valid address. It should contain only alphanumeric characters and spaces.');
            return false;
        }

        return true; // Submit the form if all validations pass
    }
    </script>

</body>

</html>