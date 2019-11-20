<html>

<?php
session_start();
include "DatabaseConnection.php";

$StockID = $_GET["ProductID"];

$stockItemDetails = mysqli_query($connection, "SELECT Video, UnitPrice, StockItemName, Photo FROM stockitems WHERE StockItemID = $StockID");
$resultStockItemDetails = mysqli_fetch_array($stockItemDetails);

$stock = mysqli_query($connection, "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = $StockID");
$resultStock = mysqli_fetch_array($stock);

$searchQuery2 = "SELECT Photo FROM foto WHERE StockitemID = ?";

$searchSQL2 = mysqli_prepare($connection, $searchQuery2);
mysqli_stmt_bind_param($searchSQL2, 's', $StockID);
mysqli_stmt_execute($searchSQL2);
$result2 = mysqli_stmt_get_result($searchSQL2);

?>
<body>
    <?php
    if(mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            $StockPhoto2 = $row["Photo"];
            print("<img src=\"$StockPhoto2\" style=\"width: 150px\"><br>");
        }
    }

    print($resultStockItemDetails["StockItemName"] . '<br>');
    echo '<a target="_blank" href="'. $resultStockItemDetails["Video"] .'">Video</a><br>';
    print("price per unit: €   " . preg_replace('/\./', ',', $resultStockItemDetails["UnitPrice"]) . '<br>');
    print("Quantity on hand:  " .  $resultStock["QuantityOnHand"] . '<br>');
    ?>
</body>
</html>