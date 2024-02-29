<?php
require_once "session.php";
require_once "connect_db.php";

$con = connect_db();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["admin"] == 1) {
    $selectedPresentationId = $_POST['selectedPresentation'];

    $resetSql = "UPDATE infotabdb.prezentace SET aktivni = '0'";
    mysqli_query($con, $resetSql);

    if (!$selectedPresentationId == 0) {
    $updateSql = "UPDATE infotabdb.prezentace SET aktivni = '1' WHERE id = $selectedPresentationId";
    mysqli_query($con, $updateSql);
    };
    echo "<script>
            alert('Úspěšná změna aktivní prezentace');
            window.location.href='../lobby.php';
          </script>";
    exit;
    }
?>