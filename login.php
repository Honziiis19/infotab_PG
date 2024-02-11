<?php
// funkce pro pripojeni k DB aj
require_once "service/session.php";
require_once "service/connect_db.php";
require_once "service/utils.php";

// zahrneme def. konstant
require "const/const.php";

// pokud form. odeslan, pak pokus o prihlaseni
if (isset($_POST["email"])) { // isset() vraci true
    // pokud hodnota je nastavena
    //  overit ze email a heslo ($_POST['heslo'])
    // jsou spravne (dotazem do DB)
    $con = connect_db();
    if ($con) {
        $sql = "select id, heslo, admin from uzivatele
                where email = '".$_POST["email"]."'";
        $sqlstat = mysqli_query($con, $sql);
        if ($row = mysqli_fetch_assoc($sqlstat)) {
            // v $row je zaznam uzivatele
            if ($_POST['heslo'] == $row["heslo"]) {
                // hesla sedi (co zadal uziv. do form a co je v DB)
                $_SESSION["logged_in"] = true;
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["admin"] = $row["admin"];
                $_SESSION['user_id'] = $row["id"];
                $_SESSION["jmeno"] = $row["jmeno"];
                header("location: lobby.php"); //general lobby
            } else { // heslo nesedi
                $_SESSION["logged_in"] = false;
                echo '<script>alert("Chybný email nebo heslo")</script>';
            }
        } else { // zaznam pro email v DB neex.
            $_SESSION["logged_in"] = false;
            echo '<script>alert("Chybný email nebo heslo")</script>';
        }

    }
}
?>
<link rel="stylesheet" href="css/bootstrap.css">
<body style="background-color: grey; font-family: monospace">
<h1 class="text-center">Přihlášení</h1>
<div class="container d-flex justify-content-center">
<form method="POST">
  <input type="hidden" name="action" value="submited"/>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email:</label>
    <input autocomplete="off" name="email" type="email" class="form-control bg-dark text-white" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Heslo:</label>
    <input autocomplete="off" name="heslo" type="password" class="form-control bg-dark text-white" id="exampleInputPassword1" required>
  </div>
  <button autocomplete="off" type="submit" class="btn btn-primary bg-dark">Přihlásit</button>
</form>
</div>
<script src="js/bootstrap.js"></script>
</body>