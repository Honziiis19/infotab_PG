<?php
require_once "service/session.php";
require_once "service/connect_db.php";
require "const/const.php";
if(!( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1)) { header("Location: login.php"); exit; };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<script>
  function addSlide() {
    var newSlideId = 'slide_' + (document.querySelectorAll('.slide-editor').length + 1);
    var newSlide = document.createElement('textarea');
    newSlide.classList.add('slide-editor');
    newSlide.id = newSlideId;
    document.getElementById('slidesContainer').appendChild(newSlide);

    tinymce.init({selector: '#' + newSlideId});
}

function deleteSlide(slideId) {
    tinymce.get(slideId).remove();
    document.getElementById(slideId).remove();
}

</script>
<?php
 //TODO - connect to database
 if($_SERVER['request_method'] == 'POST'
 && !empty($_POST['mytextarea'])) {
   $content = $_POST['mytextarea'];
 }

 ?>
<form method='POST'>
    <textarea id="mytextarea" name="mytextarea"></textarea>
    <button autocomplete="off" type="submit">Uložit snímek</button>
</form>


<script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script>
      tinymce.init({
        selector: '#mytextarea'
      });
</script>
<script src="js/bootstrap.js"></script>
</body>
</html>