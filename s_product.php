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
    <style>
    /* Single Product */
    #prodetails {
        display: flex;
        margin-top: 20px;
    }

    #prodetails .single-pro-img {
        width: 40%;
        margin-right: 50px;
    }

    .small-img-group {
        display: flex;
        justify-content: space-between;
    }

    .small-img-col {
        flex-basis: 24%;
        cursor: pointer;
    }

    #prodetails .single-pro-details {
        width: 50%;
        padding-top: 30px;
    }

    #prodetails .single-pro-details h4 {
        padding: 40px 0 20px 0;
    }

    #prodetails .single-pro-details h2 {
        font-size: 26px;
    }

    #prodetails .single-pro-details select {
        display: block;
        padding: 5px 10px;
        margin-bottom: 10px;
    }

    #prodetails .single-pro-details input {
        width: 50px;
        height: 47px;
        padding-left: 10px;
        font-size: 16px;
        margin-right: 10px;
    }

    #prodetails .single-pro-details button {
        background: #088178;
        color: #fff;
    }

    #prodetails .single-pro-details input:focus {
        outline: none;
    }

    #prodetails .single-pro-details span {
        line-height: 25px;
    }

    #big-img {
        width: 400px;
        height: 400px;
    }
    </style>
</head>

<body>
    <?php $currentPage='shop.php'; include "user_header.php";?>

    <section id="prodetails" class="section-p1">
        <div class="single-pro-img">
            <?php
if(isset($_POST['add-to-s_product'])){
  $Pid = $_POST['Pid'];


  $select_products = $conn->prepare("
  SELECT p.product_id, p.ProductName, p.ProductImg, i.quantity AS Inventory, i.cost_price AS ProductPrice, 
  c.color_name AS ProductColor, p.keyword, p.created_at, i.selling_price AS SellingPrice, 
  s.size_name AS Size, p.ProductDescription 
  FROM pro1 p
  INNER JOIN inventory i ON p.product_id = i.product_id
  INNER JOIN colors c ON i.color_id = c.color_id
  INNER JOIN sizes s ON i.size_id = s.size_id
  WHERE p.product_id = :Pid
");

$select_products->bindParam(':Pid', $Pid, PDO::PARAM_INT); // Assuming Pid is an integer
$select_products->execute();

  if($select_products->rowCount() > 0) {
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
  ?>

            <form action="" method="post" class="box">
                <input type="hidden" name="Pid" value="<?= $fetch_product['product_id']; ?>">
                <input type="hidden" name="ProductName" value="<?= $fetch_product['ProductName']; ?>">
                <input type="hidden" name="ProductPrice" value="<?= $fetch_product['ProductPrice']; ?>">
                <input type="hidden" name="ProductImg" value="<?= $fetch_product['ProductImg']; ?>">
                <input type="hidden" name="ProductColor" value="<?= $fetch_product['ProductColor']; ?>">
                <img id="big-img" src="uploads/<?= $fetch_product['ProductImg']; ?>" alt="Product Image">

                <!-- <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="img/products/f1.jpg" width="100%" class="small-img" alt="" />
                    </div>
                    <div class="small-img-col">
                        <img src="img/products/f2.jpg" width="100%" class="small-img" alt="" />
                    </div>
                    <div class="small-img-col">
                        <img src="img/products/f3.jpg" width="100%" class="small-img" alt="" />
                    </div>
                    <div class="small-img-col">
                        <img src="img/products/f4.jpg" width="100%" class="small-img" alt="" />
                    </div>
                </div> -->
        </div>

        <div class="single-pro-details">
            <h6>Home/T-Shirt</h6>
            <h4>Men's Fashion T-Shirt</h4>
            <h2>Rs <?= $fetch_product['ProductPrice']; ?></h2>
            <select>
                <option>Select Size</option>
                <option>XL</option>
                <option>XXL</option>
                <option>Small</option>
                <option>Large</option>
            </select>
            <input type="number" name="qty" class="qty" min="1" max="99"
                onkeypress="if(this.value.length == 2) return false;" value="1">

            <button type="submit" name="add-to-cart" class="normal add-to-cart" data-product-id=1>Add To Cart</button>

            <h4>Product Details</h4>
            <span>
                Product Name : <?= $fetch_product['ProductName']; ?>
            </span> <br>
            <span>
                Product Color : <?= $fetch_product['ProductColor']; ?>
            </span><br>
            <span>
                Product Size : <?= $fetch_product['Size']; ?>
            </span><br>
            <?php
            }
        }else{
            echo '<p class="empty">no products found!</p>';
        }
}
        ?>
            </form>
        </div>
    </section>


    <script src="script1.js"></script>
    <script>
    var MainImg = document.getElementById("MainImg");
    var smallImg = document.getElementsByClassName("small-img");

    smallImg[0].onclick = function() {
        MainImg.src = smallImg[0].src;
    };
    smallImg[1].onclick = function() {
        MainImg.src = smallImg[1].src;
    };
    smallImg[2].onclick = function() {
        MainImg.src = smallImg[2].src;
    };
    smallImg[3].onclick = function() {
        MainImg.src = smallImg[3].src;
    };
    </script>

</body>

</html>