<html>
<?php
session_start();
include "DatabaseConnection.php";

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

$reviewQuery = mysqli_query($connection, "SELECT count(*) AS aantal ,sum(score) AS totaalScore FROM review WHERE StockitemID = $StockID");
$resultReview = mysqli_fetch_array($reviewQuery);

$reviewComentaarQuery = mysqli_query($connection, "SELECT R.comentaar,R.score ,K.naam FROM review R join klantgegevens K ON K.email = R.email WHERE stockitemid = $StockID");

?>
<head>
    <link rel="stylesheet" type="text/css" media="all" href="style/stylesheet.css">
</head>
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

    print("<h1>" . $resultStockItemDetails["StockItemName"] . "</h1>" );
    print("Gemidelde score : " . $gemScore . "<br>");
    if($video != "") {
        echo '<iframe width="600" height="400"
           src="' . $video . '">
           </iframe>';
    }
    if($korting != ""){
        if(mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                $StockPhoto2 = $row["Photo"];
                print("<img class='productImage' src=\"$StockPhoto2\" ");
            }
        }
        print("<p>price per unit: €   " . $prijsMetKorting . "</p>" );
        print("<p>" . $korting * 100 . " % korting </p>");
        echo' <p>Verzend kosten: €2,50</p>';
        print("<p>Quantity on hand:  " . $quantity . "</p>" );
    } else {
        if(mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                $StockPhoto2 = $row["Photo"];
                print("<img class='productImage' src=\"$StockPhoto2\"");
            }
        }
        print("<div class='productDescription'><p>Price per unit: €   " . $prijs. "</p>" );
        echo' <p>Verzend kosten: €2,50</p>';
        print("<p>Quantity on hand:  " . $quantity. "</p></div>" );
    }

    echo'
    <form action="shopping_cart.php" method="get"> 
<button type="submit" name="erbij" value="'.$StockID.'"> toevoegen aan winkelwagen</button>
        </form>';

    ?>
</body>
</html>
