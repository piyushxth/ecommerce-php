<?php
include "./connectServer.php";

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['login'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['password']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `newuser` WHERE email = ? AND pass = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:iconicWebsite.php');
   }else{
      $message[] = 'Incorrect username or password!';
   }

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login User</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style1.css" />
    <style>
        body {
            background-color: #f6f6f9;
        }

        .loginForm {
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

        .loginForm:hover {
            box-shadow: none;
        }

        .loginForm h3 {
            font-size: 16px;
            text-align: center;
            margin-top: 1rem
        }

        .loginForm input {
            width: 100%;
            margin-top: 1rem;
            height: 3rem;
            padding: 1rem;
            background: #f6f6f9;
            border: none;
            border-radius: 2rem;
        }

        .loginForm form .register {
            background: blue;
            opacity: 75%;
            cursor: pointer;
            width: 100%;
            color: #fff;
            height: 3rem;
            padding: 1rem;
            border: none;
            border-radius: 2rem;
            text-align: center;
        }

        .loginForm form #login {
            background: red;
            opacity: 75%;
            cursor: pointer;
            width: 100%;
            color: #fff;
            height: 3rem;
            padding: 1rem;
            border: none;
            border-radius: 2rem;
            text-align: center;
        }

        .loginForm form a {
            font-size: 16px;
            color: #fff;
            text-decoration: none;
        }

        .loginForm form p {
            text-align: center;
        }
    </style>
</head>

<body>
<?php $currentPage="userRegister.php"; include "user_header.php"; ?>
    <section class="loginForm">
        <form action="" method="POST">
            <h3>Login </h3>

            <input type="email" id="email" name="email" placeholder="Enter your email">
            <input type="password" id="password" name="password" placeholder="Enter your password">

            <input id="login" type="submit" value="Login" class="login" name="login">
            <p>Don't have an account?</p>

            <div class="register">
                <a href="userRegister.php">Register Now</a>
            </div>
        </form>
    </section>
    <script src="script1.js"></script>
</body>

</html>