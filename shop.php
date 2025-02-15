<?php
include "./connectServer.php";
session_start();


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include "./wishlist.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ICONIC SHOP</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style1.css" />


    </style>
</head>

<body>

    <?php $currentPage='shop.php'; include "user_header.php"; ?>

    <section id="product1" class="section-p1">
        <h3>OUR PRODUCTS</h3>
        <div class="pro-container">
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
            <div class="pro">
                <form action="s_product.php?Pid=<?= $fetch_product['product_id']; ?>" method="post" class="box">
                    <input type="hidden" name="Pid" value="<?= $fetch_product['product_id']; ?>">
                    <input type="hidden" name="ProductName" value="<?= $fetch_product['ProductName']; ?>">
                    <input type="hidden" name="ProductPrice" value=" <?= $fetch_product['ProductPrice']; ?>">
                    <img src="uploads/<?= $fetch_product['ProductImg']; ?>" alt="Product Image">
                    <input type="hidden" name="ProductImg" value="<?= $fetch_product['ProductImg']; ?>">
                    <input type="hidden" name="ProductColor" value="<?=$fetch_product['ProductColor']; ?>">
                    <img src="<?= $fetch_product['ProductImg']; ?>" alt="">
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

                    <button type="submit" name="add-to-s_product" class="add-to-cart">
                        <i class="fa fa-shopping-cart cart"></i>
                    </button>
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

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="img/logo1.png" alt="" />
            <h4>Contact</h4>
            <p><strong> Address:</strong> Nepal Kathmandu Jorpati sundertole</p>
            <p><strong>Hours:</strong> asdfhjklasdf</p>
            <p><strong>Phone:</strong>123456789</p>

            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>About US</h4>
            <a href="#">About us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Whislist</a>
            <a href="#">Track my Order</a>
            <a href="#">Help</a>
        </div>

        <div class="col install">
            <h4>Install App</h4>
            <p>From app store or Google play</p>
            <div class="row">
                <img src="img/pay/app.jpg" alt="" />
                <img src="img/pay/play.jpg" alt="" />
            </div>
            <p>Secured Payment Gateway</p>
            <img src="img/pay/pay.png" alt="" />
        </div>

        <div class="copyright">
            <p>© 2023, Dupy07 etc - Ecommerce (Iconic)</p>
        </div>
    </footer>

    <script src="script1.js">

    </script>
</body>

</html>