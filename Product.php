<html>

<?php
session_start();
include "DatabaseConnection.php";

$StockID = $_GET["ProductID"];

$stockItemDetails = mysqli_query($connection, "SELECT Video, UnitPrice, StockItemName, Photo FROM stockitems WHERE StockItemID = $StockID");
$resultStockItemDetails = mysqli_fetch_array($stockItemDetails);

$stock = mysqli_query($connection, "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = $StockID");
$resultStock = mysqli_fetch_array($stock);

$photo = mysqli_query($connection, "SELECT Photo FROM stockitems WHERE StockItemID = $StockID");
//if(isset($photo)) {
    $resultPhoto = mysqli_fetch_array($photo);
//}else{
    //$resultPhoto =  "<img src='no_image.png'>";
//}
?>
<body>
    <?php
    $StockPhoto = '<img src="data:image/jpg;base64,' . $resultStockItemDetails['Photo'] . '">';
    echo $StockPhoto.'<br><br>';
    print($resultStockItemDetails["StockItemName"] . '<br>');
    echo '<a target="_blank" href="'. $resultStockItemDetails["Video"] .'">Video</a><br>';
    print("price per unit: €   " . preg_replace('/\./', ',', $resultStockItemDetails["UnitPrice"]) . '<br>');
    print("Quantity on hand:  " .  $resultStock["QuantityOnHand"] . '<br>');
    ?>
</body>
</html>