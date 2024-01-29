<?php
session_start();
$_SESSION["edit"] = true;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
    }
    header('Location: pres.php');
    exit;
}
?>