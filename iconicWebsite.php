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
    <title>ICONIC</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style1.css" />

</head>

<body>
    <?php $currentPage='iconicWebsite.php';include "user_header.php"; ?>
    <section id="hero">
        <h4>Offer-Offer-Offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with free gifts & up to 40% off!</p>

        <!-- Countdown Timer -->
        <div id="launch-time" class="launch-time">
            <div>
                <p id="days">00</p>
                <span>Days</span>
            </div>
            <div>
                <p id="hours">00</p>
                <span>Hours</span>
            </div>
            <div>
                <p id="minutes">00</p>
                <span>Minutes</span>
            </div>
            <div>
                <p id="seconds">00</p>
                <span>Seconds</span>
            </div>
        </div>
        <a href="shop.php" class="normal"> Shop Now </a>

    </section>

    <section id="feature" class="section-p1">
        <h3>SHOP BY CATEGORY</h3>
        <div class="container">
            <a href="category.php?Keyword=Tshirt">
                <div class="fe-box">
                    <img src="img/features/f0.png" alt="" />
                    <h6>T-Shirts</h6>
                </div>
            </a>
            <a href="category.php?Keyword=Pants">
                <div class="fe-box">
                    <img src="img/features/f2.png" alt="" />
                    <h6>Pants</h6>
                </div>
            </a>
            <a href="category.php?Keyword=Jackets">
                <div class="fe-box">
                    <img src="img/features/f3.png" alt="" />
                    <h6>Jackets</h6>
                </div>
            </a>
            <a href="category.php?Keyword=Hoodies">
                <div class="fe-box">
                    <img src="img/features/f4.png" alt="" />
                    <h6>Hoodies</h6>
                </div>
            </a>
            <a href="category.php?Keyword=CargoPants">
                <div class="fe-box">
                    <img src="img/features/f5.png" alt="" />
                    <h6>Cargo Pants</h6>
                </div>
            </a>

        </div>
    </section>

    <section id="product1" class="section-p1">
        <h3>Featured Products</h3>
        <p>Winter Collection New Modern Design</p>
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


    <?php include "./user_footer.php"; ?>

    <script src="script1.js">

    </script>
    <script>
    // Count Down function of Home page
    function updateCountDown() {
        var countDownDate = new Date("Nov 17, 2024 00:00:00").getTime();
        var now = new Date().getTime();
        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").textContent = days
            .toString()
            .padStart(2, "0");
        document.getElementById("hours").textContent = hours
            .toString()
            .padStart(2, "0");
        document.getElementById("minutes").textContent = minutes
            .toString()
            .padStart(2, "0");
        document.getElementById("seconds").textContent = seconds
            .toString()
            .padStart(2, "0");

        if (distance <= 0) {
            clearInterval(launchtimeInterval);
            document.getElementById("launch-time").textContent = "Countdown Expired";
        }
    }

    updateCountDown();
    const launchtimeInterval = setInterval(updateCountDown, 1000);
    </script>
</body>

</html>