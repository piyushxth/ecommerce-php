<?php
session_start();

// Database connection code (include or require your database connection script)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "./connectServer.php";
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Query the database to check if the email exists
    $sql = "SELECT id, username, pass FROM adminInfo WHERE email = :email LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result !== false) {
        // Check if the provided password matches the stored plain text password
        if ($password === $result['pass']) {
            // Authentication successful, create a session
            $_SESSION["user_id"] = $result['id'];
            $_SESSION["username"] = $result['username'];
            $_SESSION["authenticated"] = true;
            // Redirect to the desired page (e.g., salesDash.php)
            header("Location: salesDash.php");
            exit;
        } else {
            // Authentication failed, show an error message or redirect back to the login page
            echo "Invalid email or password. Please try again.";
        }
    } else {
        // Email not found in the database
        echo "Email not found. Please register or try a different email.";
    }
    $conn = null; // Close the database connection
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
            top: 40%;
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

    <section class="loginForm">
        <form action="" method="POST">
            <h3>Admin Login </h3>

            <input type="email" id="email" name="email" placeholder="Enter your email">
            <input type="password" id="password" name="password" placeholder="Enter your password">

            <input id="login" type="submit" value="Login" class="login" name="login">

        </form>
    </section>

</body>

</html>