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
    <?php $currentPage='about.php'; include "user_header.php"; ?>
    <section id="page-header" class="about-header">
        <h2>#KnowUs</h2>

        <p>Read all case studies about our products</p>
    </section>

    <section id="about-head" class="section-p1">
        <img src="img/about/a6.jpg" alt="" />
        <div>
            <h2>Who We are?</h2>
            <p>
                adf adf jadfj ;fjasd fjauvha eif g asdh afsadhf wa afsdf hadfh qh2w
                fasdf pq ef asdf qe fa fq fasd fqw fa awf qwe fas fwf wefa fwq f af
            </p>
            <abbr title="">Create stunning images with as much as or as little contorol as you
                like thanks to a choice of Basic and cCCraeative modes.
            </abbr>
            <br /><br />
            <marquee>
                Create stunning images with as much or as little control as you like
                thanks to a choce of Basic and Creative modes.
            </marquee>
        </div>
    </section>

    <section id="about-app" class="section-p1">
        <h1>Download our <a href="#"> App</a></h1>
        <div class="video">
            <video autoplay muted loop src="img/about/1.mp4"></video>
        </div>
    </section>


    <section id="feature" class="section-p1">
        <h2>SHOP BY CATEGORY</h2>
        <div class="container">
            <a href="category.php?category=Tshirt">
                <div class="fe-box">
                    <img src="img/features/f0.png" alt="" />
                    <h6>T-Shirts</h6>
                </div>
            </a>
            <a href="category.php?category=Pants">
                <div class="fe-box">
                    <img src="img/features/f2.png" alt="" />
                    <h6>Pants</h6>
                </div>
            </a>
            <a href="category.php?category=Jackets">
                <div class="fe-box">
                    <img src="img/features/f3.png" alt="" />
                    <h6>Jackets</h6>
                </div>
            </a>
            <a href="category.php?category=Hoodies">
                <div class="fe-box">
                    <img src="img/features/f4.png" alt="" />
                    <h6>Hoodies</h6>
                </div>
            </a>
            <a href="category.php?category=CargoPants">
                <div class="fe-box">
                    <img src="img/features/f5.png" alt="" />
                    <h6>Cargo Pants</h6>
                </div>
            </a>
            <a href="category.php?category=CargoShirts">
                <div class="fe-box">
                    <img src="img/features/f6.png" alt="" />
                    <h6>Cargo Shirts</h6>
                </div>
            </a>
        </div>
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
            <p>© 2023, Dupy07 etc - Ecommerce (Wear It)</p>
        </div>
    </footer>

    <script src="script1.js"></script>
</body>

</html>