<html>

<body>
<div id="header"></div>
        <div id="content">
            <h4>Winkelwagen</h4>

<?php
include "DatabaseConnection.php";
include "Index.php";

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

    $resultStockItemName = mysqli_fetch_array($sqlquery, MYSQLI_BOTH);
    $naam = $resultStockItemName["StockItemName"];

    $sqlquery2 = mysqli_query($connection, "SELECT UnitPrice FROM stockitems WHERE StockItemID = $index");

    $resultUnitPrice = mysqli_fetch_array($sqlquery2, MYSQLI_BOTH);
    $PrijsPerStuk = $resultUnitPrice["UnitPrice"];

    echo  $naam . " " . "Aantal: ";

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
print("Verzendkosten: 6,95" . "<br>");
print("uw totaal bedrag is: " . $totaalbedrag);
?>

    </div>

    <div>
                        <h3>Betaalmethode</h3>
                        <input type="radio" value="ideal">Ideal<br>
                        <input type="radio" value="paypal">Paypal<br>
                        <input type="radio" value="Maestro">Maestro<br>

                <input type="submit" value="doorgaan met betaling"><br>
            </form>
        </div>
    </div>


</div>
<div class="clearFloat"></div>
<div id="footer"></div>
<script>
    $(function(){
        $("#header").load("header.php");

        $("#footer").load("footer.php");
    });
</script>
</body>
</html>
