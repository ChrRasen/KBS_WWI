<html>

<body>
<?php
include "DatabaseConnection.php";
include "Index.php";
$producten = array();

if(empty($_SESSION["Ses_producten"])){
    print('winkelwagen is nog leeg');
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

    echo  $naam .
        '<input type="number" min="1" value="'.$waarde.'"  name="' . $index . '" class="calculator-input" 
            onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>' ;
    $PrijsPerProduct = ($PrijsPerStuk * $waarde);
    echo(" " . $PrijsPerProduct);
    echo'<br>';

}
echo '<button type="submit" value="submit">Toevoegen</button> 
    </form>';
$_SESSION["Ses_producten"] = $producten;
?>
<a href="Home.php">verder met winkelen</a>

</body>
</html>