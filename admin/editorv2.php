<?php
// $_SESSION["id"] je id editované prezentace


require_once "service/session.php";
require_once "service/connect_db.php";
require "const/const.php";
$con = connect_db();

if(!(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1)) { header("Location: login.php"); exit;};

$slides = [];

if ($_SESSION["edit"] && isset($_SESSION["id"])) { //$edit se vypíná pokud vstupuje do pres.php přes navbar
    $sql = "SELECT id, htmltext FROM infotabdb.snimky WHERE prezentace_id = ".$_SESSION["id"];
    $result = mysqli_query($con, $sql);
    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $slides[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
//odlišné $sql při odišném editu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_SESSION["edit"] == true) {
            $sql = "DELETE FROM infotabdb.snimky WHERE prezentace_id = ".$_SESSION["id"].";";
            if (!mysqli_query($con, $sql)) {
                echo "Error: " . mysqli_error($con);
            };
            foreach ($_POST['slides'] as $slideContent) {
                $escapedContent = mysqli_real_escape_string($con, $slideContent);
                // $sql = "UPDATE infotabdb.snimky SET htmltext = '$escapedContent' WHERE id = ".intval($slideId);
                $sql = "INSERT INTO infotabdb.snimky(prezentace_id, htmltext) VALUES ({$_SESSION['id']}, '$escapedContent');";
                if (!mysqli_query($con, $sql)) {
                    echo "Error: " . mysqli_error($con);
                };  
            }
            header("location: lobby.php");        
        } else {
            foreach ($_POST['slides'] as $slideContent) {
                $escapedContent = mysqli_real_escape_string($con, $slideContent);
                $sql = "INSERT INTO infotabdb.snimky(prezentace_id, htmltext) VALUES ({$_SESSION['p_id']}, '$escapedContent');";
                if (!mysqli_query($con, $sql)) {
                    echo "Error: " . mysqli_error($con);
            };
        }
        header("location: lobby.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor</title>
    <link rel="stylesheet" href="css/bootstrap.css">

    <script src="tinymce/tinymce.min.js"></script>
</head>
<body>
    <form method="POST">
        <div id="slidesContainer">
            <?php foreach ($slides as $index => $slide): ?>
                <textarea name="slides[<?php echo $slide['id']; ?>]" class="slide-editor" id="slide_<?php echo $index + 1; ?>"><?php echo htmlspecialchars($slide['htmltext']); ?>
                </textarea>
                <button type="button" class="form-control bg-light text-black" style="font-family: monospace" onclick="deleteSlide('slide_<?php echo $index + 1; ?>')">Smazat snímek</button>
                <script>document.addEventListener('DOMContentLoaded', function() { initTinyMCE('slide_<?php echo $index + 1; ?>'); });</script>
            <?php endforeach; ?>
        </div>
        <button type="button" class="form-control bg-light text-black" style="font-family: monospace" onclick="addSlide()">Přidat snímek</button>
        <input type="submit" class="form-control bg-light text-black" style="font-family: monospace" value="Vytvořit prezentaci">
    </form>

    <script>
        let slideCount = <?php echo count($slides); ?>;

        function addSlide() {
            slideCount++;
            let newSlideId = 'slide_' + slideCount;
            let newSlide = document.createElement('textarea');
            newSlide.name = 'slides[]';
            newSlide.classList.add('slide-editor');
            newSlide.id = newSlideId;
            document.getElementById('slidesContainer').appendChild(newSlide);

            initTinyMCE(newSlideId);

            let deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.innerText = 'Smazat snímek';
            deleteButton.className = 'form-control bg-light text-black';
            deleteButton.style.fontFamily = 'monospace';
            deleteButton.onclick = function() { deleteSlide(newSlideId); };
            document.getElementById(newSlideId).parentNode.insertBefore(deleteButton, newSlide.nextSibling);
        }

        function deleteSlide(slideId) {
            tinymce.get(slideId).remove();
            let slide = document.getElementById(slideId);
            slide.nextElementSibling.remove();
            slide.remove();
        }

        function initTinyMCE(slideId) {
            tinymce.init({
            selector: '#' + slideId,
            });
        }


        addSlide();
    </script>
</body>
</html>