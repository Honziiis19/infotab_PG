<?php
require_once "service/session.php";
// pripojeni k DB
    $host = "localhost";
    $port = 3306;
    $socket = "";
    $user = "root";
    $password = "root";
    $dbname = "infotabdb";

    $con = mysqli_connect($host, $user, $password, $dbname, $port, $socket);
    if ($con) {
    } else {
        echo 'Could not connect to the database server' . mysqli_connect_error();
    };
    $sql = "SELECT htmltext"
?>