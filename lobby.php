<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/ownstyles.css">
</head>
<?php if(isset($_SESSION["loggedin"] && $_SESSION["loggedin"] === true) {if($_SESSION["user"]=="admin") {require "nav/nav_admin.php"; } else {require "nav/nav_user.php";}}); ?>
<body>
    <!-- aktivní prezentace -->

    <!-- přehled všech prezentací -->
<table style="font-family: monospace;" class="table table-dark table-striped table-hover w-75 position-relative start-50 translate-middle-x">
    <thead class="table-dark">
        <td class="table-dark">Nadpis</td>
        <td class="table-dark">Obsah</td>
        <td class="table-dark">Vyditelnost</td>
        <td class="table-dark">Upravil</td>
    </thead>
    <tr class="table-dark">
        <td class="table-dark">Nadpis</td>
        <td class="table-dark">Obsah</td>
        <td class="table-dark">Vyditelnost</td>
        <td class="table-dark"  >Upravil</td>
    </tr>
    <tr class="table-dark">
        <td class="table-dark">Nadpis</td>
        <td class="table-dark">Obsah</td>
        <td class="table-dark">Vyditelnost</td>
        <td class="table-dark"  >Upravil</td>
    </tr>
    <tr class="table-dark">
        <td class="table-dark">Nadpis</td>
        <td class="table-dark">Obsah</td>
        <td class="table-dark">Vyditelnost</td>
        <td class="table-dark"  >Upravil</td>
    </tr>
    <tr class="table-dark">
        <td class="table-dark">Nadpis</td>
        <td class="table-dark">Obsah</td>
        <td class="table-dark">Vyditelnost</td>
        <td class="table-dark"  >Upravil</td>
    </tr>
</table>

<script src="js/bootstrap.js"></script>
</body>
</html>