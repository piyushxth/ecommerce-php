<?php




if(isset($_POST['add-to-cart'])){
    
    if($user_id == ''){
        header('location:userLogin.php');
     }else{
      
    $pid = $_POST['Pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $name = $_POST['ProductName'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['ProductPrice'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $img = $_POST['ProductImg'];
    $img = filter_var($img, FILTER_SANITIZE_STRING);
    $color = $_POST['ProductColor']; 
    $color = filter_var($color, FILTER_SANITIZE_STRING);
    $quantity = $_POST['qty'];

    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE Pid = ? AND user_id = ?");
    $check_cart_numbers->execute([$pid, $user_id]);

    if($check_cart_numbers->rowCount() > 0){
        $message[] = 'already added to cart!';
     }else{
        $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id,Pid, ProductImg, ProductName, ProductPrice, ProductColor,Quantity) VALUES(?,?,?,?,?,?,?)");
         $insert_cart->execute([$user_id,$pid,$img, $name, $price,$color,$quantity]);
         $message[] = 'added to cart!';
     }
}}
?>