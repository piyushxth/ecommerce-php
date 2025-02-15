<?php
include "./connectServer.php";
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:userLogin.php');
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $updatedProductName = $_POST['product_name'];
        $updatedProductDescription = $_POST['product_description'];
        $updatedCategory = $_POST['category'];
        $updatedSellingPrice = $_POST['selling_price'];
        $updatedCostPrice = $_POST['cost_price'];
        $updatedColor = $_POST['ProductColor'];
        $updatedSize = $_POST['size'];
        $updatedQuantity = $_POST['quantity'];

        // Check if a new image file is uploaded
        if ($_FILES['ProductImg']['name'] != '') {
            // Handle file upload
            $targetDirectory = "uploads/";
            $targetFile = $targetDirectory . basename($_FILES["ProductImg"]["name"]);

            if (move_uploaded_file($_FILES["ProductImg"]["tmp_name"], $targetFile)) {
                // Update product details along with the image in the database
                $update_product = $conn->prepare("UPDATE pro1 SET ProductName = ?, ProductDescription = ?, ProductImg = ?, keyword = ? WHERE product_id = ?");
                $update_product->execute([$updatedProductName, $updatedProductDescription, $_FILES["ProductImg"]["name"], $updatedCategory, $product_id]);
                
                if ($update_product) {
                    // Update details in respective tables (sizes, colors, inventory)
                    $update_color = $conn->prepare("UPDATE colors SET color_name = ? WHERE product_id = ?");
                    $update_color->execute([$updatedColor, $product_id]);

                    $update_size = $conn->prepare("UPDATE sizes SET size_name = ? WHERE product_id = ?");
                    $update_size->execute([$updatedSize, $product_id]);

                    $update_inventory = $conn->prepare("UPDATE inventory SET cost_price = ?, selling_price = ?, quantity = ? WHERE product_id = ?");
                    $update_inventory->execute([$updatedCostPrice, $updatedSellingPrice, $updatedQuantity, $product_id]);

                    echo "Product details updated successfully.";
                    // Redirect to adminProduct1.php or any other page
                    header("Location: adminProduct1.php");
                    exit();
                } else {
                    echo "Error updating product.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            // Update product details without updating the image in the database
            $update_product = $conn->prepare("UPDATE pro1 SET ProductName = ?, ProductDescription = ?, keyword = ? WHERE product_id = ?");
            $update_product->execute([$updatedProductName, $updatedProductDescription, $updatedCategory, $product_id]);

            if ($update_product) {
                // Update details in respective tables (sizes, colors, inventory)
                $update_color = $conn->prepare("UPDATE colors SET color_name = ? WHERE product_id = ?");
                $update_color->execute([$updatedColor, $product_id]);

                $update_size = $conn->prepare("UPDATE sizes SET size_name = ? WHERE product_id = ?");
                $update_size->execute([$updatedSize, $product_id]);

                $update_inventory = $conn->prepare("UPDATE inventory SET cost_price = ?, selling_price = ?, quantity = ? WHERE product_id = ?");
                $update_inventory->execute([$updatedCostPrice, $updatedSellingPrice, $updatedQuantity, $product_id]);

                echo "Product details updated successfully.";
                // Redirect to adminProduct1.php or any other page
                header("Location: adminProduct1.php");
                exit();
            } else {
                echo "Error updating product.";
            }
        }
    }

    // Fetch product details based on the product_id
    $select_product = $conn->prepare("SELECT p.ProductName, p.ProductDescription, p.ProductImg, p.keyword, i.selling_price AS SellingPrice, i.cost_price AS CostPrice, c.color_name AS ProductColor, s.size_name AS Size, i.quantity AS Quantity FROM pro1 p INNER JOIN inventory i ON p.product_id = i.product_id INNER JOIN colors c ON i.color_id = c.color_id INNER JOIN sizes s ON i.size_id = s.size_id WHERE p.product_id = ?");
    $select_product->execute([$product_id]);

    if ($select_product->rowCount() > 0) {
        $product_details = $select_product->fetch(PDO::FETCH_ASSOC);
    } else {
        echo 'Product not found!';
    }
} else {
    echo 'Invalid product ID!';
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
    .image-section,
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
    .image-section input,
    .categories-section input,
    .price-box input,
    .quantity-box input,
    .product-option input {
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
    .product-options {
        background: var(--color-white);
        border-radius: 6px;
        padding: 10px;
        margin-bottom: 15px;
        color: var(--color-dark-variant);
        display: flex;
        flex-direction: column;
        flex-basis: 49%;
    }

    .product-option {
        margin-top: 10px;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .product-option input {
        width: 100%;
        margin-top: 10px;
    }

    .product-option-header {
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
    <?php $currentPage='adminProducts.php';include "adminSidebar.php"; ?>
    <?php include "adminTop.php"; ?>

    <section class="container">
        <div class="mains">
            <h2>Edit Product</h2>
        </div>

        <div class="edit_product">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-container">
                    <div class="form-column">
                        <div class="name-description-box">
                            <label for="product_name"> Product Name: </label>
                            <input type="text" id="product_name" name="product_name"
                                value="<?= $product_details['ProductName'];?>" required>
                            <label for=" ProductDescription">Product Description:</label>
                            <textarea id="ProductDescription" name="ProductDescription" rows="4" cols="30"
                                required><?= $product_details['ProductDescription']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="image-section">
                            <label for="product_images" class="file-input-container">Product Images:</label>
                            <input type="file" id="product_images" class="file-input" name="ProductImg" multiple>
                        </div>
                        <div class="categories-section">
                            <label for="categories">Categories:</label>
                            <input type="text" name="category" value="<?= $product_details['keyword']; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-container">
                    <div class="price-box">
                        <label for="selling_price">Selling Price:</label>
                        <input type="number" id="selling_price" name="selling_price"
                            value="<?= $product_details['SellingPrice']; ?>" step="0.01" required>

                        <label for="cost_price">Cost Price:</label>
                        <input type="number" id="cost_price" name="cost_price"
                            value="<?= $product_details['CostPrice']; ?>" step="0.01" required>
                    </div>

                    <div class="product-options">
                        <label for="product-options">Product Options</label>
                        <div class="product-option">
                            <div class="product-option-header">
                                Color
                            </div>
                            <div class="product-option-input">
                                <input type="text" name="ProductColor" value="<?= $product_details['ProductColor']; ?>">
                            </div>
                        </div>
                        <div class="product-option">
                            <div class="product-option-header">
                                Size
                            </div>
                            <div class="product-option-input">
                                <input type="text" name="size" value="<?= $product_details['Size']; ?>">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="form-container1">
                    <div class="quantity-box">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="<?= $product_details['Quantity']; ?>"
                            required>
                    </div>
                    <div class="status-section">
                        <label for="payment_status">Status:</label>
                        <select id="status" name="status">
                            <option value="pending">Acitive</option>
                            <option value="completed">Inactive</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>


                <input id="submit" type="submit" value="Update" class="submit-button" name="update">
            </form>
        </div>
    </section>

    <script src="script.js"></script>
    <script src="script2.js"> </script>
</body>

</html>