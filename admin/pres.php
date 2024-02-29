<?php 
    require_once "service/session.php"; require_once "service/connect_db.php";
    // kontrola zda vytvareni nove prezentace
    if (isset($_GET['new'])) {
        $_SESSION["edit"] = false;
    }    
    // pripojeni k DB
    $con = connect_db();

    if(!( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1)) { header("Location: login.php"); exit; };
    
    if($_SESSION['logged_in'] == 1) {
        if($_SESSION["admin"]==1) {
            require "nav/nav_admin.php";
            } else {    
                require "nav/nav_user.php";
                    }
        };
    require "const/const.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $nadpis = mysqli_real_escape_string($con, $_POST['nadpis']);
        $obsah = mysqli_real_escape_string($con, $_POST['obsah']);
        $scrollText = mysqli_real_escape_string($con, $_POST['scroll-text']);

        // edit se vypina pri pripojeni pres navbar
        if($_SESSION["edit"] == true) {
            $sql = "UPDATE infotabdb.prezentace SET nadpis ='".$_POST['nadpis']."', obsah ='".$_POST['obsah']."', scrolltext ='".$_POST['scroll-text']."', modifiedby = '".$_SESSION['jmeno']."' WHERE id = ".$_SESSION["id"].";";
        } else {
            $sql = "INSERT INTO infotabdb.prezentace (nadpis, obsah, scrolltext, createdby, modifiedby, aktivni, uzivatele_id) VALUES ('$nadpis', '$obsah', '$scrollText', '".$_SESSION['jmeno']."', '', '0', '".$_SESSION['user_id']."');";
        }
        if (mysqli_query($con, $sql)) {
            echo "Data inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        $_SESSION['p_id'] = $con->insert_id;

        header("location: editorv2.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body style="background-color: grey; font-family: monospace">
<h2 style= "font-family: monospace; margin-top: 1em;" class="text-center">Obecné informace</h2>
<div class="d-flex align-items-center justify-content-center">
    <form method='POST' style="font-family: monospace">
    <div class="row mb-3">
        <label for="nadpis" class="col-sm-2 col-form-label">Nadpis</label>
        <div class="col-sm-10">
                <input type="text" class="form-control" name="nadpis" id="nadpis" placeholder="Nadpis" value="<?php echo isset($_SESSION['edit']) && $_SESSION['edit'] ? htmlspecialchars($_SESSION['nadpis']) : ''; ?>">
        </div>
    </div>
    <div class="row mb-3">
            <label for="obsah" class="col-sm-2 col-form-label">Obsah</label>
            <div class="col-sm-10">
                <textarea type="text" class="form-control" name="obsah" id="obsah" placeholder="Obsah"><?php echo isset($_SESSION['edit']) && $_SESSION['edit'] ? htmlspecialchars($_SESSION['obsah']) : ''; ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="scroll-text" class="col-sm-2 col-form-label">Scroll text</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="scroll-text" id="scroll-text" placeholder="Scroll text" value="<?php echo isset($_SESSION['edit']) && $_SESSION['edit'] ? htmlspecialchars($_SESSION['scrolltext']) : ''; ?>">
            </div>
        </div>
    <div class="col-auto">
        <button autocomplete="off" type="submit" class="btn btn-primary bg-dark">Potvrdit</button>
    </div>
</form>
</div>
<script src="js/bootstrap.js"></script>
</body>
</html>
