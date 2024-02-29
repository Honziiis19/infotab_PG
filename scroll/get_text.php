<?php
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
        echo 'Nepovedlo se připojit k databázi' . mysqli_connect_error();
    }

    $sqlscroll = "SELECT scrolltext FROM infotabdb.prezentace WHERE aktivni = '1'";
    $sqlresultscroll = mysqli_query($con, $sqlscroll);

    if ($sqlresultscroll) {
        while ($row = mysqli_fetch_assoc($sqlresultscroll)) {
            echo $row["scrolltext"] . " ";
        }
    } else {
        echo "Chyba při vykonávání dotazu: " . mysqli_error($con);
    };


/**echo "Vítejte na dni otevřených dveří gymnázia v Tišnově. "
." Otevřeno od 14 do 17h. "
." &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;"
." &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;"
;
*/
?>