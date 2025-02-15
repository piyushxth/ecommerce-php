<?php
include "./connectServer.php";
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
 }else{
    $user_id = '';
 };
$currentPage = basename($_SERVER['PHP_SELF']);
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>

<section id="header">
    <a href="#"><img src="img/logo3.png" class="logo" alt="" /></a>

    <div>
        <ul id="navbar">
            <li><a href="iconicWebsite.php"
                    <?php echo ($currentPage === 'iconicWebsite.php') ? 'class="active"':''?>>Home</a></li>
            <li><a href="shop.php"
                    <?php echo (in_array($currentPage, ['shop.php', 's_product.php'])) ? 'class="active"':''?>>Shop</a>
            </li>

            <li><a href="blog.php" <?php echo ($currentPage === 'blog.php') ? 'class="active"':''?>>Blog</a></li>
            <li><a href="about.php" <?php echo ($currentPage === 'about.php') ? 'class="active"':''?>>About</a></li>
            <li><a href="contact.php" <?php echo ($currentPage === 'contact.php') ? 'class="active"':''?>>Contact</a>
            <li><a href="userOrders.php"
                    <?php echo ($currentPage === 'userOrders.php') ? 'class="active"':''?>>Orders</a>
            </li>

            <li>
                <a id="lg-bag" href="cart.php" <?php echo ($currentPage === 'cart.php') ? 'class="active"':''?>>
                    <i class="fa fa-shopping-cart cart"></i>
                    <span>(<?= $total_cart_counts; ?>)</span>
                </a>
            </li>
            <li>
                <a href="search.php" <?php echo ($currentPage === 'search.php') ? 'class="active"':''?>>
                    <i class="fas fa-search"></i>
                </a>
            </li>
            <li>
                <div id="user-btn" class="fas fa-user"></div>

            </li>

            <a href="#" id="close">
                <i class="far fa-times"></i>
            </a>

        </ul>
    </div>

    <div id="profile">
        <?php          
            $select_profile = $conn->prepare("SELECT * FROM newuser WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
        <p><?= $fetch_profile["username"]; ?></p>
        <a href="updateUser.php" class="btn">update profile</a>
        <div class="flex-btn">
            <a href="userRegister.php" class="option-btn"
                <?php echo ($currentPage === 'shop.php') ? 'class="active"':''?>>register</a>
            <a href="userLogin.php" class="option-btn">login</a>
        </div>
        <a href="userLogout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>
        <?php
            }else{
         ?>
        <p>please login or register first!</p>
        <div class="flex-btn">
            <a href="userRegister.php" class="option-btn"
                <?php echo ($currentPage === 'userRegister.php') ? 'class="active"':''?>>register</a>
            <a href="userLogin.php" class="option-btn"
                <?php echo ($currentPage === 'userLogin.php') ? 'class="active"':''?>>login</a>
        </div>
        <?php
            }
         ?>


    </div>



    <div id="mobile">
        <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>