<?php

include "./connectServer.php";
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
if(isset($_POST['register'])){

   $name = $_POST['username'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['password']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['c_password']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM newuser WHERE email = ?");
   $select_user->execute([$email,]);
  

   if($select_user->rowCount() > 0){
      $message[] = 'email already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO newuser (username, email, pass) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $message[] = 'registered successfully, login now please!';
      
      }
   }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search Bar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style1.css" />
    <style>
    body {
        background-color: #f6f6f9;
    }

    .registrationForm {
        position: absolute;
        top: 55%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;

        border-radius: 2rem;

        box-shadow: 0 2rem 3rem rgba(132, 139, 200, 0.18);
        transition: all 300ms ease;
        padding: 1rem;
        width: 400px;
    }

    .registrationForm h3 {
        font-size: 16px;
        text-align: center;
        margin-top: 1rem
    }

    .registrationForm input {
        width: 100%;
        margin-top: 1rem;
        height: 3rem;
        padding: 1rem;
        background: #f6f6f9;
        border: none;
        border-radius: 2rem;
    }

    .registrationForm form #register {
        background: blue;
        opacity: 75%;
        color: #fff;
        cursor: pointer;
    }

    .registrationForm form .login {
        background: red;
        opacity: 75%;
        cursor: pointer;
        width: 100%;
        height: 3rem;
        padding: 1rem;
        border: none;
        border-radius: 2rem;
        text-align: center;
    }

    .registrationForm form a {
        font-size: 16px;
        color: #fff;
        text-decoration: none;
    }

    .registrationForm form p {
        text-align: center;
    }
    </style>
</head>

<body>
    <?php $currentPage="userRegister.php"; include "user_header.php";?>

    <section class="registrationForm">
        <form action="" method="POST" onsubmit="return validateForm()">
            <h3>Register Now</h3>
            <input type="text" name="username" id="username" placeholder="Enter your username">
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <input type="password" name="password" id="password" placeholder="Enter your password">
            <input type="password" name="c_password" id="c_password" placeholder="Confirm your password">
            <input id="register" type="submit" value="register" class="register" name="register">
            <p>Already have an account?</p>
            <div class="login">
                <a href="userLogin.php">Login</a>
            </div>
        </form>
    </section>

    <script>
    function validateForm() {
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('c_password').value;

        // Check if any field is empty
        if (username.trim() === '' || email.trim() === '' || password.trim() === '' || confirmPassword.trim() === '') {
            alert('Please fill in all fields.');
            return false;
        }

        // Regular expression to check if the username starts with a number or contains symbols
        var regex = /^[0-9]|[^a-zA-Z0-9]/;

        if (regex.test(username)) {
            alert('Invalid username! It should not start with a number or contain symbols and spaces.');
            return false;
        }

        return true;
    }
    </script>
</body>

</html>