<?php
    include_once 'utilities.php';
    include_once 'endpoints.php';
    include 'db.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="'https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:600&display=swap'">
        <link rel="stylesheet" href="styles/index.css"<?php echo time(); ?>>
        <link rel="stylesheet" href="styles/premium_song.css"<?php echo time(); ?>>
        <script src="scripts/premium_song.js"></script>
        <title>Binotify</title>
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <?php include 'side.php'; ?>
            </div>
            <div class="navbar">
                <?php include 'navbar.php'; ?>
            </div>
            <div class="main">
                <div class="container-song-premium">
                    <?php
                        $id = $_GET["id"];

                        $get_data = callAPIGET("http://localhost:8000/song/{$id}");
                        foreach ($get_data as $i => $i_value) {
                            echo list_premium_song($i_value->song_id ,$i_value->audio_path, $i_value->judul, $i_value->name);
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>