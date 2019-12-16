<html>
<?php
include "DatabaseConnection.php";
include "Index.php";


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
<!--<link rel="stylesheet" type="text/css" href="style/rating.css">-->
<div id="header"></div>
<div id="content">
<?php
print("<br>");
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
    $gemScore = round($gemScore);
}


if ($quantity >= 30){
    $quantity = '30+';
}elseif ($quantity == 0){
    $quantity = "uitverkocht";
}
//print($gemScore);

//laat de rating zien in stars (WIP)
print($resultStockItemDetails["StockItemName"] . '<br>');
if (is_string($gemScore)) {
    print("geen score's". "<br>");
}else{
    echo' <div class="rate">';
$iloop = 0;
while ($iloop != 5){
    $iloop++;
    if ($gemScore == $iloop) {
        echo '<input type="radio" name="rate" id="star'.$iloop.'" value="'.$iloop.'" hidden disabled checked> </input>
        <label for="star'.$iloop.'" ></label>';
    }else{
        echo '<input type="radio" name="rate" id="star'.$iloop.'" value="'.$iloop.'" hidden disabled> </input>
        <label for="star'.$iloop.'" ></label>';
    }
}
echo'</div><br>';
}

//laat video zien als die er is
if($video != "") {
    echo '<iframe width="600" height="400"
           src="' . $video . '">
           </iframe>
            <br>';
}
if($korting != ""){
    echo'<div class="discount-label blue"> <span>-20%</span> </div><br><br><br><br>';
    print("price per unit: €   " . $prijsMetKorting . "<br>");
   //print($korting * 100 . '% korting <br>');
    echo' <font size = "4" color="Blue">   verzend kosten: €6,95</font>   <br>';
    print("Quantity on hand:  " . $quantity . '<br>');
    if(mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            $StockPhoto2 = $row["Photo"];
            print("<img src=\"$StockPhoto2\" style=\"width: 150px\"><br>");
        }
    }
}else{
    print("price per unit: €   " .preg_replace('/\./', ',', $prijs). "<br>");
    echo' <font size = "4" color="Blue">   verzend kosten: €2,50</font>   <br>';
    print("Quantity on hand:  " . $quantity . '<br>');
    if(mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            $StockPhoto2 = $row["Photo"];
            print("<img src=\"$StockPhoto2\" style=\"width: 150px\"><br>");
        }
    }
}

echo' <br>
<form action="shopping_cart.php" method="get"> 
<button type="submit" class="toevoegenWWButton" name="erbij" value="'.$StockID.'"> toevoegen aan winkelwagen</button>
</form>';

if($_SESSION["loggedin"] == true) {
    echo '
        <form action="Review.php" method="post">
        <button type="submit" class="productButton" name="Review" value="' . $StockID . '"> Schrijf review </button>
         </form>';
}else{
    print("login om review te schrijven". "<br>");
    echo'<button type="submit" class="productButton" name="Review" value="' . $StockID . '"disabled> Schrijf review </button>';

}


//sql voor het krijgen van alle reviews met comentaar
$reviewComentaarQuery = mysqli_query($connection, "SELECT R.comentaar,R.score ,K.achternaam FROM review R join klantgegevens K ON K.email = R.email WHERE stockitemid = $StockID");
while($resultCR = mysqli_fetch_array($reviewComentaarQuery, MYSQLI_ASSOC)){
    print($resultCR['achternaam']. " score "  . $resultCR['score']. "<br>");
    print($resultCR['comentaar']. "<br><br>");
}

?>
    <div class="clearFloat" top="10px"></div>
    <div id="footer"></div>
    <script>
        $(function(){
            $("#header").load("header.php");

            $("#footer").load("footer.php");
        });
    </script>
</body>
</html>
