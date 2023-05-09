<?php
    include 'db.php';
    include_once 'utilities.php';
    session_start();
    $album_id = $_GET['album_id'];
    $query = "SELECT album_id, Penyanyi, Judul, year(Tanggal_terbit) AS Tahun_terbit, Genre, Total_duration, Image_path FROM album WHERE album_id = " . $album_id;
    $album = mysqli_query($conn, $query);
    if (mysqli_num_rows($album) > 0) {
        $s = mysqli_fetch_array($album);
    }
    if(isset ($_POST['delete_album'])) {
        $query = "DELETE FROM album WHERE album_id = " . $album_id . ";";
        $query_run = mysqli_query($conn, $query);
        if($query_run) {
            echo '<script>alert("Data Berhasil Dihapus")</script>';
        } 
        else {
            echo '<script>alert("Data Gagal Dihapus")</script>';
        }
        echo '<script>window.location="daftar_album.php"</script>';
    }

    if(isset($_POST['save-img'])) 
    {
        $namaimagefile = $_FILES['image_file']['name'];
        $namaimagesementara = $_FILES['image_file']['tmp_name'];

        $targetfile_img = "images/";
     
        $uploadimg = move_uploaded_file($namaimagesementara, $targetfile_img.$namaimagefile);
   
        $query = "UPDATE 
            album
            SET
            Image_path = '".$targetfile_img.$namaimagefile."' 
            WHERE
            album_id = ". $album_id;
   
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo '<script>alert("Data Berhasil Diedit")</script>';
        } 
        else {
            echo '<script>alert("Data Gagal Diedit")</script>';
        }
        echo $targetfile_song.$namasongfile;

    }

    if(isset($_POST['save-changes'])) 
    {
        $Judul = $_POST['Judul'];
        $Genre = $_POST['Genre'];
        $Penyanyi = $_POST['Penyanyi'];
     
        $query = "UPDATE 
            album
            SET
            Judul = '".$Judul."',
            Genre = '".$Genre."',
            Penyanyi = '".$Penyanyi."'
            WHERE
            album_id = ". $album_id;

        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo '<script>alert("Data Berhasil Diedit")</script>';
        } 
        else {
            echo '<script>alert("Data Gagal Diedit")</script>';
        }

    }

    if(isset($_POST['add-song'])) 
    {
        $Judul = $_POST['Judul-Song'];
     
        $query = "UPDATE 
            song
            SET
            album_id = '".$album_id."'
            WHERE
            Judul = '".$Judul."'";

        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            $msg = "Successfully added $Judul to album.";
        } 
        else {
            $msg = "Song not found.";
        }

    }

    if(isset($_POST['delete-song'])) 
    {
        $Judul = $_POST['Judul-Song'];
     
        $query = "UPDATE 
            song
            SET
            album_id = NULL
            WHERE
            Judul = '".$Judul."'";

        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            $msg = "Successfully deleted $Judul from album.";
        } 
        else {
            $msg = "Song not found.";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="'https://fonts.googleapis.com/css?family=Varela+Round|Montserrat|Open+Sans:600&display=swap'">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito Sans">
        <link rel="stylesheet" href="styles/detail_album.css">
        <link rel="stylesheet" href="styles/search.css">
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
                <div class="container-album">

                    <div class="photo">
                        <img src="<?php echo $s['Image_path']; ?>">
                    </div>
                    <div class="detail">
                        <p class="album-name"><?php echo $s['Judul'] ?></p>
                        <div class="detail-flex">
                            <p class="artist-name"><?php echo $s['Penyanyi'] ?></p>
                            <p>&#8226;</p>
                            <p class="genre"><?php echo $s['Genre'] ?></p>
                            <p>&#8226;</p>
                            <p class="date"><?php echo $s['Tahun_terbit'] ?></p>
                            <p>&#8226;</p>
                            <p class="duration"><?php echo $s['Total_duration'] ?>s</p>
                            <?php if($_SESSION['is_admin'] == 1) { ?>
                            <form method="POST"  action="">
                                <button type="submit" name="delete_album" class="btn-delete">Delete</button>
                            </form>                            
                            <?php } ?>
                        </div>
                    </div>

                    <div class="song-list">
                        <h3>SONGS</h3>
                        <hr>
                        <?php
                            $q = "SELECT song_id, Penyanyi, Judul, year(Tanggal_terbit) AS Tahun_terbit, Genre, Duration, Audio_path, Image_path, album_id FROM song WHERE album_id=" . $album_id;
                            $songs = mysqli_query($conn, $q);
                            if (mysqli_num_rows($songs) > 0) {
                                while ($song = mysqli_fetch_array($songs)) {
                                    $src_song = "detail_lagu.php?song_id=" . $song['song_id'];
                                    echo list_song($src_song, $song['Image_path'], $song['Judul'], $song['Penyanyi'], $song['Genre'], $song['Tahun_terbit']);
                                }
                            } else {
                                ?> <p>Song not found</p> <?php
                            }
                        ?>
                        <hr>
                        <?php
                            if(isset($_COOKIE['username'])) {
                                if ($_SESSION['login_status'] == true) {
                                    if (is_admin($_COOKIE['username']) == 1) { ?>
                                        <h3>Edit</h3>
                                        <hr>
                                        <form method="POST" enctype="multipart/form-data">
                                            <input type="text" class="input-text" name="Judul" placeholder= "Title" value="<?php echo $s['Judul'] ?>" /><br/>
                                            <input type="text" class="input-text" name="Genre" placeholder= "Genre" value="<?php echo $s['Genre'] ?>" /><br/>
                                            <input type="text" class="input-text" name="Penyanyi" placeholder= "Singer" value="<?php echo $s['Penyanyi'] ?>" /><br/>
                                            <input type="submit" class="btn-submit" name="save-changes" value="Save Changes"/>
                                            <p>Upload your image file: </p>
                                            <input type="file" class="file" name="image_file" accept="image/*"/><br/>
                                            <input type="submit" class="btn-submit" name="save-img" value="Change Image"/>
                                            <hr>
                                            <h3 style="margin:15px 0 15px 0;">Edit Song List</h3>
                                            <hr>
                                            <input type="text" class="input-text" name="Judul-Song" placeholder="Song Title To Add/Delete">
                                            <input type="submit" class="btn-submit" name="add-song" value="Add Song"/>
                                            <input type="submit" class="btn-submit" name="delete-song" value="Delete Song"/>
                                        </form>


                                <?php }
                                }
                            } 
                            if (isset($msg)) {
                                echo $msg;
                            }?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>