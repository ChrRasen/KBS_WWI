<?php
include "databaseConnection.php";
?>

<html>
<head>
    WorldWideImporters
</head>
<body>

<form action="Zoeken.php" method="GET">
    <input type="text" name="zoeken">
    <input type="submit" value="zoeken">
</form>

<form action="Inlogpagina.php">
    <input type="submit" value="Inloggen"><br>
</form>

<form action="Registreerpagina.php">
    <input type="submit" value="Registreren"><br>
</form>

<form action="Categorie.php" method="GET">


    <?php
    $stockGroupName = mysqli_query($connection, "SELECT StockGroupName FROM stockgroups");
    while ($row = mysqli_fetch_array($stockGroupName, MYSQLI_ASSOC))
    {
        $stock = $row["StockGroupName"];

        echo '<input type="submit" value="'.$stock.'" name="CAT">';
    }
    ?>


</form>

</body>
</html>

