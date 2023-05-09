<?php
    session_start();
    if(isset($_COOKIE['username'])) {
        //do nothing
    }
    else {
        if ($_SESSION['COUNT'] == 0) {
            echo '<script>window.location="login.php"</script>';
        }
        else {
            $_SESSION['COUNT'] = $_SESSION['COUNT'] - 1;
        }
    }

    
    include 'db.php';
    include_once 'endpoints.php';
    
    $song_id = $_GET['song_id'];
    $query = "SELECT * FROM song LEFT JOIN album ON song.album_id = album.album_id WHERE song_id = " . $song_id;
    $song = mysqli_query($conn, $query);
    if (mysqli_num_rows($song) > 0) {
        $s = mysqli_fetch_row($song);
    }
?>

<?php
    if(isset($_POST['save'])) 
    {
        $Judul = $_POST['Judul'];
        $Tanggal_terbit = $_POST['Tanggal_terbit'];
        $Genre = $_POST['Genre'];
    
        $namasongfile = $_FILES['song_file']['name'];
        $namasongsementara = $_FILES['song_file']['tmp_name'];

        $namaimagefile = $_FILES['image_file']['name'];
        $namaimagesementara = $_FILES['image_file']['tmp_name'];

        $targetfile_img = "images/";
        $targetfile_song = "song/";

        $uploadimg = move_uploaded_file($namaimagesementara, $targetfile_img.$namaimagefile);
        $uploadsong = move_uploaded_file($namasongsementara, $targetfile_song.$namasongfile);

        $query = "UPDATE 
            song
            SET
            Judul = '".$Judul."',
            Tanggal_terbit = '".$Tanggal_terbit."',
            Genre = '".$Genre."',
            Audio_path = '".$targetfile_song.$namasongfile."',
            Image_path = '".$targetfile_img.$namaimagefile."' 
            WHERE
            song_id = " . $song_id . ";";

        // echo $query;    
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo '<script>alert("Data Berhasil Diedit")</script>';
        } 
        else {
            echo '<script>alert("Data Gagal Diedit")</script>';
        }
        // echo $targetfile_song.$namasongfile;
    }
    if(isset ($_POST['delete_lagu'])) {
        $query = "DELETE FROM song WHERE song_id = " . $song_id . ";";
        $query_run = mysqli_query($conn, $query);
        if($query_run) {
            echo '<script>alert("Data Berhasil Dihapus")</script>';
        } 
        else {
            echo '<script>alert("Data Gagal Dihapus")</script>';
        }
        echo '<script>window.location="index.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="'https://fonts.googleapis.com/css?family=Varela+Round:600|Montserrat|Open+Sans:600&display=swap'">
        <link rel="stylesheet" href="styles/detail_lagu.css">
        <!-- <link rel="stylesheet" href="styles/update_addsong.css"> -->
        <title>Binotify</title>
        <script src="scripts/audio.js"></script>
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
                <div class="container-song">
                    <div class="photo">
                        <img src="<?php echo $s[7]; ?>">
                    </div>
                    <div class="detail-container">
                        <div class="title">
                            <p class="music-name"><?php echo $s[2] ?></p>
                        </div>
                        <div class="detail-flex">
                            <p class="artist-name"><?php echo $s[1] ?></p>
                            <p>•</p>
                            <p class="genre"><?php echo $s[4] ?></p>
                            <p>•</p>
                            <p class="date"><?php echo $s[3] ?></p>
                            <p>•</p>
                            <a href="/detail_album.php?album_id=<?php echo $s[9] ?>"><p class="album"><?php echo $s[10] ?></p></a>
                        </div>
                    </div>
                    <div class="audio">
                        <audio
                        controls
                        src="<?php echo $s[6];?>"
                        ></audio>
                        <?php if (isset($_SESSION['is_admin'])) {
                            if ($_SESSION['is_admin'] == 1) {
                         { ?>
                        <form method="POST"  action="">
                            <button type="submit" name="delete_lagu" class="btn-delete">Delete</button>
                        </form>
                        <?php }}} ?>
                    </div>
                </div>
                <div class="section-edit">
                    <?php 
                        if (isset($_SESSION['is_admin'])) {
                            if ($_SESSION['is_admin'] == 1) {
                         { ?>
                        <h1>
                            <h3>Edit the data you would like to change!</h3>
                            <hr>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="container-edit">
                                    <div class="text-grid">
                                        <div class="text">
                                            <p>Title:    </p>
                                            <p>Date:     </p>
                                            <p>Genre:    </p>
                                        </div>
                                        <div class="input">
                                            <input type="text" name="Judul" placeholder= "Masukkan Judul" value= "<?php echo $s[2];?>" />
                                            <input type="date" name="Tanggal_terbit" value="<?php echo $s[3];?>" />
                                            <input type="text" name="Genre" placeholder= "Enter genre" value="<?php echo $s[15];?>"/>
                                        </div>
                                    </div>
                                    <div class="file">
                                        <div class="text">
                                            <p>Upload your song file: </>
                                            <p>Upload your image file: </p>
                                        </div>
                                        <div class="input">
                                            <input type="file" name="song_file" accept="audio/*"/>
                                            <input type="file" name="image_file" accept="image/*"/>
                                        </div>
                                    </div>
                                    <input type="hidden" name="song_id" value="<?php echo $s[0] ?>">
                                    <input type="submit" class="btn-submit" name="save" value="SAVE"/>
                                </div>
                            </form>
                        </h1>
                    <?php }}} ?>
                </div>
            </div>
        </div>
    </body>
</html>