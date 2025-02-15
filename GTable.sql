CREATE TABLE `admininfo` (
`id` int(32) NOT NULL ,
`username` varchar(32) NULL DEFAULT 'NULL',
`email` varchar(32) NULL DEFAULT 'NULL',
`pass` varchar(32) NULL DEFAULT 'NULL'
);

CREATE TABLE `cart` (
`id` int(11) NOT NULL ,
`user_id` int(255) NULL DEFAULT 'NULL',
`Pid` int(255) NULL DEFAULT 'NULL',
`ProductImg` varchar(255) NULL DEFAULT 'NULL',
`ProductName` varchar(255) NULL DEFAULT 'NULL',
`ProductPrice` decimal(10,2) NULL DEFAULT 'NULL',
`Quantity` int(255) NULL DEFAULT 'NULL',
`ProductColor` varchar(50) NULL DEFAULT 'NULL'
);

CREATE TABLE `cart_orders` (
`order_id` int(11) NOT NULL ,
`customerName` varchar(255) NOT NULL ,
`email` varchar(255) NOT NULL ,
`user_id` int(11) NOT NULL ,
`totalPrice` decimal(10,2) NOT NULL ,
`CustomerNumber` varchar(20) NOT NULL ,
`CustomerAddress` text NOT NULL ,
`PaymentMethod` varchar(50) NOT NULL ,
`created_at` datetime NOT NULL DEFAULT 'current_timestamp()',
`PaymentStatus` varchar(50) NULL DEFAULT ''Pending'',
`Quantity` int(11) NULL DEFAULT 'NULL',
`ProductPrice` decimal(10,2) NULL DEFAULT 'NULL',
`ProductImg` varchar(255) NULL DEFAULT 'NULL'
);

CREATE TABLE `colors` (
`color_id` int(11) NOT NULL ,
`product_id` int(11) NULL DEFAULT 'NULL',
`color_name` varchar(50) NOT NULL 
);

CREATE TABLE `inventory` (
`inventory_id` int(11) NOT NULL ,
`color_id` int(11) NULL DEFAULT 'NULL',
`size_id` int(11) NULL DEFAULT 'NULL',
`cost_price` decimal(10,2) NOT NULL ,
`selling_price` decimal(10,2) NOT NULL ,
`quantity` int(11) NOT NULL ,
`product_id` int(11) NOT NULL 
);

CREATE TABLE `newproduct` (
`id` int(32) NOT NULL ,
`ProductName` varchar(32) NULL DEFAULT 'NULL',
`ProductPrice` int(32) NULL DEFAULT 'NULL',
`ProductSpec` varchar(32) NULL DEFAULT 'NULL'
);

CREATE TABLE `newuser` (
`id` int(255) NOT NULL ,
`username` varchar(255) NULL DEFAULT 'NULL',
`email` varchar(255) NULL DEFAULT 'NULL',
`pass` varchar(255) NULL DEFAULT 'NULL'
);

CREATE TABLE `orders` (
`id` int(11) NOT NULL ,
`orderId` int(255) NULL DEFAULT 'NULL',
`CustomerName` varchar(255) NULL DEFAULT 'NULL',
`TotalPrice` decimal(10,2) NULL DEFAULT 'NULL',
`PaymentStatus` varchar(255) NULL DEFAULT 'NULL',
`PaymentMethod` varchar(50) NULL DEFAULT 'NULL',
`Status` varchar(50) NULL DEFAULT 'NULL',
`created_at` timestamp NOT NULL DEFAULT 'current_timestamp()'
);

CREATE TABLE `pro1` (
`product_id` int(11) NOT NULL ,
`ProductImg` varchar(255) NULL DEFAULT 'NULL',
`ProductName` varchar(255) NULL DEFAULT 'NULL',
`keyword` varchar(255) NULL DEFAULT 'NULL',
`ProductDescription` text NULL DEFAULT 'NULL',
`created_at` timestamp NOT NULL DEFAULT 'current_timestamp()'
);

CREATE TABLE `products` (
`id` int(11) NOT NULL ,
`Pid` int(255) NULL DEFAULT 'NULL',
`ProductImg` varchar(255) NULL DEFAULT 'NULL',
`ProductName` varchar(255) NULL DEFAULT 'NULL',
`inventory` int(255) NULL DEFAULT 'NULL',
`ProductPrice` decimal(10,2) NULL DEFAULT 'NULL',
`ProductColor` varchar(50) NULL DEFAULT 'NULL',
`Keyword` varchar(255) NULL DEFAULT 'NULL',
`created_at` timestamp NOT NULL DEFAULT 'current_timestamp()',
`sellingPrice` int(255) NULL DEFAULT 'NULL',
`size` varchar(50) NULL DEFAULT 'NULL',
`ProductDescription` text NULL DEFAULT 'NULL'
);

CREATE TABLE `sizes` (
`size_id` int(11) NOT NULL ,
`product_id` int(11) NULL DEFAULT 'NULL',
`size_name` varchar(50) NOT NULL 
);

