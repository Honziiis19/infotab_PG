<?php
require_once "session.php";
require_once "connect_db.php";

$con = connect_db();
    if (isset($_POST['id']) && $_SESSION['logged_in']) {
        $presentationId = $_POST['id'];
        $sql = "DELETE FROM infotabdb.snimky WHERE prezentace_id ='".$presentationId."' ;";
        if (!mysqli_query($con, $sql)) {
            echo "Error: " . mysqli_error($con);
        };
        $sql = "DELETE FROM infotabdb.prezentace WHERE id ='".$presentationId."' ;";
        if (!mysqli_query($con, $sql)) {
            echo "Error: " . mysqli_error($con);
        };
        echo '<script>alert("Presentation deleted successfully.");</script>';

    header("Location: ../lobby.php");
    exit();
    };
?>