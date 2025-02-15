<?php
include "./connectServer.php";

if(isset($_POST['add'])) {
    include "./connectServer.php"; // Modify this to match your database connection file

    // Get other form data
    $ProductName = $_POST['product_name'];
    $ProductColor = $_POST['ProductColor'];
    $ProductDescription = $_POST['ProductDescription'];
    $ProductPrice = $_POST['cost_price'];
    $category = $_POST['category'];
    $inventory = $_POST['quantity'];
    $sellingPrice = $_POST['selling_price'];
    $size = $_POST['size'];

    // Handle file upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["ProductImg"]["name"]);

    // Additional processing and checks for file upload...
    if (move_uploaded_file($_FILES["ProductImg"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["ProductImg"]["name"])) . " has been uploaded.";

        $filePathInDb = $targetFile;

        // Insert data into the database
        $sql = "INSERT INTO products (ProductImg, ProductName, ProductColor, ProductPrice, inventory,keyword,sellingPrice,size,ProductDescription) 
        VALUES (:ProductImg, :ProductName, :ProductColor, :ProductPrice, :inventory,:category,:sellingPrice,:size,:ProductDescription)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':ProductImg', $filePathInDb);
        $stmt->bindValue(':ProductName', $ProductName);
        $stmt->bindValue(':ProductColor', $ProductColor);
        $stmt->bindValue(':ProductPrice', $ProductPrice);
        $stmt->bindValue(':inventory', $inventory);
        $stmt->bindValue(':category',$category);
        $stmt->bindValue(':sellingPrice',$sellingPrice);
        $stmt->bindValue(':size',$size);
        $stmt->bindValue(':ProductDescription',$ProductDescription);

        if ($stmt->execute()) {
            echo "Data inserted into the database successfully.";
            header("Location: adminProduct.php");
            exit();
        } else {
            echo "Error inserting data into the database: " . $stmt->errorInfo()[2];
        }

        $stmt->closeCursor();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
try {
    // Establish a new database connection
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Drop the existing trigger if it exists
    $dropTriggerQuery = "DROP TRIGGER IF EXISTS set_Pid_on_insert";
    $conn->exec($dropTriggerQuery);

    // Create a new trigger with a different name
    $createTriggerQuery = "
    CREATE TRIGGER set_Pid_on_insert
    BEFORE INSERT ON products
    FOR EACH ROW
    BEGIN
        IF NEW.Pid IS NULL THEN
            SET NEW.Pid = NEW.id;
        END IF;
    END;";
    $conn->exec($createTriggerQuery);

    echo "Trigger created successfully";
} catch(PDOException $e) {
    echo "Error creating trigger: " . $e->getMessage();
}

$conn = null;


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
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
    <section class="main">
        <div class="top">
            <img src="profile-1.png" alt="" />
            <h2>ICO<span class="danger">NIC</span></h2>
        </div>

        <button id="menu-btn">
            <span class="material-icons-sharp">menu</span>
        </button>
        <div class="right">
            <div class="theme-toggler" id="theme-toggle-button">
                <span class="material-icons-sharp active"> light_mode </span>
                <span class="material-icons-sharp"> dark_mode </span>
            </div>
            <div class="profile-photo">
                <img src="profile-1.jpg" />
            </div>
        </div>
    </section>

    <section class="container">
        <div class="mains">
            <a href="adminProduct.php">O</a>
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
                        <label for="status">Status:</label>
                        <input type="radio" id="status_active" name="status" value="active" checked>
                        <label for="status_active">Active</label>
                        <input type="radio" id="status_inactive" name="status" value="inactive">
                        <label for="status_inactive">Inactive</label>
                    </div>
                </div>


                <input id="submit" type="submit" value="add" class="submit-button" name="add">
            </form>
        </div>
    </section>

    <script src="script.js"></script>



</body>

</html>