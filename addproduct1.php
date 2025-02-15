<?php
include "./connectServer.php";

if(isset($_POST['add'])) {
    // Database connection
    include "./connectServer.php"; // Modify this to match your database connection file

    // Get form data
    $ProductName = $_POST['product_name'];
    $ProductDescription = $_POST['ProductDescription'];
    $ProductImg = $_FILES["ProductImg"]["name"];
    $category = $_POST['category']; // Input named 'category' from the form

    // Handle file upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["ProductImg"]["name"]);

    // Additional processing and checks for file upload...
    if (move_uploaded_file($_FILES["ProductImg"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["ProductImg"]["name"])) . " has been uploaded.";

        try {
            // Start a transaction
            $conn->beginTransaction();

            // Insert into pro1 table
            $sql_pro1 = "INSERT INTO pro1 (ProductImg, ProductName, keyword, ProductDescription) 
                VALUES (:ProductImg, :ProductName, :keyword, :ProductDescription)";
            $stmt_pro1 = $conn->prepare($sql_pro1);
            $stmt_pro1->bindParam(':ProductImg', $ProductImg);
            $stmt_pro1->bindParam(':ProductName', $ProductName);
            $stmt_pro1->bindParam(':keyword', $category); // Use $category for 'keyword' column
            $stmt_pro1->bindParam(':ProductDescription', $ProductDescription);
            $stmt_pro1->execute();
            $product_id = $conn->lastInsertId();

             // Insert into colors table
             $sql_color = "INSERT INTO colors (product_id, color_name) VALUES (:product_id, :ProductColor)";
             $stmt_color = $conn->prepare($sql_color);
             $stmt_color->bindValue(':product_id', $product_id);
             $stmt_color->bindValue(':ProductColor', $_POST['ProductColor']);
             $stmt_color->execute();
             $color_id = $conn->lastInsertId();
             
             // Insert into sizes table
             $sql_size = "INSERT INTO sizes (product_id, size_name) VALUES (:product_id, :size)";
             $stmt_size = $conn->prepare($sql_size);
             $stmt_size->bindValue(':product_id', $product_id);
             $stmt_size->bindValue(':size', $_POST['size']);
             $stmt_size->execute();
             $size_id = $conn->lastInsertId();
 
             // Insert into inventory table
             $sql_inventory = "INSERT INTO inventory (product_id, color_id, size_id, cost_price, selling_price, quantity) 
             VALUES (:product_id, :color_id, :size_id, :cost_price, :selling_price, :quantity)";
         $stmt_inventory = $conn->prepare($sql_inventory);
         $stmt_inventory->bindValue(':product_id', $product_id);
         $stmt_inventory->bindValue(':color_id', $color_id);
         $stmt_inventory->bindValue(':size_id', $size_id);
         $stmt_inventory->bindValue(':cost_price', $_POST['cost_price']);
         $stmt_inventory->bindValue(':selling_price', $_POST['selling_price']);
         $stmt_inventory->bindValue(':quantity', $_POST['quantity']);
         $stmt_inventory->execute();
 
             // Commit the transaction
             $conn->commit();
             
             echo "Data inserted into the database successfully.";
             header("Location: adminProduct1.php");
             exit();
         } catch(PDOException $e) {
             // Rollback the transaction if any error occurs
             $conn->rollback();
             echo "Error inserting data into the database: " . $e->getMessage();
         }
     } else {
         echo "Sorry, there was an error uploading your file.";
     }
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
            <a href="adminProduct1.php"><i class="fa-solid fa-arrow-left"></i></a>
            <h2>Add Product</h2>
        </div>

        <div class="add_product">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-container">
                    <div class="form-column">
                        <div class="name-description-box">
                            <label for="product_name">Product Name:</label>
                            <input type="text" id="product_name" name="product_name" required>
                            <label for="ProductDescription">Product Description:</label>
                            <textarea id="ProductDescription" name="ProductDescription" rows="4" cols="30"
                                required></textarea>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="image-section">
                            <label for="product_images" class="file-input-container">Product Images:</label>
                            <input type="file" id="product_images" class="file-input" name="ProductImg" multiple>
                        </div>
                        <div class="categories-section">
                            <label for="categories">Categories:</label>
                            <input type="text" name="category">
                        </div>
                    </div>
                </div>

                <div class="form-container">
                    <div class="price-box">
                        <label for="selling_price">Selling Price:</label>
                        <input type="number" id="selling_price" name="selling_price" step="0.01" required>

                        <label for="cost_price">Cost Price:</label>
                        <input type="number" id="cost_price" name="cost_price" step="0.01" required>
                    </div>

                    <div class="product-options">
                        <label for="product-options">Product Options</label>
                        <div class="product-option">
                            <div class="product-option-header">
                                Color
                            </div>
                            <div class="product-option-input">
                                <input type="text" name="ProductColor">
                            </div>
                        </div>
                        <div class="product-option">
                            <div class="product-option-header">
                                Size
                            </div>
                            <div class="product-option-input">
                                <input type="text" name="size">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="form-container1">
                    <div class="quantity-box">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" required>
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


                <input id="submit" type="submit" value="add" class="submit-button" name="add">
            </form>
        </div>
    </section>

    <script src="script.js"></script>
    <script src="script2.js"> </script>
    <!-- Add this script in your HTML file -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            const productName = document.getElementById('product_name').value;
            const productDescription = document.getElementById('ProductDescription').value;
            const productImage = document.getElementById('product_images').value;
            const category = document.getElementsByName('category')[0].value;
            const sellingPrice = parseFloat(document.getElementById('selling_price').value);
            const costPrice = parseFloat(document.getElementById('cost_price').value);
            const quantity = parseInt(document.getElementById('quantity').value);
            const productColor = document.getElementsByName('ProductColor')[0].value;
            const size = document.getElementsByName('size')[0].value;

            // Regular expressions for validation
            const startsWithNumber = /^\d/;
            const containsSymbols = /[!@#$%^&*(),.?":{}|<>]/;
            const containsNumbers = /\d/;

            // Validation checks
            if (startsWithNumber.test(productName) || containsSymbols.test(productName)) {
                alert('Product Name should not start with a number or contain symbols.');
                event.preventDefault();
            } else if (productDescription.split(' ').length < 4) {
                alert('Product Description should contain at least four words.');
                event.preventDefault();
            } else if (!/\.(jpe?g|png)$/i.test(productImage)) {
                alert('Please upload a valid image file (jpg, jpeg, png).');
                event.preventDefault();
            } else if (startsWithNumber.test(category) || containsSymbols.test(category)) {
                alert('Categories should not start with a number or contain symbols.');
                event.preventDefault();
            } else if (sellingPrice < 0 || costPrice < 0 || quantity < 0) {
                alert('Selling Price, Cost Price, and Quantity should not be negative.');
                event.preventDefault();
            } else if (containsNumbers.test(productColor)) {
                alert('Color should not contain numbers.');
                event.preventDefault();
            } else if (containsNumbers.test(size)) {
                alert('Size should not contain numbers.');
                event.preventDefault();
            }
        });
    });
    </script>



</body>

</html>