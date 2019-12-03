<html>
<?php
include "header.php";
include "DatabaseConnection.php";

$StockID = $_GET["ProductID"];

//sql voor het krijgen van de info van het product
$stockItemDetails = mysqli_query($connection, "SELECT Video, UnitPrice, StockItemName, discount, photo FROM stockitems WHERE StockItemID = $StockID");
$resultStockItemDetails = mysqli_fetch_array($stockItemDetails);

//sql voor het krijgen van de hoeveelheid van het product wat nog in stock is
$stock = mysqli_query($connection, "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = $StockID");
$resultStock = mysqli_fetch_array($stock);

//sql voor het krijgen van alle foto's van het product
$searchQuery2 = "SELECT Photo FROM foto WHERE StockitemID = ?";

$searchSQL2 = mysqli_prepare($connection, $searchQuery2);
mysqli_stmt_bind_param($searchSQL2, 's', $StockID);
mysqli_stmt_execute($searchSQL2);
$result2 = mysqli_stmt_get_result($searchSQL2);

//sql voor het krijgen van de score van het product
$reviewQuery = mysqli_query($connection, "SELECT count(*) AS aantal ,sum(score) AS totaalScore FROM review WHERE StockitemID = $StockID");
$resultReview = mysqli_fetch_array($reviewQuery);


?>
<body>
<?php
$korting = floatval($resultStockItemDetails['discount'] / 100);
$prijs = floatval($resultStockItemDetails['UnitPrice']);
$prijsMetKorting = $prijs * (1 - $korting);
$video = $resultStockItemDetails["Video"];
$quantity = intval($resultStock["QuantityOnHand"]);
$aantalReviews = $resultReview["aantal"];
$totaalScore = $resultReview["totaalScore"];
$gemScore = "Nog geen reviews";

if($aantalReviews != 0 or $totaalScore != 0) {
    $gemScore = $totaalScore / $aantalReviews;
}


if ($quantity >= 30){
    $quantity = '30+';
}elseif ($quantity == 0){
    $quantity = "uitverkocht";
}
//print($gemScore);

print($resultStockItemDetails["StockItemName"] . '<br>');
print("Gemidelde score : " . $gemScore . "<br>");
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

echo'
<form action="shopping_cart.php" method="get"> 
<button type="submit" name="erbij" value="'.$StockID.'"> toevoegen aan winkelwagen</button>
</form>';

//sql voor het krijgen van alle reviews met comentaar
$reviewComentaarQuery = mysqli_query($connection, "SELECT R.comentaar,R.score ,K.naam FROM review R join klantgegevens K ON K.email = R.email WHERE stockitemid = $StockID");
while($resultCR = mysqli_fetch_array($reviewComentaarQuery, MYSQLI_ASSOC)){
    print($resultCR['naam']. " score "  . $resultCR['score']. "<br>");
    print($resultCR['comentaar']. "<br><br>");
}

?>
</body>
</html>
