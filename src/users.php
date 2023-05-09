<?php 
    if(isset($_COOKIE['username'])) {
        session_start();
        $_SESSION['login_status'] = true;

    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="'https://fonts.googleapis.com/css?family=Varela+Round:600|Montserrat|Open+Sans:600&display=swap'">
        <link rel="stylesheet" href="styles/users.css">
        <title>Binotify</title>
    </head>
    <body>       
        <div class="container">
            <div class="sidebar">
                <?php include 'side.php'; ?>
            </div>
            <div class="navbar">
                <?php include 'navbar.php'?>
            </div>
            <div class="main">
                <h3>Users</h3>
                <hr>
                <?php
                    include_once "utilities.php";
                    include "db.php";

                    $query = "SELECT * FROM user WHERE isAdmin = 0";
                    $users = mysqli_query($conn, $query);
                    if (mysqli_num_rows($users) > 0) {
                        while ($u = mysqli_fetch_array($users)) {
                            echo list_user($u['user_id'], $u['username'], $u['email']);
                        }
                    } else {
                        ?> <p>Usersis empty</p> <?php
                    }
                    
                ?>
            </div>
        </div>
    </body>
</html>