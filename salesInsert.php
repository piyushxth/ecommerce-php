<?php
include "./connectServer.php";

if (isset($_POST['submit'])) {
    include "./connectServer.php";
    $date = $_POST["date"];
    $customerName = $_POST["customerName"];
    $reference = $_POST["reference"];
    $status = $_POST["status"];
    $payments = $_POST["payments"];
    $total = $_POST["total"];
    $paid = $_POST["paid"];
    $due = $_POST["due"];
    $biller = $_POST["biller"];

    //Inserting into table in database
    $insertQuery = "INSERT INTO sales (date, customerName, reference, status, payments, total, paid, due, biller)
    VALUES ('$date', '$customerName', '$reference', '$status', '$payments', '$total', '$paid', '$due', '$biller')";

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
        <h1>Invoice Form</h1>
        <form id="invoiceForm" method="post">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br>

            <label for="customerName">Customer Name:</label>
            <input type="text" id="customerName" name="customerName" required><br>

            <label for="reference">Reference:</label>
            <input type="text" id="reference" name="reference" required><br>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
            </select><br>

            <label for="payments">Payments:</label>
            <select id="payments" name="payments" required>
                <option value="Due">Due</option>
                <option value="Paid">Paid</option>
            </select><br>

            <label for="total">Total:</label>
            <input type="number" id="total" name="total" required><br>

            <label for="paid">Paid:</label>
            <input type="number" id="paid" name="paid" required><br>

            <label for="due">Due:</label>
            <input type="number" id="due" name="due" required><br>

            <label for="biller">Biller:</label>
            <input type="text" id="biller" name="biller" required><br>

            <input type="submit" value="Submit" name="submit">
        </form>
    </section>

</body>

</html>