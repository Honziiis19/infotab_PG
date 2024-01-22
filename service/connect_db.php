<?php

/**
 * Pripojeni k DB.
 * @return DB spojeni pokud ok/false pri chybe + ji vypise.
 */
function connect_db()
{
    // pripojeni k DB
    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $password="root";
    $dbname="projdb";

    $con = mysqli_connect($host, $user, $password, $dbname, $port, $socket);
    if ($con) {
        // ok
        return $con;
    } else {
        echo 'Could not connect to the database server'
            . mysqli_connect_error();
        return false;
    }
}

?>