<?php
    include 'db.php';
    include_once 'endpoints.php';
    session_start();
    if(isset($_COOKIE['username'])) {

        $_SESSION['login_status'] = true;
        echo '<script>window.location="index.php"</script>';
    }

    if(isset($_POST['submit'])) {
        $user = $_POST['user'];
        $pass = $_POST['password'];


        $auth = mysqli_query($conn, "SELECT * FROM user WHERE username = '".$user."' AND password = '".MD5($pass)."'");
        if (mysqli_num_rows($auth) > 0) {
            $data = mysqli_fetch_object($auth);
            $cookie_name = 'username';
            $cookie_value = $user;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
            $_SESSION['login_status'] = true;
            $_SESSION['is_admin'] = is_admin($user);
            $_SESSION['user_id'] = $data->user_id;
            // if ($data->isAdmin == 1) {
            //     $_SESSION['is_admin'] = true;
            //     echo '<script>window.location="index.php"</script>';
            // }
            // else {
            //     $_SESSION['is_admin'] = false;
            // }
            // header("Location:index.php");
            echo '<script>window.location="index.php"</script>';
        }
        else {
            $err =  '<p style="margin-bottom:20px;">Wrong username or password!</p>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/login.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito Sans">
        <title>Binotify</title>
    </head>
    <body>
        <h1>Binotify</h2>
        <hr>
        <div class="container-login">
       
            <form action="" method="POST"> 
                <p class="input-name">Username</p>
                <input type="text" name="user" class="input-field" placeholder="Username">
                <p class="input-name">Password</p>
                <input type="password" name="password" class="input-field" placeholder="Password">
                <input type="submit" name="submit" class="btn btn-login" value="LOG IN">

            </form>
            <?php 
                if(isset($err)) {
                    echo $err;
                }
            ?>
            <hr>
            <p class="sign-up-text"> Don't have an account?</p>
            <form action="./register.php">
                <input type="submit" name="submit" class="btn btn-sign" value="SIGN UP FOR SPOTIFY CLONE">
            </form>
        </div>
    </body>
</html>