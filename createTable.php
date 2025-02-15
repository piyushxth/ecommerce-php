<?php
include "./connectServer.php";
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ICONIC';


    // Create a PDO connection
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

    $tables = [
        'admininfo' => [
            ['id', 'int(32)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['username', 'varchar(32)', 'NULL DEFAULT NULL'],
            ['email', 'varchar(32)', 'NULL DEFAULT NULL'],
            ['pass', 'varchar(32)', 'NULL DEFAULT NULL']
        ],
        'cart' => [
            ['id', 'int(11)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['user_id', 'int(11)', 'NULL DEFAULT NULL'],
            ['Pid', 'int(11)', 'NULL DEFAULT NULL'],
            ['ProductImg', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['ProductName', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['ProductPrice', 'decimal(10,2)', 'NULL DEFAULT NULL'],
            ['Quantity', 'int(11)', 'NULL DEFAULT NULL'],
            ['ProductColor', 'varchar(50)', 'NULL DEFAULT NULL']
        ],
        'cart_orders' => [
            ['order_id', 'int(11)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['customerName', 'varchar(255)', 'NOT NULL'],
            ['email', 'varchar(255)', 'NOT NULL'],
            ['user_id', 'int(11)', 'NOT NULL'],
            ['totalPrice', 'decimal(10,2)', 'NOT NULL'],
            ['CustomerNumber', 'varchar(20)', 'NOT NULL'],
            ['CustomerAddress', 'text', 'NOT NULL'],
            ['PaymentMethod', 'varchar(50)', 'NOT NULL'],
            ['created_at', 'datetime', 'NOT NULL DEFAULT CURRENT_TIMESTAMP'],
            ['PaymentStatus', 'varchar(50)', 'NULL DEFAULT "Pending"'],
            ['Quantity', 'int(11)', 'NULL DEFAULT NULL'],
            ['ProductPrice', 'decimal(10,2)', 'NULL DEFAULT NULL'],
            ['ProductImg', 'varchar(255)', 'NULL DEFAULT NULL']
        ],
        'colors' => [
            ['color_id', 'int(11)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['product_id', 'int(11)', 'NULL DEFAULT NULL'],
            ['color_name', 'varchar(50)', 'NOT NULL']
        ],
        'inventory' => [
            ['inventory_id', 'int(11)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['color_id', 'int(11)', 'NULL DEFAULT NULL'],
            ['size_id', 'int(11)', 'NULL DEFAULT NULL'],
            ['cost_price', 'decimal(10,2)', 'NOT NULL'],
            ['selling_price', 'decimal(10,2)', 'NOT NULL'],
            ['quantity', 'int(11)', 'NOT NULL'],
            ['product_id', 'int(11)', 'NOT NULL']
        ],
        'newproduct' => [
            ['id', 'int(32)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['ProductName', 'varchar(32)', 'NULL DEFAULT NULL'],
            ['ProductPrice', 'int(32)', 'NULL DEFAULT NULL'],
            ['ProductSpec', 'varchar(32)', 'NULL DEFAULT NULL']
        ],
        'newuser' => [
            ['id', 'int(255)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['username', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['email', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['pass', 'varchar(255)', 'NULL DEFAULT NULL']
        ],
        'orders' => [
            ['id', 'int(11)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['orderId', 'int(255)', 'NULL DEFAULT NULL'],
            ['CustomerName', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['TotalPrice', 'decimal(10,2)', 'NULL DEFAULT NULL'],
            ['PaymentStatus', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['PaymentMethod', 'varchar(50)', 'NULL DEFAULT NULL'],
            ['Status', 'varchar(50)', 'NULL DEFAULT NULL'],
            ['created_at', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP']
        ],
        'pro1' => [
            ['product_id', 'int(11)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['ProductImg', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['ProductName', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['keyword', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['ProductDescription', 'text', 'NULL DEFAULT NULL'],
            ['created_at', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP']
        ],
        'products' => [
            ['id', 'int(11)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['Pid', 'int(255)', 'NULL DEFAULT NULL'],
            ['ProductImg', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['ProductName', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['inventory', 'int(255)', 'NULL DEFAULT NULL'],
            ['ProductPrice', 'decimal(10,2)', 'NULL DEFAULT NULL'],
            ['ProductColor', 'varchar(50)', 'NULL DEFAULT NULL'],
            ['Keyword', 'varchar(255)', 'NULL DEFAULT NULL'],
            ['created_at', 'timestamp', 'NOT NULL DEFAULT CURRENT_TIMESTAMP'],
            ['sellingPrice', 'int(255)', 'NULL DEFAULT NULL'],
            ['size', 'varchar(50)', 'NULL DEFAULT NULL'],
            ['ProductDescription', 'text', 'NULL DEFAULT NULL']
        ],
        'sizes' => [
            ['size_id', 'int(11)', 'AUTO_INCREMENT', 'NOT NULL', 'PRIMARY KEY'],
            ['product_id', 'int(11)', 'NULL DEFAULT NULL'],
            ['size_name', 'varchar(50)', 'NOT NULL']
        ]
    ];
    
    

try {
  // Loop through each table and generate CREATE TABLE queries
foreach ($tables as $table => $columns) {
    echo "Creating table $table... `$table`";

    // Drop the table if it exists
    $pdo->exec("DROP TABLE IF EXISTS `$table`");
echo "Table $table dropped successfully!";
   $sql = "CREATE TABLE `$table` (\n";
   echo "Table $table created successfully!";

   // Loop through each column and add it to the SQL query
   $columnQueries = [];
   foreach ($columns as $column) {
       $columnQueries[] = "  `{$column[0]}` {$column[1]} {$column[2]}";
   }

   $sql .= implode(",\n", $columnQueries) . "\n);";

   // Execute the CREATE TABLE query
   $pdo->exec($sql);
   echo "Table $table created successfully!";

     // Seeding data for each table
     $tables = ['admininfo', 'cart', 'cart_orders', 'pro1', 'inventory', 'newproduct', 'newuser', 'orders', 'colors', 'products', 'sizes'];
     foreach ($tables as $table) {
        switch ($table) {
            case 'admininfo':
                $pdo->exec("INSERT INTO admininfo (id, username, email, pass) VALUES
                    (1, 'admin', 'admin@example.com', 'adminpass123')");
                break;
            
            case 'cart':
                $pdo->exec("INSERT INTO cart (id, user_id, Pid, ProductImg, ProductName, ProductPrice, Quantity, ProductColor) VALUES
                    (1, 1, 101, 'img1.jpg', 'Leather Jacket', 199.99, 2, 'Black')");
                break;
            
            case 'cart_orders':
                $pdo->exec("INSERT INTO cart_orders (order_id, customerName, email, user_id, totalPrice, CustomerNumber, CustomerAddress, PaymentMethod, created_at, PaymentStatus, Quantity, ProductPrice, ProductImg) VALUES
                    (1, 'John Doe', 'johndoe@example.com', 1, 399.98, '1234567890', '123 Main St', 'Credit Card', NOW(), 'Pending', 2, 199.99, 'img1.jpg')");
                break;
            
            case 'colors':
                $pdo->exec("INSERT INTO colors (color_id, product_id, color_name) VALUES
                    (1, 101, 'Black'),
                    (2, 102, 'Red')");
                break;
            
            case 'inventory':
                $pdo->exec("INSERT INTO inventory (inventory_id, color_id, size_id, cost_price, selling_price, quantity, product_id) VALUES
                    (1, 1, 1, 150.00, 199.99, 50, 101),
                    (2, 2, 2, 160.00, 210.00, 30, 102)");
                break;
            
            case 'newproduct':
                $pdo->exec("INSERT INTO newproduct (id, ProductName, ProductPrice, ProductSpec) VALUES
                    (1, 'Winter Coat', 299.99, 'Woolen fabric, size M, waterproof')");
                break;
            
            case 'newuser':
                $pdo->exec("INSERT INTO newuser (id, username, email, pass) VALUES
                    (1, 'johndoe', 'johndoe@example.com', 'password123')");
                break;
            
            case 'orders':
                $pdo->exec("INSERT INTO orders (id, orderId, CustomerName, TotalPrice, PaymentStatus, PaymentMethod, Status, created_at) VALUES
                    (1, 1001, 'John Doe', 399.98, 'Pending', 'Credit Card', 'Processing', NOW())");
                break;
            
            case 'pro1':
                $pdo->exec("INSERT INTO pro1 (product_id, ProductImg, ProductName, keyword, ProductDescription, created_at) VALUES
                    (101, 'img1.jpg', 'Leather Jacket', 'leather, jacket, winter', 'A warm and stylish leather jacket.', NOW())");
                break;
            
            case 'products':
                $pdo->exec("INSERT INTO products (id, Pid, ProductImg, ProductName, inventory, ProductPrice, ProductColor, Keyword, created_at, sellingPrice, size, ProductDescription) VALUES
                    (101, 1, 'img1.jpg', 'Leather Jacket', 50, 199.99, 'Black', 'leather, jacket, winter', NOW(), 250.00, 'M', 'A stylish black leather jacket for winter wear.')");
                break;
            
            case 'sizes':
                $pdo->exec("INSERT INTO sizes (size_id, product_id, size_name) VALUES
                    (1, 101, 'M'),
                    (2, 102, 'L')");
                break;
        }
    }
    echo "Data seeded successfully!";

}
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}






echo "SQL queries have been written to 'createTables.sql'";
?>


