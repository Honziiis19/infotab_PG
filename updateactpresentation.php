<?php
require_once "service/session.php";

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
}
require "const/const.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedPresentationId = $_POST['selectedPresentation'];

    $resetSql = "UPDATE infotabdb.prezentace SET aktivni = '0'";
    mysqli_query($con, $resetSql);

    $updateSql = "UPDATE infotabdb.prezentace SET aktivni = '1' WHERE id = $selectedPresentationId";
    mysqli_query($con, $updateSql);

    // mohlo by reloadnout lobby, *reloaduje lobby nastesti
    header("Location: lobby.php");
    exit;
}
?>