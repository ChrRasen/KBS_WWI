<html>
<?php
include "DatabaseConnection.php";
include "Index.php";

if(!isset($_GET["ProductID"]) OR $_GET["ProductID"] != is_numeric($_GET["ProductID"])){
    header('Location: Home.php');
}else{
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
<div class="productContent">
    <div class="flexContent">

        <?php
        $resultReview = mysqli_fetch_array($reviewQuery);

        $korting = floatval($resultStockItemDetails['discount'] / 100);
        $prijs = floatval($resultStockItemDetails['UnitPrice']);
        $prijsMetKorting = $prijs * (1 - $korting);
        $video = $resultStockItemDetails["Video"];
        $quantity = intval($resultStock["QuantityOnHand"]);
        $aantalReviews = $resultReview["aantal"];
        $totaalScore = $resultReview["totaalScore"];
        $gemScore = "Nog geen reviews";

        if ($aantalReviews != 0 or $totaalScore != 0) {
            $gemScore = $totaalScore / $aantalReviews;
            $gemScore = round($gemScore);
        }


        if ($quantity >= 30) {
            $quantity = '30+';
        } elseif ($quantity == 0) {
            $quantity = "uitverkocht";
        }
        //print($gemScore);

        //laat de rating zien in stars (WIP)
        echo '<div id="left">';
        echo '<div class="product-title">';
        print($resultStockItemDetails["StockItemName"]);
        echo '</div>';
        echo '<div class="product-score">';
        if (is_string($gemScore)) {
            print("geen score's");
        } else {
            echo ' <div class="rate">';
            $iloop = 0;
            while ($iloop != 5) {
                $iloop++;
                if ($gemScore == $iloop) {
                    echo '<input type="radio" name="rate" id="star' . $iloop . '" value="' . $iloop . '" hidden disabled checked> </input>
        <label for="star' . $iloop . '" ></label>';
                } else {
                    echo '<input type="radio" name="rate" id="star' . $iloop . '" value="' . $iloop . '" hidden disabled> </input>
        <label for="star' . $iloop . '" ></label>';
                }
            }
            echo '</div>';
            echo '</div>';

        }
        //laat video zien als die er is
        echo '<div class="product-video">';
        if ($video != "") {
            echo '<iframe width="600" height="337.5"
           src="' . $video . '">
           </iframe>';
        }
        echo '</div>';
        echo '<div id class="product-foto">';
        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                $StockPhoto2 = $row["Photo"];
                print("<img src=\"$StockPhoto2\" style=\"width: 600px; height: 337.5px\">");
            }
        }
        echo '</div>';
        echo '<div class="product-information">
         <div class="product-text">
            Productinformatie
         </div>
        <ul>
            <li><i class="fas fa-plus-circle"></i>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
            <li><i class="fas fa-plus-circle"></i>Aliquam non scelerisque lorem. Donec imperdiet elementum urna in sodales.</li>
            <li><i class="fas fa-plus-circle"></i>Proin id mi a risus cursus mollis. Praesent mi lectus, rutrum in tortor vitae, varius consectetur tortor.</li>
            <li><i class="fas fa-minus-circle"></i>Suspendisse porta lacinia nulla, non dictum ligula maximus eget.</li>
        </ul> 
        <div class="product-text">
            Productomschrijving
         </div>
         <div class="product-info">Nunc pharetra nibh feugiat placerat malesuada. Praesent aliquam enim cursus viverra venenatis. Proin pharetra rhoncus ex, sed vestibulum magna volutpat ac. Nullam semper, eros eget sagittis sollicitudin, quam nisl placerat enim, tincidunt volutpat urna nibh in ex. Donec sed diam cursus ipsum hendrerit rutrum vitae at risus. Phasellus nibh nibh, gravida nec mauris at, accumsan consectetur magna. Praesent suscipit justo nibh, id egestas ante feugiat ac. Vivamus suscipit, nulla eu porta congue, nunc nisi suscipit urna, et pellentesque libero nulla a urna. Sed consectetur tellus eu lectus lacinia, sit amet congue nulla egestas.</div>
    </div>';
        echo '<div class="product-review">';
        echo '
<form action="Review.php" method="post">
<button type="submit" class="productButton" name="Review" value="' . $StockID . '"> Schrijf review </button>
</form>';

        //sql voor het krijgen van alle reviews met comentaar

        $reviewComentaarQuery = mysqli_query($connection, "SELECT R.comentaar,R.score ,K.achternaam FROM review R join klantgegevens K ON K.email = R.email WHERE stockitemid = $StockID");
        while ($resultCR = mysqli_fetch_array($reviewComentaarQuery, MYSQLI_ASSOC)) {
            print($resultCR['achternaam'] . " score " . $resultCR['score']."<br>");
            print($resultCR['comentaar']."<br><br>");
        }
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        //RIGHT SIDE
        echo '<div id="right">';
        if ($korting != "") {
            echo '<div class="product-discount">';
            print("10% korting!");
            echo '</div>';
            echo '<div class="product-price">';
            print("€   " . $prijsMetKorting . ",-");
            echo '</div>';
            echo '<div class="product-send">';
            //print($korting * 100 . '% korting <br>');
            echo ' <font>   verzend kosten: €6,95</font>';
            echo '</div>';
            echo '<div class="product-quantity">';
            print("Aantal op voor voorraad:  " . $quantity);
            echo '</div>';

        } else {
            echo '<div class="product-send">';
            print("price per unit: €   " . preg_replace('/\./', ',', $prijs));
            echo ' <font size = "4" color="Blue">   verzend kosten: €6,95</font>';
            echo '</div>';
            echo '<div class="product-quantity">';
            print("Quantity on hand:  " . $quantity);
            echo '</div>';

        }
        echo '<div class="product-cart">';
        echo ' 
<form action="shopping_cart.php" method="get"> 
<button type="submit" class="toevoegenWWButton" name="erbij" value="' . $StockID . '"><i class="fa fa-shopping-cart"></i> toevoegen aan winkelwagen</button>
</form>';

        echo '<div class="product-conversion">Voor 23.59 uur besteld,morgen gratis bezorgd<br>
    Gratis binnen 30 dagen te retourneren<br> 2 jaar garantie op je slimme horloge<br>
    </div>';
        echo '</div>';
        echo '</div>';

        ?>
    </div>
</div>
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
