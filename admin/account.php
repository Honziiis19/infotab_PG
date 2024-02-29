<?php require_once "service/session.php"; require_once "service/connect_db.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Změna hesla</title>
    <link rel="stylesheet" href="css/bootstrap.css">
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
    $con = connect_db();
    require "const/const.php";
    $sql = "SELECT * FROM infotabdb.uzivatele WHERE id = {$_SESSION['user_id']};";
    $result = mysqli_query($con, $sql);

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "submited") {
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        if($row = mysqli_fetch_assoc($result)) { 
            if ($_POST["aktheslo"] == $row["heslo"] && $_POST["newheslo1"] == $_POST["newheslo2"]) { //porovnani hesel
            $sql = "UPDATE infotabdb.uzivatele SET heslo = '".$_POST["newheslo1"]."' WHERE id = ".$_SESSION["user_id"].";";
            if (mysqli_query($con, $sql)) {
                echo "Data inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
            // header("location: login.php"); //aby se neuložilo dvakrat
            session_unset();
            session_destroy();
            header('Location: login.php');
            exit();
            };
        }
    }
?>
<body>
    <h1 style= "font-family: monospace; margin-top: 1em;" class="text-center">Možnost změny hesla</h1>
    <div class="container d-flex justify-content-center">
        <form method="POST" style="font-family: monospace; font-weight: bold;">
            <input type="hidden" name="action" value="submited"/>
            <div class="mb-3">
                <label for="aktheslo" class="form-label">Aktuální heslo:</label>
                <input autocomplete="off" name="aktheslo" type="password" class="form-control bg-dark text-white" id="aktheslo"required>
            </div>
            <div class="mb-3">
                <label for="newheslo1" class="form-label">Nové heslo:</label>
                <input autocomplete="off" name="newheslo1" type="password" class="form-control bg-dark text-white" id="newheslo1" required>
            </div>
            <div class="mb-3">
                <label for="newheslo2" class="form-label">Potvrzení nového hesla:</label>
                <input autocomplete="off" name="newheslo2" type="password" class="form-control bg-dark text-white" id="newheslo2" required>
            </div>
    <button autocomplete="off" type="submit" class="btn btn-primary bg-dark">Změnit heslo</button>
</form>
</div>
    <script src="js/bootstrap.js"></script>
</body>
</html>