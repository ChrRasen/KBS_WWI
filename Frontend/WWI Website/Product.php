<html>

<?php
session_start();
include "../../DatabaseConnection.php";

$StockID = $_GET["ProductID"];

$stockItemDetails = mysqli_query($connection, "SELECT Video, UnitPrice, StockItemName, discount, photo FROM stockitems WHERE StockItemID = $StockID");
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
$korting = floatval($resultStockItemDetails['discount'] / 100);
$prijs = floatval($resultStockItemDetails['UnitPrice']);
$prijsMetKorting = $prijs * (1 - $korting);
$video = $resultStockItemDetails["Video"];
$quantity = intval($resultStock["QuantityOnHand"]);

if ($quantity >= 30){
    $quantity = '30+';
}

print($resultStockItemDetails["StockItemName"] . '<br>');
if($video != "") {
    echo '<iframe width="600" height="400"
           src="' . $video . '">
           </iframe>
            <br>';
}
if($korting != ""){
    print("price per unit: €   " . $prijsMetKorting . "<br>");
    print($korting * 100 . '% korting <br>');
    echo' <font size = "4" color="Blue">   verzend kosten: €2,50</font>   <br>';
    print("Quantity on hand:  " . $quantity . '<br>');
    if(mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            $StockPhoto2 = $row["Photo"];
            print("<img src=\"$StockPhoto2\" style=\"width: 150px\"><br>");
        }
    }
}else{
    print("price per unit: €   " . $prijs . "<br>");
    echo' <font size = "4" color="Blue">   verzend kosten: €2,50</font>   <br>';
    print("Quantity on hand:  " . $quantity . '<br>');
    if(mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            $StockPhoto2 = $row["Photo"];
            print("<img src=\"$StockPhoto2\" style=\"width: 150px\"><br>");
        }
    }
}

?>
</body>
</html>
