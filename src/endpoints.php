<?php
    function is_admin($username) {
        include 'db.php';
        $query = "SELECT * FROM user WHERE username='$username'";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_array($result)['isAdmin'];
        } else {
            $data = 0;
        }
        // if ($result == NULL) {
        //     $data= false;
        // }
        // else {
        //     $data = mysqli_fetch_object($result)->isAdmin;
        // }
        
        return $data;
    }

    function callAPIGet($url) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($curl);
        if ($e = curl_error($curl)) {
            echo $e;
        }
        else {
            $decoded = json_decode($output);
            return $decoded;
        }
    }
    function callAPIPost($url, $args) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $args);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($curl);
        if ($e = curl_error($curl)) {
            echo $e;
        }
        else {
            $decoded = json_decode($output);
            return $decoded;
        }
    }
?>