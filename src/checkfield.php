<?php 
include 'db.php';
$q = $_REQUEST["q"];
$type = $_REQUEST["type"];

$is_unique = 0;
if ($q !== "") {
    if ($type == "email") {
        if (filter_var($q, FILTER_VALIDATE_EMAIL)) {
            $auth = mysqli_query($conn, "SELECT * FROM user WHERE email = '".$q."'");
            if (mysqli_num_rows($auth) == 0) {
                $is_unique = 1;
            }
        }
    }
    else {
        $auth = mysqli_query($conn, "SELECT * FROM user WHERE username = '".$q."'");
        if (mysqli_num_rows($auth) == 0) {
            $is_unique = 1;
        }
    }
}
echo $is_unique === 0 ? 0 : $is_unique;

?>