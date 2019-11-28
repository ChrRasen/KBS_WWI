<?php
    $host = "localhost";
    $databasename = "wideworldimporters";
    $user = "WWI_Admin";
    $pass = "S5]*p!~eT(8J";
    $connection = new mysqli($host, $user, $pass, $databasename);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);

    }
?>