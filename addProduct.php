<?php
include "./connectServer.php";

if (isset($_POST['addProduct'])) {
    include "./connectServer.php";

    $ProductName = $_POST["ProductName"];
    $ProductPrice = $_POST["ProductPrice"];
    $ProductSpec = $_POST["ProductSpec"];

    //Inserting into table in database
    $insertQuery = "INSERT INTO newproduct (ProductName, ProductPrice, ProductSpec)
    VALUES ('$ProductName', '$ProductPrice', '$ProductSpec')";

    //Checking if the datas are inserted in the table or not and relocating the page 
    if ($conn->query($insertQuery) === TRUE) {
        // Redirect to a different page or use a header refresh
        header("salesDash.php");
        exit(); // Make sure to exit to prevent further execution
    } else {
        echo "Data insertion failed";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css" class="stylesheet" />
    <title>Order Database</title>
</head>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap");



    .fas fa-bars:hover {
        background-color: blue;
    }
</style>

<body>
    <section class="section-p1">
        <h1>ADD PRODUCT</h1>
        <form id="addProductForm" method="post">
            <label for="ProductName">Product Name</label>
            <input type="text" id="ProductName" name="ProductName" required><br>

            <label for="ProductPrice"> ProductPrice</label>
            <input type="text" id="ProductPrice" name="ProductPrice" required><br>

            <label for="ProductSpec">ProductSpec</label>
            <input type="text" id="ProductSpec" name="ProductSpec" required><br>

            <input type="submit" value="Submit" name="addProduct">
        </form>
    </section>

</body>

</html>