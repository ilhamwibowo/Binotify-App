<?php
    include 'db.php';
    session_start();
    include 'side.php';
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

        // if ($uploadimg) {
        //     echo "Upload Image berhasil!<br/>";
        //     echo "Link: <a href='".$targetfile_img.$namaimagefile."'>".$namaimagefile."</a>";
        // } else {
        //     echo "Upload Image Gagal!";
        // }
        // if ($uploadsong) {
        //     echo "Upload song berhasil!<br/>";
        //     echo "Link: <a href='".$targetfile_song.$namasongfile."'>".$namasongfile."</a>";
        // } else {
        //     echo "Upload Song Gagal!";
        // }
        $query = "UPDATE 
            song
            SET
            Judul = '".$Judul."',
            Tanggal_terbit = '".$Tanggal_terbit."',
            Genre = '".$Genre."',
            Audio_path = '".$targetfile_song.$namasongfile."',
            Image_path = '".$targetfile_img.$namaimagefile."' 
            WHERE
            song_id = 5;";

        echo $query;    
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo '<script>alert("Data Berhasil Diedit")</script>';
        } 
        else {
            echo '<script>alert("Data Gagal Diedit")</script>';
        }
        // echo $targetfile_song.$namasongfile;
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Binotify : Edit Song</title>            
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/update_addsong.css">
        <link rel="stylesheet" href="styles/side.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito Sans">
    </head>
    <body> 
        <center> 
            <h1>
                <h2>Edit the data you would like to change!</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="text" name="Judul" placeholder= "Masukkan Judul" value="" /><br/>
                    <input type="date" name="Tanggal_terbit" placeholder= "Enter release date with format YYYY-MM-DD"/><br/>
                    <input type="text" name="Genre" placeholder= "Enter genre"/><br/>

                    <p>Upload your song file: </p><input type="file" name="song_file" accept="audio/*"/><br/>

                    <p>Upload your image file: </p><input type="file" name="image_file" accept="image/*"/><br/>

                    <input type="submit" class="submit" name="save" value="SAVE"/>
                </form>
            </h1>
        </center>
    </body>
</html>