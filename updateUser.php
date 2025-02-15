<?php
include "./connectServer.php";
session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
 }else{
    $user_id = '';
 };
 if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    // Update profile information
    $update_profile = $conn->prepare("UPDATE `newuser` SET username = ?, email = ? WHERE id = ?");
    $update_profile->execute([$name, $email, $user_id]);

    // Validate and update password
    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $prev_pass = $_POST['prev_pass'];
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    if ($old_pass == $empty_pass) {
        $message[] = 'Please enter the old password!';
    } elseif ($old_pass != $prev_pass) {
        $message[] = 'Old password does not match!';
    } elseif ($new_pass == $old_pass) {
        $message[] = 'New password must be different from the old password!';
    } elseif ($new_pass != $cpass) {
        $message[] = 'Confirm password does not match the new password!';
    } else {
        if ($new_pass != $empty_pass) {
            // Update the password
            $update_admin_pass = $conn->prepare("UPDATE `newuser` SET pass = ? WHERE id = ?");
            $update_admin_pass->execute([$cpass, $user_id]);
            $message[] = 'Password updated successfully!';
        } else {
            $message[] = 'Please enter a new password!';
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

    .updateForm {
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

    .updateForm h3 {
        font-size: 16px;
        text-align: center;
        margin-top: 1rem
    }

    .updateForm input {
        width: 100%;
        margin-top: 1rem;
        height: 3rem;
        padding: 1rem;
        background: #f6f6f9;
        border: none;
        border-radius: 2rem;
    }

    .updateForm form #register {
        background: blue;
        opacity: 75%;
        color: #fff;
        cursor: pointer;
    }

    .updateForm form .login {
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

    .updateForm form a {
        font-size: 16px;
        color: #fff;
        text-decoration: none;
    }

    .updateForm form p {
        text-align: center;
    }
    </style>
</head>

<body>

    <?php $currentPage="userRegister.php"; include "user_header.php";?>



    <section class="updateForm">
        <form action="" method="POST">
            <h3>Update Profile</h3>
            <input type="hidden" name="prev_pass" value="<?= $fetch_profile["pass"]; ?>">
            <input type="text" name="name" required placeholder="enter your username" maxlength="20"
                pattern="[a-zA-Z][a-zA-Z0-9]*"
                title="Invalid username. It should start with a letter and contain only letters and numbers"
                value="<?= $fetch_profile["username"]; ?>">
            <input type="email" name="email" required placeholder="enter your email" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["email"]; ?>" readonly>
            <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="cpass" placeholder="confirm your new password" maxlength="20"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input id="register" type="submit" value="Update" class="register" name="update">
        </form>

    </section>
    <script src="script1.js">

    </script>
    <script>
    function validateUsername() {
        var username = document.querySelector('input[name="name"]').value;
        var regex = /^[a-zA-Z][a-zA-Z0-9]*$/;
        if (!regex.test(username)) {
            alert('Invalid username. It should start with a letter and contain only letters and numbers.');
            return false;
        }
        return true;
    }

    document.querySelector('form').addEventListener('submit', function(event) {
        if (!validateUsername()) {
            event.preventDefault(); // Prevent form submission if username is invalid
        }
    });
    </script>
</body>

</html>