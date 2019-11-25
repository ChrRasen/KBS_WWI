<html>

<?php
session_start();
include "DatabaseConnection.php";

$StockID = $_GET["ProductID"];

$stockItemDetails = mysqli_query($connection, "SELECT Video, UnitPrice, StockItemName, discount FROM stockitems WHERE StockItemID = $StockID");
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
    $korting = floatval($resultStockItemDetails['discount'] / 100);
    $prijs = floatval($resultStockItemDetails['UnitPrice']);
    $prijsMetKorting = $prijs * (1 - $korting);
    $video = $resultStockItemDetails["Video"];

    print($resultStockItemDetails["StockItemName"] . '<br>');
    echo '<iframe width="600" height="400"
           src="'.$video.'">
           </iframe>
            <br>';
    if($korting != ""){
        print("price per unit: €   " . $prijsMetKorting . "<br>");
        print($korting * 100 . '% korting <br>');
        echo' <font size = "4" color="Blue">   verzend kosten: €2,50</font>   <br>';
        print("Quantity on hand:  " . $resultStock["QuantityOnHand"] . '<br>');
        echo '<img src="'.$resultPhoto['Photo'].'" alt="foto"/>' . '<br>';
    }else{
    print("price per unit: €   " . $prijs . "<br>");
    echo' <font size = "4" color="Blue">   verzend kosten: €2,50</font>   <br>';
    print("Quantity on hand:  " . $resultStock["QuantityOnHand"] . '<br>');
    echo '<img src="'.$resultPhoto['Photo'].'" alt="foto"/>' . '<br>';
    }
    ?>
</body>
</html>