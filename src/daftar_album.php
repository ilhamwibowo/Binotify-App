<?php
    include_once "utilities.php";
    include "db.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="'https://fonts.googleapis.com/css?family=Varela+Round:600|Montserrat|Open+Sans:600&display=swap'">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito Sans">
        <link rel="stylesheet" href="styles/search.css">
        <title>Spotify</title>
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
                <h3>ALBUMS</h3>
                <hr>
                <?php
                    $query = "SELECT album_id, Penyanyi, Judul, year(Tanggal_terbit) AS Tahun_terbit, Genre, Total_duration, Image_path FROM album";
                    $album = mysqli_query($conn, $query);
                    if (mysqli_num_rows($album) > 0) {
                        while ($s = mysqli_fetch_array($album)) {
                            $src_song = "detail_album.php?album_id=" . $s["album_id"];
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