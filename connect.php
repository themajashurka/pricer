<?php
    $server = "localhost";
    $db = "db1";
    $user = "themajashurka";
    $pass = "husos";

    $connection = mysqli_connect($server,$user,$pass,$db);

    if (!$connection) {
        die(mysqli_connect_error());
    }