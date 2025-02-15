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
    $product_id = $_POST['product_id'];
  
    $delete_product_item = $conn->prepare("DELETE FROM `pro1` WHERE product_id = ?");
    $delete_product_item->execute([$product_id]);
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

    .action-menu ul li {
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

    .action-menu ul form button {
        display: flex;
        gap: 1rem;
        background: none;
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

    .container .products-stock {
        margin-top: 2rem;
        margin-left: 5px;
        margin-bottom: 20rem;
    }

    .products-stock table tbody tr td:nth-child(7) {
        color: rgb(102, 24, 191);
    }

    .products-stock table tbody tr td:nth-child(8):hover .fa-bars {
        color: green;
    }
    </style>
</head>

<body>
    <?php $currentPage='adminProducts.php';include "adminSidebar.php"; ?>
    <?php include "adminTop.php"; ?>

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
                <a href="addproduct1.php"> <button>Add Product</button></a>
            </div>
        </div>


        <div class="products-stock">

            <table>
                <thead>
                    <th><i class="fa-regular fa-square"></i></th>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Inventory</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>

                </thead>
                <tbody>
                    <?php 
                    $select_products = $conn->prepare("SELECT p.product_id, p.ProductName, p.ProductImg, i.quantity AS Inventory, i.cost_price AS ProductPrice, 
                    c.color_name AS ProductColor, p.keyword, p.created_at, i.selling_price AS SellingPrice, 
                    s.size_name AS Size, p.ProductDescription 
             FROM pro1 p
             INNER JOIN inventory i ON p.product_id = i.product_id
             INNER JOIN colors c ON i.color_id = c.color_id
             INNER JOIN sizes s ON i.size_id = s.size_id");
                    $select_products->execute();

                    if($select_products->rowCount() > 0) {
                        while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><i class="fa-regular fa-square"></td>
                        <td><?= $fetch_product['product_id']; ?></td>
                        <td onclick="window.location='editProduct.php?product_id=<?= $fetch_product['product_id']; ?>'">
                            <div class="img-name">
                                <img src="uploads/<?= $fetch_product['ProductImg']; ?>"
                                    alt="Product Image"><?= $fetch_product['ProductName']; ?>
                            </div>
                        </td>
                        <td><strong>Rs. <?= $fetch_product['SellingPrice']; ?></strong></td>
                        <td>
                            <p class="<?php echo ($fetch_product['Inventory'] > 0) ? 'In-Stock' : 'inactive'; ?>">
                                <?= $fetch_product['Inventory']; ?>
                        </td>
                        <td>
                            <p class="<?php echo ($fetch_product['Inventory'] > 0) ? 'In-Stock' : 'inactive'; ?>">
                                <?php 
        if ($fetch_product['Inventory'] > 0) {
            echo "  ACTIVE";
        } else {
            echo "INACTIVE";
        }
    ?></p>
                        </td>

                        <td><?= $fetch_product['created_at']; ?></td>

                        <td>
                            <div class="action-cell">
                                <i class="fa-solid fa-bars"></i>
                                <div class="action-menu">
                                    <ul>
                                        <li><i class="fa-regular fa-eye"></i>View</li>
                                        <li><i class="fa-regular fa-pen-to-square"></i>Edit Products</li>
                                        <li><i class="fa-regular fa-pen-to-square"></i>Update Price and Inventory</li>
                                        <li><i class="fa-regular fa-pen-to-square"></i>Update Status</li>
                                        <li>
                                            <form method="post">
                                                <input type="hidden" name="product_id"
                                                    value="<?= $fetch_product['product_id']; ?>">
                                                <button type="submit" name="delete"
                                                    onclick="return confirm('Delete this product?');">
                                                    <i class="fa-solid fa-trash"></i><span> Delete</span>
                                                </button>
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
                        echo '<tr><td colspan="10">No products found!</td></tr>';
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </section>


    <script src="script.js"></script>
    <script src="script2.js"> </script>
    <script>
    document.querySelector('tbody').addEventListener('click', function(event) {
        const actionCell = event.target.closest('.action-cell');
        if (actionCell) {
            const actionMenu = actionCell.querySelector('.action-menu');

            // Toggle the display of the action menu
            if (actionMenu) {
                actionMenu.classList.toggle('show-menu');
            }
        }
    });
    </script>
</body>

</html>