<?php
include "./connectServer.php";
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
function formatTimestamp($timestamp) {
   return date('M j, Y g:ia', strtotime($timestamp));
   }
   if(isset($_POST['delete'])){
      $order_id = $_POST['order_id'];
    
      $delete_cart_item = $conn->prepare("DELETE FROM `cart_orders` WHERE order_id = ?");

      $delete_cart_item->execute([$order_id]);
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
    .container h3 {
        text-align: center;
        margin: 15px 0;

    }

    .orders {
        display: flex;
        margin: 2rem;
        padding: 10px;
        flex-direction: column;
        align-items: center;
    }

    .box {
        border: 1px solid blue;
        text-align: left;
        padding: 10px;
    }



    .box img {
        width: 70px;
    }

    .box p span {
        color: #2980b9;
    }
    </style>
</head>

<body>
    <?php $currentPage='userOrders.php';include "user_header.php"; ?>
    <div class="container">
        <h3>PLACED ORDERS</h3>

        <form action="" method="POST" class="userOrders">

            <?php 
                $total = 0;
                $select_products = $conn->prepare("SELECT * FROM cart_orders WHERE user_id=?"); 
                $select_products->execute([$user_id]);
                if($select_products->rowCount() > 0){
                    while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
                        $sub_total = $fetch_product['ProductPrice'] * $fetch_product['Quantity'];
                        $total += $sub_total; // Add to the total
                ?>
            <input type="hidden" name="order_id" value="<?= $fetch_product['order_id']; ?>">
            <div class="orders">
                <div class="box">
                    <p>placed on : <span><?= formatTimestamp($fetch_product['created_at']); ?> </span></p>
                    <p>name : <span> <?= $fetch_product['customerName']; ?></span></p>
                    <p>email : <span> <?= $fetch_product['email']; ?></span></p>
                    <p>number : <span> <?= $fetch_product['CustomerNumber']; ?></span></p>
                    <p>address : <span> <?= $fetch_product['CustomerAddress']; ?></span></p>
                    <p>your orders : <span> <img src="uploads/<?= $fetch_product['ProductImg']; ?>" alt="Product Image">
                            (Rs
                            <?= intval($fetch_product['ProductPrice']) ?>/- X
                            <?= $fetch_product['Quantity']; ?>)</span></p>
                    <p>total price : <span>Rs <?= $total ?></span></p>
                    <p>payment method : <span> <?= $fetch_product['PaymentMethod']; ?></span></p>
                    <p> payment status : <span style="color:#e74c3c;"> <?= $fetch_product['PaymentStatus']; ?></span>
                    </p>
                    <button type="submit" name="delete" class="delete-btn"
                        onclick="return confirm('Do you really want to cancel the order?');">
                        CANCEL ORDER
                    </button>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo '<tr><td colspan="3"><p class="empty">No Orders!</p></td></tr>';
                }
                ?>


    </div>
    </form>
    <?php include "./user_footer.php"; ?>

    <script src="script1.js"></script>
</body>

</html>