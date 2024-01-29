<?php
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body style="background-color: grey;">
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <ul class="navbar nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="lobby.php" style="font-family: monospace; color: white; font-size: large;">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pres.php?new=1" style="font-family: monospace; color: white; font-size: large;">Nová prezentace</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users.php" style="font-family: monospace; color: white; font-size: large;">Uživatelé</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="account.php" style="font-family: monospace; color: white; font-size: large;">Účet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="showmode.php" style="font-family: monospace; color: white; font-size: large;">Showmode</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?logout" style="font-family: monospace;">Odhlásit se</a>
          </li>
</ul>
    </div>
  </nav>
<script src="../js/bootstrap.js"></script>
</body>
</html>