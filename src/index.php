<?php 
    session_start();
    if(isset($_COOKIE['username'])) {
        $_SESSION['login_status'] = true;
    }
    else {
        if (isset($_SESSION['LAST']) && (time() - $_SESSION['LAST'] > 86400)) {
            $_SESSION['COUNT'] = 3;
            $_SESSION['LAST'] = time();
        }
        else {
            if (isset($_SESSION['COUNT'])) {
                // do nothing
            }
            else {
                $_SESSION['COUNT'] = 3;
                $_SESSION['LAST'] = time();
            }

        }


        
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/index.css">
        <!-- <link rel="stylesheet" href="'https://fonts.googleapis.com/css?family=Varela+Round:600|Montserrat|Open+Sans:600&display=swap'"> -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito Sans">
        <link rel="stylesheet" href="styles/search.css">
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
                <?php
                    include_once "utilities.php";
                    include "db.php";

                    $query = "SELECT * FROM (
                            SELECT song_id, Penyanyi, Judul, year(Tanggal_terbit) AS Tahun_terbit, Genre, Duration, Audio_path, Image_path, album_id FROM song ORDER BY song_id DESC LIMIT 10
                            )tb1 ORDER BY Judul ASC";
                    $song = mysqli_query($conn, $query);
                    if (mysqli_num_rows($song) > 0) {
                        while ($s = mysqli_fetch_array($song)) {
                            $src_song = "detail_lagu.php?song_id=" . $s["song_id"];
                            echo list_song($src_song, $s['Image_path'], $s['Judul'], $s['Penyanyi'], $s['Genre'], $s['Tahun_terbit']);
                        }
                    } else {
                        ?> <p>Song not found</p> <?php
                    }
                    
                ?>
            </div>
        </div>
    </body>
</html>