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

// Initialize variables
$totalRevenue = 0;
$totalOrders = 0;
$averageOrderValue = 0;

// Query the database to get total revenue
$totalRevenueQuery = $conn->query("SELECT SUM(TotalPrice) AS totalRevenue FROM orders");
if ($totalRevenueQuery) {
    $totalRevenueData = $totalRevenueQuery->fetch(PDO::FETCH_ASSOC);
    $totalRevenue = $totalRevenueData['totalRevenue'];
}

// Query the database to get total number of orders
$totalOrdersQuery = $conn->query("SELECT COUNT(*) AS totalOrders FROM orders");
if ($totalOrdersQuery) {
    $totalOrdersData = $totalOrdersQuery->fetch(PDO::FETCH_ASSOC);
    $totalOrders = $totalOrdersData['totalOrders'];
}

// Calculate the average order value
$averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

// Modify the SQL query to fetch orders ordered by the latest created_at timestamp
$sql = "SELECT * FROM cart_orders ORDER BY created_at ASC";

$select_orders = $conn->prepare($sql);
$select_orders->execute();
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
</head>

<body>
    <?php $currentPage='salesDash2.php';include "adminSidebar.php"; ?>
    <?php include "adminTop.php"; ?>


    <section class="container">
        <div class="mains">
            <?php          
            $select_profile = $conn->prepare("SELECT * FROM newuser WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>

            <h2>Good Morning, <?= $fetch_profile["username"]; ?></h2>
            <div class="currentDate">
                <p>Here are your stats for today, </p>
                <p style="color: rgb(136, 48, 247);">
                    <?php
                    // Generate and format the current date
                    $currentDate = date('M j, Y');
                    echo "{$currentDate}";
                    ?>
                </p>
            </div>
            <?php
            }
         ?>
        </div>



        <div class="insights">
            <div class="income">
                <span class="material-icons-sharp">analytics</span>
                <div class="details">
                    <h2>Revenue</h2>
                    <h1>Rs <?php echo number_format($totalRevenue, 2); ?></h1>
                    <p>from last Tuesday</p>
                </div>
            </div>
            <div class="orders">
                <span class="material-icons-sharp">analytics</span>
                <div class="details">
                    <h2>Orders</h2>
                    <h1><?php echo $totalOrders; ?></h1>
                    <p>from last Tuesday</p>
                </div>
            </div>
            <div class="avgOrders">
                <span class="material-icons-sharp">analytics</span>
                <div class="details">
                    <h2>Average Order Value</h2>
                    <h1>Rs <?php echo number_format($averageOrderValue, 2); ?></h1>
                    <p>from last Tuesday</p>
                </div>
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
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($select_orders->rowCount() > 0) {
                        while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                    <tr>
                        <td><?= $fetch_order['order_id']; ?></td>
                        <td><?= $fetch_order['customerName']; ?></td>
                        <td>12</td>
                        <td><?= $fetch_order['totalPrice']; ?></td>
                        <td><?= $fetch_order['PaymentStatus']; ?></td>
                        <td><?= $fetch_order['PaymentMethod']; ?></td>
                        <td class="primary"><?= formatTimestamp($fetch_order['created_at']); ?></td>
                        <td> <i class="fa-solid fa-ellipsis-vertical"></i></td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="9">No orders found!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
            <a href="#">Show All</a>
        </div>
    </section>

    <script src="script.js"></script>
    <script src="script2.js"> </script>
</body>

</html>