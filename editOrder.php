<?php
include "./connectServer.php";
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:userLogin.php');
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $updatedCustomerName = $_POST['customer_name'];
        $updatedEmail = $_POST['email'];
        $updatedTotalPrice = $_POST['total_price'];
        $updatedCustomerNumber = $_POST['customer_number'];
        $updatedCustomerAddress = $_POST['customer_address'];
        $updatedPaymentMethod = $_POST['payment_method'];
        $updatedPaymentStatus = $_POST['payment_status'];
        $updatedQuantity = $_POST['quantity'];
        $updatedProductPrice = $_POST['product_price'];
        $updatedProductImg = $_POST['product_img'];

        // Update order details in the database
        $update_order = $conn->prepare("UPDATE cart_orders SET customerName = ?, email = ?, totalPrice = ?, CustomerNumber = ?, customerAddress = ?, PaymentMethod = ?, PaymentStatus = ?, Quantity = ?, ProductPrice = ?, ProductImg = ? WHERE order_id = ?");
        $update_order->execute([$updatedCustomerName, $updatedEmail, $updatedTotalPrice, $updatedCustomerNumber, $updatedCustomerAddress, $updatedPaymentMethod, $updatedPaymentStatus, $updatedQuantity, $updatedProductPrice, $updatedProductImg, $order_id]);

        if ($update_order) {
            echo "order details updated successfully.";
            // Redirect to adminorder1.php or any other page
            header("Location: adminOrder.php");
            exit();
        } else {
            echo "Error updating order.";
        }
    }

    // Fetch order details based on the order_id
    $select_order = $conn->prepare("SELECT * FROM cart_orders WHERE order_id = ?");
    $select_order->execute([$order_id]);

    if ($select_order->rowCount() > 0) {
        $order_details = $select_order->fetch(PDO::FETCH_ASSOC);
    } else {
        echo 'order not found!';
    }
} else {
    echo 'Invalid order ID!';
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
        color: #000;
    }

    .form-container {
        line-height: 1.55;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 1rem;
        margin-left: 1rem;
    }

    .form-container1 {
        line-height: 1.55;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-top: 1rem;
        margin-left: 1rem;
    }

    .form-column {
        flex-basis: 49%;
    }

    .form-row {
        display: flex;
        flex-direction: column;
    }

    .name-description-box,
    .payment-status,
    .categories-section,
    .price-box,
    .quantity-box,
    .status-section {
        background: var(--color-white);
        border-radius: 6px;
        padding: 10px;
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }

    .name-description-box input,
    .name-description-box textarea,
    .payment-status input,
    .categories-section input,
    .price-box input,
    .quantity-box input,
    .order-option input {
        background: var(--color-white);
        border: 1px solid rgb(206, 212, 218);
        border-radius: 6px;
        padding: 5px;
        color: var(--color-dark-variant);
        margin-bottom: 10px;
    }


    .price-box {
        flex-basis: 49%;
        height: 12rem;
    }


    .quantity-box,
    .status-section {
        width: 49%;
        border-radius: 6px;
        padding: 10px;
    }

    .status-section input[type="radio"] {
        margin: 5px 0;
    }

    .submit-button {
        background: rgb(136, 48, 247);
        color: rgb(255, 255, 255);
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        cursor: pointer;
        margin-bottom: 15px;
        margin-left: 1rem;
    }

    /* CSS for tick icons */
    .order-options {
        background: var(--color-white);
        border-radius: 6px;
        padding: 10px;
        margin-bottom: 15px;
        color: var(--color-dark-variant);
        display: flex;
        flex-direction: column;
        flex-basis: 49%;
    }

    .order-option {
        margin-top: 10px;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .order-option input {
        width: 100%;
        margin-top: 10px;
    }

    .order-option-header {
        display: flex;
        align-items: center;
    }



    .tick-icon {
        text-align: center;
        font-size: 15px;
        width: 2rem;
        border: 1px solid rgb(206, 212, 218);
        margin-right: 10px;
        color: transparent;
    }

    .tick-icon.ticked {
        color: green;
        /* Change the color when ticked */
    }
    </style>
</head>

<body>
    <?php $currentPage='adminorders.php';include "adminSidebar.php"; ?>
    <?php include "adminTop.php"; ?>

    <section class="container">
        <div class="mains">
            <h2>Edit order</h2>
        </div>

        <div class="edit_order">
            <form action="#" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-container">
                    <div class="form-column">
                        <div class="name-description-box">
                            <label for="customer_name"> Customer Name: </label>
                            <input type="text" id="customer_name" name="customer_name"
                                value="<?= $order_details['customerName'];?>" required>
                            <label for="CustomerAddress">Customer Address:</label>
                            <textarea id="CustomerAddress" name="customer_address" rows="4" cols="30"
                                required><?= $order_details['CustomerAddress']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="payment-status">
                            <label for="payment-status">Payment Status:</label>
                            <select name="status" class="box" required>
                                <option value="cash on delivery">Pending</option>
                                <option value="Esewa">Paid</option>
                            </select>
                        </div>
                        <div class="categories-section">
                            <label for="categories">Payment Method:</label>
                            <select name="payment_method" class="box" required>
                                <option value="cash on delivery">Cash on Delivery</option>
                                <option value="Esewa">Esewa</option>
                                <option value="Khalti">Khalti</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-container">
                    <div class="price-box">
                        <label for="selling_price">Product Price:</label>
                        <input type="number" id="ProductPrice" name="product_price"
                            value="<?= $order_details['ProductPrice']; ?>" required>

                        <label for="cost_price">Shipping Price:</label>
                        <input type="number" id="ShippingPrice" name="ShippingPrice" value='0' required>
                    </div>

                    <div class="order-options">
                        <label for="order-options">order Options</label>
                        <div class="order-option">
                            <div class="order-option-header">
                                Email
                            </div>
                            <div class="order-option-input">
                                <input type="text" name="email" value="<?= $order_details['email']; ?>">
                            </div>
                        </div>
                        <div class="order-option">
                            <div class="order-option-header">
                                Number
                            </div>
                            <div class="order-option-input">
                                <input type="number" name="customer_number"
                                    value="<?= $order_details['CustomerNumber']; ?>">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="form-container1">
                    <div class="quantity-box">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="99"
                            onkeypress="if(this.value.length == 2) return false;"
                            value="<?= $order_details['Quantity']; ?>" required>
                    </div>
                    <div class="status-section">
                        <label for="payment_status">Status:</label>
                        <select id="payment_status" name="payment_status">
                            <option value="pending">pending</option>
                            <option value="Paid">Paid</option>
                        </select>
                    </div>
                </div>


                <input id="submit" type="submit" value="Update" class="submit-button" name="update">
            </form>
        </div>
    </section>

    <script src="script.js"></script>
    <script src="script2.js"> </script>
    <script>
    function validateForm() {
        // Retrieve form field values
        var customerName = document.getElementById("customer_name").value;
        var customerAddress = document.getElementById("CustomerAddress").value;
        var productPrice = parseFloat(document.getElementById("ProductPrice").value);
        var shippingPrice = parseFloat(document.getElementById("ShippingPrice").value);

        // Validation for Customer Name
        if (/^\d/.test(customerName) || /[^\w\s]/.test(customerName)) {
            alert("Customer name should not start with a number or contain symbols.");
            return false;
        }

        // Validation for Customer Address
        if (/^\d/.test(customerAddress)) {
            alert("Customer address should not start with a number.");
            return false;
        }

        // Validation for Product Price and Shipping Price
        if (productPrice < 0 || shippingPrice < 0) {
            alert("Product price and shipping price should not be negative.");
            return false;
        }

        return true; // Form data is valid
    }
    </script>
</body>

</html>