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
</head>

<body>
    <?php $currentPage='contact.php'; include "user_header.php"; ?>


    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>VISIT US</h2>
            <h3>HEAD OFFICE</h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>Kathmandu Jorpati</p>
                </li>
                <li>
                    <i class="fal fa-envelope"></i>
                    <p>iconicofficial@gmail.com</p>
                </li>
                <li>
                    <i class="fal fa-phone-alt"></i>
                    <p>9803039079</p>
                </li>
                <li>
                    <i class="fal fa-clock"></i>
                    <p>01-12-2023</p>
                </li>
            </div>
        </div>
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28253.844100429746!2d85.36262134343664!3d27.72560569817669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1bbeb021a8c3%3A0xf5da322eefd636cd!2sJorpati%2C%2044600!5e0!3m2!1sen!2snp!4v1680972760868!5m2!1sen!2snp"
                width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form action="">
            <span>Leave a message</span>
            <h2>We love to hear from you</h2>
            <input type="text" placeholder="Your Name" />
            <input type="text" placeholder="E-Mail" />
            <input type="text" placeholder="Subject" />
            <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
            <button class="normal">Submit</button>
        </form>
        <div class="people">
            <div>
                <img src="img/people/1.png" alt="" />
                <p>
                    <span>Sonam Hyolmo</span> Senior Marketting Manager <br />
                    Phone: +977 9803392995 <br />
                    Email:abc@gmail.com
                </p>
            </div>
            <div>
                <img src="img/people/1.png" alt="" />
                <p>
                    <span>Piyush Shrestha</span> Senior Marketting Manager <br />
                    Phone: +977 980336882 <br />
                    Email:piyush.xtha5@gmail.com
                </p>
            </div>
            <div>
                <img src="img/people/1.png" alt="" />
                <p>
                    <span>Rohan Shahi</span> Senior Marketting Manager <br />
                    Phone: +977 9803039079 <br />
                    Email:rohanshahi10@gmail.com
                </p>
            </div>
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
    <script src="script1.js"></script>
</body>

</html>