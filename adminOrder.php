<?php
include "./connectServer.php";
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:userLogin.php');
}


function formatTimestamp($timestamp) {
    return date('M j, Y g:ia', strtotime($timestamp));
}

// Modify the SQL query to fetch orders ordered by the latest created_at timestamp
$sql = "SELECT * FROM cart_orders ORDER BY created_at ASC";

$select_products = $conn->prepare($sql);
$select_products->execute();

if(isset($_POST['delete'])){
    $order_id = $_POST['order_id'];
  
    $delete_order_item = $conn->prepare("DELETE FROM `cart_orders` WHERE order_id = ?");
    $delete_order_item->execute([$order_id]);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="style3.css" />
    <style>
    .recent-order table {
        border: 1px solid rgb(222, 226, 230);
    }

    .action-menu {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translate(-100%, -50%);
        background: var(--color-white);
        gap: 1rem;
        padding: 1rem;
        border-radius: 6px;
        display: none;
        z-index: 999;
        margin: 9rem 3rem;
        width: 18rem;
        border: 1px solid black;
        transition: display 0.2s ease-in-out;
    }

    .action-menu.show-menu {
        display: block;
    }

    /* Updated styles for action menu list */
    .action-menu ul {
        list-style: none;
        margin: 0;
    }

    .action-menu ul li,
    .action-menu ul li:nth-child(2) a {
        display: flex;
        align-items: center;
        gap: 1rem;
        cursor: pointer;
        padding: 10px;
    }

    .action-menu ul li:hover {
        background: var(--color-background);
    }

    /* Updated styles for action menu icons */
    .action-menu ul li i {
        cursor: pointer;
    }

    .action-menu ul li i:hover {
        cursor: pointer;
    }

    .action-menu button {
        display: flex;
        gap: 1rem;
        background: none;
    }

    .action-menu ul li:nth-child(2) a {
        text-decoration: none;
        color: #000;
        padding: 0;
        margin: 0;

    }

    .action-menu ul form button span {
        color: rgb(237, 110, 160);
    }

    /* Added class for the table cell containing the action */
    .action-cell {
        position: relative;
    }



    .action-cell:hover .action-menu {
        display: block;
    }

    .fa-solid.fa-ellipsis-vertical {
        cursor: pointer;
    }

    .container .recent-order {
        margin-top: 2rem;
        margin-left: 5px;
        margin-bottom: 20rem;
    }


    .recent-order table tbody tr td:nth-child(9):hover .fa-bars {
        color: green;
    }
    </style>
</head>

<body>
    <?php $currentPage='adminOrder.php';include "adminSidebar.php"; ?>
    <?php include "adminTop.php"; ?>

    <section class="container">
        <div class="mains">
            <h2>Orders</h2>
        </div>

        <div class="productsMain">
            <button>Active</button>
            <button>Active</button>
            <button>Active</button>
            <div class="right">
                <input type="text" id="searchInput" placeholder="Search for products...">
                <a href="add_order.php"><button>Create Order</button></a>
            </div>
        </div>


        <div class="recent-order">
            <h2>Recent Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Payment Status</th>
                        <th>Payment Method</th>
                        <th>Customer Address</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
if ($select_products->rowCount() > 0) {
    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
                    <form action="" method="post" class="box">
                        <tr>
                            <td><?= $fetch_product['order_id']; ?></td>
                            <td><?= $fetch_product['customerName']; ?></td>
                            <td><?= $fetch_product['Quantity']; ?></td>
                            <td><?= $fetch_product['totalPrice']; ?></td>
                            <td><?= $fetch_product['PaymentStatus']; ?></td>
                            <td><?= $fetch_product['PaymentMethod']; ?></td>
                            <td><?= $fetch_product['CustomerAddress']; ?></td>
                            <td class="primary"><?= formatTimestamp($fetch_product['created_at']); ?></td>
                            <td>
                                <div class="action-cell">
                                    <i class="fa-solid fa-bars"></i>
                                    <div class="action-menu">
                                        <ul>
                                            <li><i class="fa-regular fa-eye"></i>View</li>
                                            <li><a href="editOrder.php?order_id=<?= $fetch_product['order_id']; ?>'"> <i
                                                        class="fa-regular fa-pen-to-square"></i>Edit
                                                    Orders</a></li>

                                            <li><i class="fa-regular fa-pen-to-square"></i>Update Price and Inventory
                                            </li>
                                            <li><i class="fa-regular fa-pen-to-square"></i>Update Status</li>
                                            <li>
                                                <form method="post">
                                                    <input type="hidden" name="order_id"
                                                        value="<?= $fetch_product['order_id']; ?>">
                                                    <button type="submit" name="delete"
                                                        onclick="return confirm('Delete this Order?');"><i
                                                            class="fa-solid fa-trash"></i><span> Delete</span></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
    }
} else {
    echo '<p class="empty">No orders found!</p>';
}
?>
                    </form>
                </tbody>
            </table>
            <a href="#">Show All</a>
        </div>
    </section>


    <script src="script.js"></script>
    <script src="script2.js"></script>

</body>

</html>