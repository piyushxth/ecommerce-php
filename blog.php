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
    <title>Wear It</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="style1.css" />
</head>

<body>
    <?php $currentPage='blog.php'; include "user_header.php"; ?>

    <section id="page-header" class="blog-header">
        <h2>#readmore</h2>

        <p>Read all case studies about our products</p>
    </section>

    <section id="blog">
        <div class="blog-box">
            <div class="blog-img">
                <img src="img/blog/b1.jpg" alt="" />
            </div>
            <div class="blog-details">
                <h4>The Cotton-Jersey Zip-Up Hoodie</h4>
                <p>
                    Kickstarter man braid fa fak fjas vpa ef v adsf ajvahfd fasd hfqwah
                    vvcsdf jajfa
                </p>
                <a href="#">Continue Reading</a>
            </div>
            <h1>13/01</h1>
        </div>

        <div class="blog-box">
            <div class="blog-img">
                <img src="img/blog/b1.jpg" alt="" />
            </div>
            <div class="blog-details">
                <h4>The Cotton-Jersey Zip-Up Hoodie</h4>
                <p>
                    Kickstarter man braid fa fak fjas vpa ef v adsf ajvahfd fasd hfqwah
                    vvcsdf jajfa
                </p>
                <a href="#">Continue Reading</a>
            </div>
            <h1>13/01</h1>
        </div>

        <div class="blog-box">
            <div class="blog-img">
                <img src="img/blog/b1.jpg" alt="" />
            </div>
            <div class="blog-details">
                <h4>The Cotton-Jersey Zip-Up Hoodie</h4>
                <p>
                    Kickstarter man braid fa fak fjas vpa ef v adsf ajvahfd fasd hfqwah
                    vvcsdf jajfa
                </p>
                <a href="#">Continue Reading</a>
            </div>
            <h1>13/01</h1>
        </div>

        <div class="blog-box">
            <div class="blog-img">
                <img src="img/blog/b1.jpg" alt="" />
            </div>
            <div class="blog-details">
                <h4>The Cotton-Jersey Zip-Up Hoodie</h4>
                <p>
                    Kickstarter man braid fa fak fjas vpa ef v adsf ajvahfd fasd hfqwah
                    vvcsdf jajfa
                </p>
                <a href="#">Continue Reading</a>
            </div>
            <h1>13/01</h1>
        </div>

        <div class="blog-box">
            <div class="blog-img">
                <img src="img/blog/b1.jpg" alt="" />
            </div>
            <div class="blog-details">
                <h4>The Cotton-Jersey Zip-Up Hoodie</h4>
                <p>
                    Kickstarter man braid fa fak fjas vpa ef v adsf ajvahfd fasd hfqwah
                    vvcsdf jajfa
                </p>
                <a href="#">Continue Reading</a>
            </div>
            <h1>13/01</h1>
        </div>
    </section>

    <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            h4 Sign Up for newsletter
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
            <p>© 2023, Dupy07 etc - Ecommerce (Wear It)</p>
        </div>
    </footer>

    <script src="script1.js"></script>
</body>

</html>