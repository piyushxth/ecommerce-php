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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleiconicWebsite2.css">
    <script src="https://kit.fontawesome.com/35cb133e46.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <title>Document</title>
</head>

<body>

    <section id="header">
        <div class="header-top">
            <div class="header-left">
                <span>Free shipping, 30-day return or refund guarantee.</span>
            </div>
            <div class="header-right">
                <a href="">SIGN IN</a>
                <a href="">FAQs</a>
            </div>
        </div>

        <div class="nav section-p1">
            <div class="header-logo">
                <img src="img/logo3.png" alt="">
            </div>
            <div class="header-menu">
                <div class="offcanva-logo">
                    <img src="img/logo3.png" alt="">
                </div>
                <div class="offcanvas-option">
                    <a href="">SIGN IN</a>
                    <a href="">FAQs</a>
                </div>
                <div class="offcanvas-nav-options">
                    <i class="fas fa-search"></i>
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <ul>
                    <li><i class="fa-solid fa-house"></i><a href="" class="active">Home</a> </li>
                    <li><i class="fa-solid fa-shop"></i><a href="">Shop</a> </li>
                    <li><i class="fa-regular fa-file"></i><a href="">Pages</a> </li>
                    <li><i class="fa-solid fa-blog"></i><a href="">Blog</a> </li>
                    <li><i class="fa-regular fa-address-book"></i><a href="">Contacts</a> </li>
                </ul>
                <div class="offcanvas-p">
                    <span>Free shipping, 30-day return or refund guarantee.</span>
                </div>
            </div>
            <div class="header-nav-options">
                <i class="fas fa-search"></i>
                <i class="fa-regular fa-heart"></i>
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div class="menu-bar">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </section>

    <section class="hero">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="hero-text">
                        <h6>Winter Collection</h6>
                        <h2>Fall - Winter <br> Collections 2024</h2>
                        <p>Discover top-tier winter fashion essentials with exceptional <br> service, ensuring warmth
                            and style.</p>
                        <button class="normal">SHOP NOW</button>
                        <div class="hero-social">
                            <i class="fa-brands fa-facebook-f"></i>
                            <i class="fa-brands fa-instagram"></i>
                            <i class="fa-brands fa-tiktok"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="hero-text">
                        <h6>Winter Collection</h6>
                        <h2>Fall - Winter <br> Collections 2024</h2>
                        <p>Discover top-tier winter fashion essentials with exceptional <br> service, ensuring warmth
                            and style.</p>
                        <button class="normal">SHOP NOW</button>
                        <div class="hero-social">
                            <i class="fa-brands fa-facebook-f"></i>
                            <i class="fa-brands fa-instagram"></i>
                            <i class="fa-brands fa-tiktok"></i>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="categories  section-p1">
        <h3 class="section__title"><span>Popular</span> Categories </h3>
        <div class="categories__container swiper">
            <div class="swiper-wrapper">
                <a href="shop.html" class="category__item swiper-slide">
                    <img src="img/products/f1.jpg" alt="" class="category__img">
                    <h6 class="category__title">T-Shirt</h6>
                </a>
                <a href="shop.html" class="category__item swiper-slide">
                    <img src="img/products/f1.jpg" alt="" class="category__img">
                    <h6 class="category__title">Hoodie</h6>
                </a>
                <a href="shop.html" class="category__item swiper-slide">
                    <img src="img/products/f5.jpg" alt="" class="category__img">
                    <h6 class="category__title">Pant</h6>
                </a>
                <a href="shop.html" class="category__item swiper-slide">
                    <img src="img/products/f4.jpg" alt="" class="category__img">
                    <h6 class="category__title">Sweatshirt</h6>
                </a>
                <a href="shop.html" class="category__item swiper-slide">
                    <img src="img/products/f5.jpg" alt="" class="category__img">
                    <h6 class="category__title">Shoes</h6>
                </a>
                <a href="shop.html" class="category__item swiper-slide">
                    <img src="img/products/f2.jpg" alt="" class="category__img">
                    <h6 class="category__title">Joggers</h6>
                </a>
                <a href="shop.html" class="category__item swiper-slide">
                    <img src="img/products/f1.jpg" alt="" class="category__img">
                    <h6 class="category__title">Sweater</h6>
                </a>
                <a href="shop.html" class="category__item swiper-slide">
                    <img src="img/products/f3.jpg" alt="" class="category__img">
                    <h6 class="category__title">Jackets</h6>
                </a>
            </div>
            <div class="swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>
            <div class="swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
        </div>
    </section>

    <section id="products" class="section-p1">
        <h3 class="products__title"><span> FEATURED</span> PRODUCTS</h3>
        <p class="products_title_desc">Winter Collection New Modern Design</p>
        <div class="tab__btns">
            <span class="tab__btn active-tab">Featured</span>
            <span class="tab__btn">Popular</span>
            <span class="tab__btn">New Added</span>
        </div>
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

                    <input type="hidden" name="ProductImg" value="<?= $fetch_product['ProductImg']; ?>">
                    <input type="hidden" name="ProductColor" value="<?=$fetch_product['ProductColor']; ?>">
                    <div class="product__item">
                        <div class="product__images">
                            <img src="uploads/<?= $fetch_product['ProductImg']; ?>" class="product__img default" alt="">
                            <img src="uploads/<?= $fetch_product['ProductImg']; ?>" class="product__img hover" alt="">
                        </div>
                        <div class="product__actions">
                            <a href="" class="action__btn" aria-label="Quick View">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="" class="action__btn" aria-label="Add to Wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </a>
                            <a href="" class="action__btn" aria-label="Compare">
                                <i class="fa-solid fa-shuffle"></i>
                            </a>
                        </div>

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

                        <button type="submit" name="add-to-s_product" class="add-to-cart cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </div>
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
    <footer>
        <div class="col">
            <img class="logo" src="img/logo3.png" alt="" />
            <h4>Contact</h4>
            <p><strong> Address:</strong> Nepal Kathmandu </p>
            <p><strong>Hours:</strong> 10 AM - 6 PM, Sun-Sat</p>
            <p><strong>Phone:</strong>9803376882</p>

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
        <div class="col about-us">
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

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        speed: 3000,
        loop: true,
        // autoplay: {
        //     delay: 8000, // Set the delay in milliseconds between slides
        //     disableOnInteraction: true, // Continue autoplay even when user interacts with the slider
        // },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });



    var swiperCategories = new Swiper('.categories__container', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: false,
        navigation: {
            nextEl: ".categories .swiper-button-next", // Corrected class reference
            prevEl: ".categories .swiper-button-prev", // Corrected class reference
        },
        breakpoints: {

            330: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            670: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            890: {
                slidesPerView: 4,
                spaceBetween: 40,
            },

            1150: {
                slidesPerView: 5,
                spaceBetween: 40,
            }
        },
    });

    document.addEventListener("DOMContentLoaded", function() {
        const menuBar = document.querySelector('.menu-bar');
        const headerMenu = document.querySelector('.header-menu');

        menuBar.addEventListener('click', function() {
            headerMenu.classList.toggle('show-menu');
        });
    });
    </script>
</body>

</html>