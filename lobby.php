<?php require_once "service/session.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lobby</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/ownstyles.css">
</head>
<?php 
    if(!( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1)) { header("Location: login.php"); exit; };
    
    if($_SESSION['logged_in'] == 1) {
        if($_SESSION["admin"]==1) {
            require "nav/nav_admin.php";
            } else {
                require "nav/nav_user.php";
                    }
        };

    // pripojeni k DB
    $host = "localhost";
    $port = 3306;
    $socket = "";
    $user = "root";
    $password = "root";
    $dbname = "infotabdb";

    $con = mysqli_connect($host, $user, $password, $dbname, $port, $socket);
    if ($con) {
        // ok
        // return $con; // Remove this line, as you can't return from outside a function
    } else {
        echo 'Could not connect to the database server' . mysqli_connect_error();
        // return false; // Remove this line, as you can't return from outside a function
    }
    require "const/const.php";
        ?>
<body>
    <!-- aktivní prezentace snad někdy -->
    
    <!-- tabulka na základě sql databáze -->
    <?php
        if($_SESSION["admin"] == 1) {
            $sql = "SELECT * FROM infotabdb.prezentace";
            $result = mysqli_query($con, $sql);
        } else {
            $sql = "SELECT * FROM infotabdb.prezentace WHERE uzivatele_id = {$_SESSION["user_id"]};";
            $result = mysqli_query($con, $sql);
        };

        if(mysqli_num_rows($result) > 0) {
            echo '<table style="font-family: monospace;" class="table table-dark table-striped table-hover w-75 position-relative start-50 translate-middle-x">';
            echo '<thead class="table-dark">';
            echo '<td class="table-dark">Nadpis</td>';
            echo '<td class="table-dark">Obsah</td>';
            echo '<td class="table-dark">Vyditelnost</td>';
            echo '<td class="table-dark">Upravil</td>';
            echo '<td class="table-dark"></td>';
            echo '</thead>';
            //asi by to šlo jednoduššejc
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr class="table-dark">';
                echo '<td class="table-dark">'.$row["nadpis"].'</td>';
                echo '<td class="table-dark">'.$row["obsah"].'</td>';
                echo '<td class="table-dark">'.$row["vyditelnost"].'</td>';
                echo '<td class="table-dark">'.$row["modifiedby"].'</td>';
                echo '<td class="table-dark">';
                echo '<form action="storeAndRedirect.php" method="post">'; //ulozeni dat z tabulky v extrenim php
                // uložení id a scrollu pro editaci
                echo '<input type="hidden" name="id" value="'.htmlspecialchars($row["id"]).'">';
                echo '<input type="hidden" name="scrolltext" value="'.htmlspecialchars($row["scrolltext"]).'">';
                foreach ($row as $key => $value) {
                    // kvuli duplikaci
                    if ($key != 'id' && $key != 'scrolltext') {
                        echo '<input type="hidden" name="'.htmlspecialchars($key).'" value="'.htmlspecialchars($value).'">';
                    }
                }
                echo '<input type="submit" value="Select">';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'Žádné záznamy';
        };
    ?>
<script src="js/bootstrap.js"></script>
</body>
</html>