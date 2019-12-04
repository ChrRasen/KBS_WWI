<html>

<body>
<?php

session_start();
include "DatabaseConnection.php";
$producten = array();
$geldopslag = array();
if(empty($_SESSION["Ses_producten"])){
    print('');
}elseif (!($_SESSION["Ses_producten"] === null)){
    $producten = $_SESSION["Ses_producten"];
}

if(isset ($_GET["erbij"])  ) {
    $erbij = $_GET["erbij"];
    $producten["$erbij"] = 1;
}

foreach ($producten as $index => $waarde) {
    if(isset ($_GET[$index])) {
        $quant = $_GET[$index];
        $producten[$index] = $quant;
    }
}
foreach($producten as $index => $waarde){
if($waarde == null){
    unset($producten[$index]);
}
}

echo '<form action="shopping_cart.php" method="get">'; // Create form
foreach($producten as $index => $waarde) {
    $sqlquery = mysqli_query($connection, "SELECT StockItemName FROM stockitems WHERE StockItemID = $index");
    if (!$sqlquery) {
        printf("Error: %s\n", mysqli_error($connection));
        exit();
    }
  //  if($waarde == null){
   //     unset($producten[$index]);
   // }
    $resultStockItemName = mysqli_fetch_array($sqlquery, MYSQLI_BOTH);
    $naam = $resultStockItemName["StockItemName"];

    $sqlquery2 = mysqli_query($connection, "SELECT UnitPrice FROM stockitems WHERE StockItemID = $index");

    $resultUnitPrice = mysqli_fetch_array($sqlquery2, MYSQLI_BOTH);
    $PrijsPerStuk = $resultUnitPrice["UnitPrice"];

    echo  $naam .
        '<input type="number" min="1" value="'.$waarde.'"  name="' . $index . '" class="calculator-input"
            onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>' ;
    if(!($waarde == null)) {
        $PrijsPerProduct = ($PrijsPerStuk * $waarde);

        echo($waarde . " totaal: " . $PrijsPerProduct . "€");


        $geldopslag[$index] = $PrijsPerProduct;
    }
    echo '<br>';
}

$totaalbedrag = array_sum($geldopslag);
if($totaalbedrag > 0) {
    if ($totaalbedrag <= 40) {
        $totaalbedrag = $totaalbedrag + 6.95;
    }
}
if($totaalbedrag == 0) {
    print('uw winkelwagen is leeg' . '<br>');
}
print("uw totaal bedrag is: " . $totaalbedrag);

echo '<button type="submit" value="submit">aanpassen</button>
    </form>';
$_SESSION["Ses_producten"] = $producten;
echo '

    <form action="betaalpagina.php" method="get">
<button type="submit" name="afrekenen" value="' .$totaalbedrag.'"> afrekenen</button>
        </form>';
?>

<a href="Home.php">verder met winkelen</a>

</body>
</html>