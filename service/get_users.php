<?php
// vystup bude JSON// hlavicka ze vystup je JSON
header('Content-Type: application/json');

// pripojeni k DB
$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="root";
$dbname="infotabdb";

$con = mysqli_connect($host, $user, $password, $dbname, $port, $socket);
if ($con) {
    // ok
} else {
    echo 'Could not connect to the database server'
        . mysqli_connect_error();
}

// JSON nad uzivatele 
$query = "SELECT id, email, admin FROM infotabdb.uzivatele";
$sqlstat = mysqli_query($con, $query);
if ($sqlstat) {
    //echo "SQL prikaz uspesne vykonan";
} else {
    echo "chyba: ".mysqli_errno($con) // cislo chyby
          .' '.mysqli_error($con); // popis chyby
}

$json = array();
while($row = mysqli_fetch_assoc($sqlstat)) {
    // skladame objekt pro zaznam z DB
    $json[] = $row;
}

echo json_encode($json);


mysqli_close($con);


?>
