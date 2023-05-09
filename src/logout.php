<?php 
    session_start();
    session_destroy();
    setcookie("username", "", time() - (86400 * 30));
    echo '<script>window.location="login.php"</script>';
 
?>