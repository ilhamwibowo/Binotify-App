<?php
    include_once "endpoints.php";

?>
<link rel="stylesheet" href="styles/side.css">
<side>
    <header>Binotify</header>
    <a href="/">
        <!-- <i class="fas fa-stream"></i> -->
        <span>Home</span>
    </a>
    <a href="/daftar_album.php"><span>Album</span></a>
    <?php
        if(isset($_COOKIE['username'])) {
            if ($_SESSION['login_status'] == true) {
                echo '<a href="/artist.php"><span>Artist</span></a>';
                if (is_admin($_COOKIE['username']) == 1) {
                    echo '<a href="/update_tambahalbum.php"><span>Add Album</span></a>';
                    echo '<a href="/update_addsong.php"><span>Add Music</span></a>';
                    echo '<a href="/users.php"><span>Users</span></a>';
                    
                }
                echo '<a href="/logout.php"><span>Log Out</span></a>';
            }

        }
            
    ?>
    
</side>