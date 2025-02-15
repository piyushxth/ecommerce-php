<?php
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
 
 if(isset($_POST['update-quantity'])) {
    foreach($_POST['qty'] as $cart_id => $quantity) {
        $update_quantity = $conn->prepare("UPDATE `cart` SET Quantity = ? WHERE id = ? AND user_id = ?");
        $update_quantity->execute([$quantity, $cart_id, $user_id]);
    }
    
    // Redirect back to the cart page after updating quantities
    header("Location: cart.php");
    exit();
}
 
 if(isset($_POST['checkoutButton'])) {
    foreach($_POST['qty'] as $cart_id => $quantity) {
        $update_quantity = $conn->prepare("UPDATE `cart` SET Quantity = ? WHERE id = ? AND user_id = ?");
        $update_quantity->execute([$quantity, $cart_id, $user_id]);
    }
    
    // Redirect to checkout.php after updating quantities
    header("Location: checkout.php");
    exit(); // Stop further execution
}

$totalPrice = 0;
$select_products = $conn->prepare("SELECT ProductPrice, Quantity FROM cart WHERE user_id=?");
$select_products->execute([$user_id]);
if ($select_products->rowCount() > 0) {
    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
        $totalPrice += ($fetch_product['ProductPrice'] * $fetch_product['Quantity']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ICONIC CART</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="style1.css" />
    <style>
    .delete-btn {
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        font-size: inherit;
        cursor: pointer;
        text-align: left;
        /* Add this to align the icon to the left */
    }

    .delete-btn:focus {
        outline: none;
        /* Optional: Remove focus outline if needed */
    }

    button.normal {
        background-color: #088178;
        color: #fff;
        margin-left: 5px;
        padding: 6px 10px;
    }

    form tr td.quantity-div input {
        padding: 5px;
    }
    </style>
</head>

<body>
    <?php $currentPage='cart.php'; include "user_header.php"; ?>



    <section id="cart" class="section-p1 section-m1">
        <h2>My Cart</h2>
        <form id="cartForm" action="" method="post" class="box">
            <!-- Form starts here -->
            <table width="100%">
                <thead>
                    <tr>
                        <td>Remove</td>
                        <td>Image</td>
                        <td>Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Subtotal</td>
                    </tr>
                </thead>

                <tbody>
                    <?php 
            $select_products = $conn->prepare("SELECT * FROM cart WHERE user_id=?"); 
            $select_products->execute([$user_id]);
            if($select_products->rowCount() > 0){
                while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>

                    <tr>
                        <input type="hidden" name="cart_id" value="<?= $fetch_product['id']; ?>">
                        <td>
                            <button type="submit" name="delete" class="delete-btn"
                                onclick="return confirm('delete this from cart?');">
                                <i class="far fa-times-circle"></i>
                            </button>
                        </td>
                        <!-- Rest of the table content -->
                        <td><img src="uploads/<?= $fetch_product['ProductImg']; ?>" alt="Product Image"></td>
                        <td><?= $fetch_product['ProductName']; ?> (<?= $fetch_product['ProductColor']; ?>)</td>
                        <td> Rs <?= $fetch_product['ProductPrice']; ?></td>
                        <td class="quantity-div">
                            <input type="number" name="qty[<?= $fetch_product['id']; ?>]" class="qty" min="1" max="99"
                                onkeypress="if(this.value.length == 2) return false;"
                                value="<?= $fetch_product['Quantity']; ?>"
                                data-price="<?= $fetch_product['ProductPrice']; ?>">
                            <button type="submit" name="update-quantity" class="normal">
                                Update
                            </button>
                        </td>
                        <td class="subtotal">Rs
                            <?= $sub_total = ($fetch_product['ProductPrice'] * $fetch_product['Quantity']); ?></td>
                    </tr>

                    <?php
                }
            } else {
                echo '<tr><td colspan="6"><p class="empty">Your Cart is empty!</p></td></tr>';
            }
            ?>
                </tbody>
            </table>
        </form>

    </section>


    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupon" />
                <button class="normal">Apply</button>
            </div>
        </div>
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td id="grand-total"> <?= number_format($totalPrice, 2); ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Rs 0</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td id="grand-total"><strong>Rs <?= number_format($totalPrice, 2); ?></strong></td>
                </tr>
            </table>
            <button id="checkoutButton" type="submit" name="checkoutButton" class="normal">Proceed to checkout</button>
        </div>
    </section>

    <?php include "./user_footer.php"?>
    <script src="script1.js"></script>
    <script>
    // Add an event listener to all quantity input fields
    const qtyInputs = document.querySelectorAll('.qty');
    qtyInputs.forEach(input => {
        input.addEventListener('input', updateSubtotal);
    });

    function updateSubtotal(event) {
        const input = event.target;
        const row = input.closest('tr');
        const price = parseFloat(row.querySelector('[data-price]').getAttribute('data-price'));
        const quantity = parseInt(input.value);
        const subtotal = price * quantity;
        row.querySelector('td:last-child').textContent = `Rs ${subtotal.toFixed(2)}`;

        recalculateGrandTotal(); // Recalculate the grand total whenever a change is made
    }

    function recalculateGrandTotal() {
        const subtotalElements = document.querySelectorAll('.subtotal');
        let subtotal = 0;

        subtotalElements.forEach(subtotalElement => {
            const subtotalText = subtotalElement.textContent.trim();
            const subtotalValue = parseFloat(subtotalText.replace('Rs ', ''));
            subtotal += subtotalValue;
        });

        // Shipping charges
        const shippingCharges = 0; // You can change this value as needed

        // Calculate the total with shipping charges
        const total = subtotal + shippingCharges;

        // Update the grand total
        const grandTotalElements = document.querySelectorAll('#grand-total');
        grandTotalElements.forEach(grandTotalElement => {
            grandTotalElement.textContent = `Rs ${total.toFixed(2)}`;
        });

    }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutButton = document.querySelector('button[name="checkoutButton"]');
        if (checkoutButton) {
            checkoutButton.addEventListener('click', function(event) {
                event.preventDefault();

                const formData = new FormData(document.getElementById('cartForm'));

                fetch('cart.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.text())
                    .then(data => {
                        window.location.href = 'checkout.php';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        }
    });
    </script>
</body>

</html>