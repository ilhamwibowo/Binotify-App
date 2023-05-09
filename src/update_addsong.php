<?php
    include 'db.php';
    session_start();
    if(isset($_POST['save'])) 
    {
        $Judul = $_POST['Judul'];
        $Penyanyi = $_POST['Penyanyi'];
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
        
        // Calculate duration song
        $ffmpeg = "./ffmpeg/bin/ffprobe";
        $cmd = $ffmpeg . '-i ' . $targetfile_song . ' -show_entries format=duration -v quiet -of csv="p=0"; echo $?';
        $duration = shell_exec($cmd);
        
        $query = "INSERT INTO 
            song ( Penyanyi, Judul, Tanggal_terbit, Genre, Duration, Audio_path, Image_path) 
            VALUES 
            ('".$Penyanyi."', '".$Judul."', '".$Tanggal_terbit."', '".$Genre."', " . $duration . ", '".$targetfile_song.$namasongfile."', '".$targetfile_img.$namaimagefile."');";
        $query_run = mysqli_query($conn, $query);
        
        if ($uploadimg) {
            echo "Upload berhasil!<br/>";
            echo "Link: <a href='".$targetfile_img.$namaimagefile."'>".$namaimagefile."</a>";
        } else {
            echo "Upload Image Gagal!";
        }
        if ($uploadsong) {
            echo "Upload berhasil!<br/>";
            echo "Link: <a href='".$targetfile_song.$namasongfile."'>".$namasongfile."</a>";
        } else {
            echo "Upload Song Gagal!";
        }
        print_r($_FILES);
        if($query_run) {
            echo '<script>alert("Data Berhasil Ditambahkan")</script>';
            
        } 
        else {
            echo '<script>alert("Data Gagal Ditambahkan")</script>';
        }
        // echo $targetfile_song.$namasongfile;

    }
    
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="styles/update_addsong.css">
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round:600|Montserrat|Open+Sans:600&display=swap"> -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito Sans">
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
                <h2>Insert your song data and files!</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="text" name="Judul" placeholder= "Title" /><br/>
                    <input type="text" name="Penyanyi" placeholder= "Singer"/><br/>
                    <input type="date" name="Tanggal_terbit" placeholder= "Tanggal: YYYY-MM-DD"/><br/>
                    <input type="text" name="Genre" placeholder= "Genre"/><br/>

                    <p>Upload your song file: </p>
                    <input type="file" class="file" name="song_file" accept="audio/*"/><br/>

                    <p>Upload your image file: </p>
                    <input type="file" class="file" name="image_file" accept="image/*"/><br/>

                    <input type="submit" class="submit" name="save" value="Submit"/>
                </form>
            </div>
        </div>
    </body>
</html>
