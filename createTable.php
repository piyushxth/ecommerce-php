<?php
// Include the database connection file
include "./connectServer.php";
try{
// Rest of your code for creating tables
$createTable1 = "CREATE TABLE sales (
    id int(32) AUTO_INCREMENT PRIMARY KEY,
    date varchar(32),
    customerName varchar(32),
    reference varchar(32),
    status varchar(32),
    payments varchar(32),
    total int(32),
    paid int(32),
    due int(32),
    biller varchar(32)
)";

// Execute the table creation statement
$createTable2 = "CREATE TABLE newProduct (
    id int(32) AUTO_INCREMENT PRIMARY KEY,
    ProductName varchar(32),
    ProductPrice int(32),
    ProductSpec varchar(32)
)";

$createTable3 = "CREATE TABLE newuser (
    id int(255) AUTO_INCREMENT PRIMARY KEY,
    username varchar(255),
    email varchar(255),
    pass varchar(255)
)";

$createTable4 = "CREATE TABLE adminInfo (
    id int(32) AUTO_INCREMENT PRIMARY KEY,
    username varchar(32),
    email varchar(32),
    pass varchar(32)
)";

$createTable5 = "CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Pid int(255),
    ProductImg VARCHAR(255),
    ProductName VARCHAR(255),
    inventory int(255),
    ProductPrice DECIMAL(10, 2),
    ProductColor VARCHAR(50),
    Keyword VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    sellingPrice int(255),
    size VARCHAR(255),
    ProductDescription TEXT
)";

$createTable5 = "CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orderId int(255),
    CustomerName VARCHAR(255),
    TotalPrice DECIMAL(10, 2),
    PaymentStatus VARCHAR(255),
    PaymentMethod VARCHAR(50),
    Status VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     
)";

$createTable6 = "CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id int(255),
    Pid int(255),
    ProductImg VARCHAR(255),
    ProductName VARCHAR(255),
    ProductPrice DECIMAL(10, 2),
    Quantity int(255),
    ProductColor VARCHAR(50)
)";


// Execute each table creation statement
$conn->exec($createTable1);
$conn->exec($createTable2);
$conn->exec($createTable3);
$conn->exec($createTable4);
$conn->exec($createTable5);
$conn->exec($createTable6);



echo "Tables created successfully";
}
catch (PDOException $e) {
    // Handle any database errors
    echo "Error: " . $e->getMessage();
}
?>