<?php
require_once "service/session.php";

$host = "localhost";
$port = 3306;
$socket = "";
$user = "root";
$password = "root";
$dbname = "infotabdb";

$con = mysqli_connect($host, $user, $password, $dbname, $port, $socket);
if (!$con) {
    echo 'Could not connect to the database server' . mysqli_connect_error();
    exit;
}

if(!(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1)) { header("Location: login.php"); exit;};

// aktivni prezentace
$aktivniprezsql = "SELECT id, scrolltext FROM infotabdb.prezentace WHERE aktivni = '1'";
$aktivniprezresult = mysqli_query($con, $aktivniprezsql);

if ($aktivniprezresult && $row = mysqli_fetch_assoc($aktivniprezresult)) {
    $aktivniprezId = $row['id'];
    $scrollText = $row['scrolltext'];
} else {
    echo "Žádná aktivní prezentace";
    exit;
}

// aktivni snimky
$snimkysql = "SELECT htmltext FROM infotabdb.snimky WHERE prezentace_id = $aktivniprezId";
$snimkyresult = mysqli_query($con, $snimkysql);

$slidy = [];
while ($slide = mysqli_fetch_assoc($snimkyresult)) {
    $slidy[] = $slide['htmltext'];
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Mode</title>
    <style>
        .scroll-text {
            position: fixed;
            bottom: 5%;
            width: 100%;
            animation: scroll 20s linear infinite;
            font-size: 1.5em;
        }

        @keyframes scroll {
            0%   { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
    </style>
</head>
<body>
    <div class="scroll-text">
        <?php echo htmlspecialchars($scrollText); ?>
    </div>

    <div id="slideContainer">
    </div>

    <script>
        let slidy = <?php echo json_encode($slidy); ?>;
        let currentSlide = 0;

        function showSlide() {
            document.getElementById('slideContainer').innerHTML = slidy[currentSlide];
            currentSlide = (currentSlide + 1) % slidy.length;
            setTimeout(showSlide, 10000);
        }

        showSlide();
    </script>
</body>
</html>