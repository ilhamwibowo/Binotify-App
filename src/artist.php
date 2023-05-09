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
        <link rel="stylesheet" href="styles/artist.css"<?php echo time(); ?>>
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
                <div class="container-artist">
                    <?php
                        # Request Subscribe
                        
                        
                        $user_id = $_SESSION['user_id'];
                        $get_subs = callAPIPost('http://localhost:8000/subscribe/' . $user_id, "");
                        $get_user = callAPIGet('http://localhost:8000/user');

                        if(isset($_POST['subscribe'])) {
                            $args = "creator_id={$_POST['subscribe']}&subscriber_id={$user_id}";
                            callAPIPost('http:/localhost:8000/subscribe/add', $args);
                        }
                        // echo $user_id;
                        // print_r($get_subs);
                        $subs = array();
                        if ($get_subs) {
                            foreach($get_subs as $i => $i_value) {
                                foreach($i_value as $j) {
                                    array_push($subs, $j->creator_id);
                                }
                            }
                        }
                        foreach($get_user as $i => $i_value) {
                            // echo ($i_value->user_id);
                            if ($i_value->isAdmin == 1) {
                                continue;
                            }
                            if (in_array($i_value->user_id, $subs)) {
                                echo list_artist_subscribed($i_value->name, $i_value->user_id);
                            } else {
                                echo list_artist($i_value->name, $i_value->user_id);
                            }
                        }
                    ?>
                </div>  
            </div>
        </div>
    </body>
</html>