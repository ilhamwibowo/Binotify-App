<?php
    include_once 'db.php';
    if(isset($_POST['submit'])) {

        if (!empty($_POST['name']) and !empty($_POST['user']) and  !empty($_POST['password']) and !empty($_POST['confirm-password']) and !empty($_POST['email'])) {
            #set variables
            $user = $_POST['user'];
            $pass = $_POST['password'];
            $email = $_POST['email'];
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check = mysqli_query($conn, "SELECT * FROM user WHERE email = '".$email."'");
                if (mysqli_num_rows($check) == 0) {
                    $check = mysqli_query($conn, "SELECT * FROM user WHERE username = '".$user."'");
                    if (mysqli_num_rows($check) == 0) {
                        if ($pass == $_POST['confirm-password']) {
                            #safe
                            $sql = "INSERT INTO user (email, password, username) VALUES ('".$email."', '".MD5($pass)."', '".$user."')";
                            $conn->query($sql);
                            session_start();
                            $cookie_name = 'username';
                            $cookie_value = $user;
                            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/');
                            $_SESSION['login_status'] = true;
                            echo '<script>window.location="index.php"</script>';
                        }
                        else {
                            $err =  '<p style="margin-bottom:20px;">Confirm password is not valid!</p>';
                        }
                    }
                    else {
                        $err =  '<p style="margin-bottom:20px;">Username already exist!</p>';
                    }
                }
                else {
                    $err =  '<p style="margin-bottom:20px;">Email already exist!</p>';
                }                
            }
            else {
                $err =  '<p style="margin-bottom:20px;">Invalid Email!</p>';
            }
        }
        else {
            $err =  '<p style="margin-bottom:20px;">Field cannot be empty!</p>';
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/register.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito Sans">
        <title>Binotify</title>
    </head>
    <body>
        <h1>Binotify</h2>
        <hr>
        <div class="container-login">
       
            <form action="" method="POST"> 
                <p class="input-name">Name</p>
                <input type="text" name="name" class="input-field" placeholder="Name">
                <p class="input-name">Username</p>
                <input type="text" name="user" id="username" class="input-field" placeholder="Username" onkeyup="check_username(this.value)">
                <p class="error-msg"><span id="username-unique"></span> </p>
                <p class="input-name">Email</p>
                <input type="text" name="email" id="email" class="input-field" placeholder="Email" onkeyup="check_email(this.value)">
                <p class="error-msg"><span id="email-unique"></span> </p>
                <p class="input-name">Password</p>
                <input type="password" name="password" class="input-field" placeholder="Password">
                <p class="input-name">Confirm Password</p>
                <input type="password" name="confirm-password" class="input-field" placeholder="Confirm Password">
                <input type="submit" name="submit" class="btn btn-login" value="SIGN UP">


            </form>
            <?php 
                if(isset($err)) {
                    echo $err;
                }
            ?>
            <script type="text/JavaScript">
                function check_username(str) {
                    if (str.length == 0) {
                        return;
                    } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText == 1) {
                                var field = document.getElementById("username")
                                field.style.borderColor = "#1ED760";
                                var text = document.getElementById("username-unique");
                                text.innerHTML = "";
                                field.classList.remove("input-false");
                                field.classList.add("input-true");
                            }
                            else {
                                var field = document.getElementById("username")
                                field.style.borderColor = "red";
                                var text = document.getElementById("username-unique");
                                text.innerHTML = "Username already exist!";
                                field.classList.remove("input-true");
                                field.classList.add("input-false");                                
                            }
                            
                        }
                    }
                    xmlhttp.open("GET", "checkfield.php?q="+str+"&type=username", true);
                    xmlhttp.send();
                    }
                }


                function check_email(str) {
                    if (str.length == 0) {
                        return;
                    } else {
                        var xmlhttp2 = new XMLHttpRequest();
                        xmlhttp2.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                if (this.responseText == 1) {
                                    var field = document.getElementById("email")
                                    var text = document.getElementById("email-unique");
                                    text.innerHTML = "";
                                    field.style.borderColor = "#1ED760";
                                    field.classList.remove("input-false");
                                    field.classList.add("input-true");
                                }
                                else {
                                    var field = document.getElementById("email")
                                    var text = document.getElementById("email-unique");
                                    text.innerHTML = "Invalid email or email is already registered!";
                                    field.style.borderColor = "red";
                                    field.classList.remove("input-true");
                                    field.classList.add("input-false");                                
                                }
                                
                            }
                        }
                    xmlhttp2.open("GET", "checkfield.php?q="+str+"&type=email", true);
                    xmlhttp2.send();
                    }
                }
            </script>
        </div>
    </body>
</html>