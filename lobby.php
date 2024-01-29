<!-- TODO - mazání prezentací -->

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
    } else {
        echo 'Could not connect to the database server' . mysqli_connect_error();
    }
    require "const/const.php";
        ?>
<body>
    <!-- aktivní prezentace snad někdy -->
    <?php 
        function active($con) {
            if($_SESSION["admin"] == 1) {
                $sql = "SELECT id, nadpis FROM infotabdb.prezentace";
                $result = mysqli_query($con, $sql);
                
                echo '<h2 class="text-center" style="font-family: monospace;">Aktivní prezentace</h2>';
                echo '<form method="POST" class= "mt-2 mx-auto w-75" style= "font-family: monospace;" action="updateactpresentation.php">';
                echo '<select class="form-select bg-dark text-white" name="selectedPresentation">';

                while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['id'].'">'.$row['nadpis'].'</option>';
                }
                echo '</select>';
                echo '<input type="submit" class="btn btn-primary bg-dark mt-1" value="Potvrdit">';
                echo '</form>';
            }
        }
        active($con);
    ?>
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
            echo '<table style="font-family: monospace;" class="table table-dark table-striped table-hover mx-auto mt-3 w-75">';
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
                echo '<input type="submit" class="btn btn-primary bg-dark" value="Upravit">';
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