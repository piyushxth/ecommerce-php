<?php
include "./connectServer.php";
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ICONIC SHOP</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="style1.css" />


    </style>
</head>

<body>

    <?php $currentPage='shop.php'; include "user_header.php"; ?>

    <section id="product1" class="section-p1">
        <h2>OUR PRODUCTS</h2>
        <p>Oversized Down Shoulder T-Shirt</p>
        <div class="pro-container">
            <?php
        $category = $_GET['Keyword'];
        $select_products = $conn->prepare("SELECT p.product_id, p.ProductName, p.ProductImg, i.quantity AS Inventory, i.cost_price AS ProductPrice, 
        c.color_name AS ProductColor, p.keyword, p.created_at, i.selling_price AS SellingPrice, 
        s.size_name AS Size, p.ProductDescription,keyword 
 FROM pro1 p
 INNER JOIN inventory i ON p.product_id = i.product_id
 INNER JOIN colors c ON i.color_id = c.color_id
 INNER JOIN sizes s ON i.size_id = s.size_id
 WHERE Keyword = ?");
        $select_products->execute([$category]);
        
        if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
            <div class="pro">
                <form action="" method="post" class="box">
                    <img src="uploads/<?= $fetch_product['ProductImg']; ?>">
                    <div class="des">
                        <span>Iconic</span>
                        <h5><?=$fetch_product['ProductName']; ?> (<?=$fetch_product['ProductColor']; ?>)</h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>Rs <?= $fetch_product['ProductPrice']; ?><span>/-</span></h4>
                    </div>
                    <a href="s_product.php" class="add-to-cart">
                        <i class="fa fa-shopping-cart cart"></i>
                    </a>
                </form>
            </div>
            <?php
            }
        }else{
            echo '<p class="empty">no products found!</p>';
        }
        ?>
        </div>
    </section>

    <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up for newsletter</h4>
            <p>
                Get email updates about our latest shop and
                <span>special offers.</span>
            </p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address" />
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <?php include "./user_footer.php"; ?>

    <script src="script1.js">

    </script>
</body>

</html>