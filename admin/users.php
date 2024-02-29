<?php require_once "service/session.php"; require_once "service/connect_db.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uživatelé</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<?php
    if(!( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1 && $_SESSION["admin"] == 1)) { header("Location: login.php"); exit; };
    
    if($_SESSION['logged_in'] == 1) {
        if($_SESSION["admin"]==1) {
            require "nav/nav_admin.php";
            } else {
                require "nav/nav_user.php";
                    }
        };
    echo '<h2 class="text-center" style="font-family: monospace; margin-top: 1em;">Uživatelé</h2>';
    // pripojeni k DB
    $con = connect_db();
    require "const/const.php";

    $sql = "SELECT * FROM infotabdb.uzivatele";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        echo '<table style="font-family: monospace;" class="table table-dark table-striped table-hover w-75 position-relative start-50 translate-middle-x">';
        echo '<thead class="table-dark">';
        echo '<td class="table-dark">Jmeno</td>';
        echo '<td class="table-dark">E-mail</td>';
        echo '<td class="table-dark">Admin</td>';
        echo '</thead>';

        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr class="table-dark">';
            echo '<td class="table-dark">'.$row["jmeno"].'</td>';
            echo '<td class="table-dark">'.$row["email"].'</td>';
            echo '<td class="table-dark">'.$row["admin"].'</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'Žádné záznamy';
    };

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
    $jmeno = mysqli_real_escape_string($con, $_POST["jmeno"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $heslo = mysqli_real_escape_string($con, $_POST["heslo"]);
    $admin = isset($_POST["admin"]) ? 1 : 0;
    
    $sql = "INSERT INTO infotabdb.uzivatele (jmeno, email, heslo, admin) VALUES ('$jmeno', '$email', '$heslo', '$admin');";
    if (mysqli_query($con, $sql)) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    header("location: users.php");
    }
?>
<body>
<div id="newUserForm" style="display: none;">
 <div class="container d-flex justify-content-center">
    <form method="POST" style="font-family: monospace; font-weight: bold;">
    <input type="hidden" name="action" value="submited"/>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Jméno:</label>
    <input autocomplete="off" name="jmeno" type="text" class="form-control bg-dark text-white" id="exampleInput1" aria-describedby="emailHelp" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email:</label>
    <input autocomplete="off" name="email" type="email" class="form-control bg-dark text-white" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Heslo:</label>
    <input autocomplete="off" name="heslo" type="password" class="form-control bg-dark text-white" id="exampleInputPassword1" required>
  </div>
  <input name="admin" class="form-check-input" type="checkbox" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Admin
  </label>
  <button autocomplete="off" type="submit" class="btn btn-primary bg-dark">Potvrdit</button>
    </form>
 </div>
</div>
<div class="d-flex justify-content-center">
<button class="btn btn-primary bg-dark" style="font-family: monospace" onclick="toggleForm()">Přidat nového uživatele</button>
</div>
<script>
    function toggleForm() {
        var form = document.getElementById("newUserForm");
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>
<script src="js/bootstrap.js"></script>
</body>
</html>