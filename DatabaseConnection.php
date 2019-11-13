<?php
    $host = "localhost";
    $databasename = "wideworldimporters";
    $user = "root";
    $pass = "";
    $connection = new mysqli($host, $user, $pass, $databasename);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);

    }
?>