<?php
    include 'db.php';
    session_start();
    if(isset($_POST['save'])) 
    {
        $Judul = $_POST['Judul'];
        $Penyanyi = $_POST['Penyanyi'];
        $Tanggal_terbit = $_POST['Tanggal_terbit'];
        $Genre = $_POST['Genre'];
  
        $namaimagefile = $_FILES['image_file']['name'];
        $namaimagesementara = $_FILES['image_file']['tmp_name'];

        $targetfile_img = "images/";


        $uploadimg = move_uploaded_file($namaimagesementara, $targetfile_img.$namaimagefile);
    
        if ($uploadimg) {
            echo "Upload berhasil!<br/>";
            echo "Link: <a href='".$targetfile_img.$namaimagefile."'>".$namaimagefile."</a>";
        // } else {
        //     echo "Upload Image Gagal!";
        // }
        // if ($uploadsong) {
        //     echo "Upload berhasil!<br/>";
        //     echo "Link: <a href='".$targetfile_song.$namasongfile."'>".$namasongfile."</a>";
        // // } else {
        // //     echo "Upload Song Gagal!";
        // // }
        
        $query = "INSERT INTO 
            album ( Judul, Penyanyi, Image_path, Tanggal_terbit, Genre, Total_duration) 
            VALUES 
            ('".$Judul."','".$Penyanyi."','".$targetfile_img.$namaimagefile."', '".$Tanggal_terbit."', '".$Genre."',0);";
        echo $query;    
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo '<script>alert("Data Berhasil Ditambahkan")</script>';
        } 
        else {
            echo '<script>alert("Data Gagal Ditambahkan")</script>';
        }


    }
}

?>

<!DOCTYPE html>
<html>
    <head>
    <title>Add Album </title>            
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/update_addsong.css">
        <link rel="stylesheet" href="styles/side.css">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito Sans">
       
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
                <h2>Insert your album data and files!</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="text" name="Judul" placeholder= "Title" /><br/>
                    <input type="text" name="Penyanyi" placeholder= "Singer"/><br/>
                    <input type="date" name="Tanggal_terbit" placeholder= "Enter release date with format YYYY-MM-DD"/><br/>
                    <input type="text" name="Genre" placeholder= "Genre"/><br/>

                    <p>Upload your image file: </p>
                    <input type="file" class="file" name="image_file" accept="image/*"/><br/>

                    <input type="submit" class="submit" name="save" value="Submit"/>
                </form>
        </div>
        </div> 
    </body>
</html>