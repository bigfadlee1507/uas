<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "item";
    $konek = mysqli_connect($host,$user,$pass,$db);

    if($konek){
        //
    } else {
        echo "<h3>ERROR DB</h3>";
        exit;
    }
?>