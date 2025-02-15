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
    .categories {
        margin-top: 2rem;
        border-radius: 0.5rem;
        border: 1px solid rgb(222, 226, 230);
    }

    .categories img {
        width: 70px;
    }

    .categories table {
        background: var(--color-white);
        width: 100%;
        border-radius: 4px;
        border-spacing: 0;
        border: 1px solid rgb(222, 226, 230);
        /* text-align: center; */
        padding: 5px;
        transition: all 300ms ease;
    }

    .categories table thead th {
        text-align: left;
        font-size: 14px;
        color: rgb(73, 80, 87);
        padding: 10px;
        padding-bottom: 4px;
        font-weight: bold;
        border-bottom: 1px solid var(--color-light);
    }

    .categories table tbody td {
        height: 2.8rem;
        border-bottom: 1px solid var(--color-light);
        font-size: 14px;
        padding: 10px;
    }

    .categories table tbody td:last-child i {
        color: black;
    }

    .categories table tbody td:last-child i:hover {
        color: rgb(250, 82, 82);
        cursor: pointer;
    }



    .categories table tbody tr:last-child td {
        border: none;
    }

    .categories table img {
        width: 36px;
        height: auto;
        border-radius: 4px;
    }

    .categories table td .img-name {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .categories table td:last-child,
    .categories table thead th:last-child {
        text-align: center;
    }

    .categories table tr {
        cursor: pointer;
    }

    .categories table tbody tr:hover {
        background: var(--color-background);
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
        width: 30rem;
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

    .quick-view form {
        display: flex;
        padding: 15px;
        flex-direction: column;
    }

    .quick-view form .form-row {
        display: flex;
        flex-direction: column;
        padding: 15px;
        gap: 5px;
        margin-bottom: 2rem;

    }

    .quick-view form .form-row input {
        border: 1px solid black;
        padding: 10px;
        border-radius: 6px;
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
    </style>
</head>

<body>
    <?php $currentPage='adminCategories.php';include "adminSidebar.php"; ?>
    <?php include "adminTop.php"; ?>

    <section class="container">

        <div class="mains">
            <h2>Categories</h2>
        </div>

        <div class="productsMain">
            <button>Active</button>
            <button>Active</button>
            <button>Active</button>
            <div class="right">
                <input type="text" id="searchInput" placeholder="Search for products...">
                <button id="add-category">Add Category</button>
            </div>
        </div>
        <div class="categories">
            <table>
                <thead>
                    <th><i class="fa-regular fa-square"></i></th>
                    <th>Name</th>
                    <th>Actions</th>
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
                        <td><i class="fa-regular fa-square"></i></td>
                        <td onclick="window.location='category.php?Keyword=<?= $fetch_product['keyword']; ?>'">
                            <div class="img-name">
                                <img src="uploads/<?= $fetch_product['ProductImg']; ?>"
                                    alt="Product Image"><?= $fetch_product['keyword']; ?>
                            </div>
                        </td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?= $fetch_product['product_id']; ?>">
                                <button type="submit" name="delete" onclick="return confirm('Delete this category?');">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo 'No Categories found!';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="quick-view">
            <div class="view">
                <div class="top">
                    <h3>Add Category</h3>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <form action="" method="POST">
                    <div class="form-row">
                        <label for="">Category Name</label>
                        <input type="text" name="category-name" placeholder="e.g: Tshirt">
                    </div>
                    <div class="form-row">

                        <label for="product_images" class="file-input-container">Category Images:</label>
                        <input type="file" id="product_images" class="file-input" name="ProductImg" multiple>
                    </div>
                    <input id="submit" type="submit" value="Add Category" class="submit-button" name="add">
                </form>

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

    const selectProductsButton = document.getElementById('add-category');
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