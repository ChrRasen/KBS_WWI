<?php
include "databaseConnection.php";
$search = "%" . $_GET['zoeken'] . "%";


$searchQuery = "SELECT * FROM stockitems WHERE StockItemName LIKE ? OR StockItemID = ? OR SearchDetails LIKE ?";

$searchSQL = mysqli_prepare($connection, $searchQuery);
mysqli_stmt_bind_param($searchSQL, 'sss', $search, $search, $search);
mysqli_stmt_execute($searchSQL);
$result = mysqli_stmt_get_result($searchSQL);
?>

<html>
<body>
    <?php
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $StockItemName = $row["StockItemName"];
            $StockItemID = $row["StockItemID"];
            print($StockItemName."<BR>");
        }
    }else{
        print("No results");
    }
    ?>
</body>
</html>