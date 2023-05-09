<?php
    include 'db.php';
    session_start();
    include 'side.php';
    if(isset($_POST['save'])) 
    {
        $Judul = $_POST['Judul'];
     
        $namaimagefile = $_FILES['image_file']['name'];
        $namaimagesementara = $_FILES['image_file']['tmp_name'];

        $targetfile_img = "images/";
     
        $uploadimg = move_uploaded_file($namaimagesementara, $targetfile_img.$namaimagefile);
   
        $query = "UPDATE 
            album
            SET
            Judul = '".$Judul."',
            Image_path = '".$targetfile_img.$namaimagefile."' 
            WHERE
            album_id = 6;";

        echo $query;    
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo '<script>alert("Data Berhasil Diedit")</script>';
        } 
        else {
            echo '<script>alert("Data Gagal Diedit")</script>';
        }
        echo $targetfile_song.$namasongfile;

    }

?>

<!DOCTYPE html>
<html>
    <head>
    <title>Edit Album</title>            
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
                    <input type="text" name="Judul" placeholder= "Masukkan Judul" value='GET dari sebelumnya' /><br/>
                    <p>Upload your image file: </p>
                    <input type="file" class="file" name="image_file" accept="image/*"/><br/>

                    <input type="submit" class="submit" name="save" value="Submit"/>
                </form>
            </h1>
        </center>
    </body>
</html>