<html>

<body>

<div id="header"></div>
<div class="cartbackground">
<div class="cartcontent">
<div class="cartbox">
<?php

print("<br>");
include "DatabaseConnection.php";
include "Index.php";


$producten = array();
$geldopslag = array();
// checken of de session is aangemaakt zo ja maak producten dan de sessie waarde
if(empty($_SESSION["Ses_producten"])){
    print('');
}elseif (!($_SESSION["Ses_producten"] === null)){
    $producten = $_SESSION["Ses_producten"];
}
// toevoegen van het nieuwe product aan de array met een standaard waarde van 1
if(isset ($_POST["erbij"])) {
    $erbij = $_POST["erbij"];
    $producten["$erbij"] = 1;
}
//het onthouden van het aantal per product in de winkelwagen
foreach ($producten as $index => $waarde) {
    if(isset ($_POST[$index])) {
        $quant = $_POST[$index];
        $producten[$index] = $quant;
    }
}
//als het veld leeg is haal hem dan uit de array / winkelwagen
foreach($producten as $index => $waarde){
if($waarde == null){
    unset($producten[$index]);
}
}
//de foreach-loop die de buttons aanmaakt en de totale prijs per product berekend.
echo '<form action="shopping_cart.php" method="post">'; // Create form
foreach($producten as $index => $waarde) { // sql queries om de naam van het product en de prijs op te vragen
    $sqlquery = mysqli_query($connection, "SELECT StockItemName FROM stockitems WHERE StockItemID = $index");
    if (!$sqlquery) {
        printf("Error: %s\n", mysqli_error($connection));
        exit();
    }
    // zodat mensen hem met element inspecteren niet onder 1 kunnen krijgen
    if($waarde <= 1){
        $waarde = 1;
    }

    $resultStockItemName = mysqli_fetch_array($sqlquery, MYSQLI_BOTH);
    $naam = $resultStockItemName["StockItemName"];

    $sqlquery2 = mysqli_query($connection, "SELECT UnitPrice FROM stockitems WHERE StockItemID = $index");

    $resultUnitPrice = mysqli_fetch_array($sqlquery2, MYSQLI_BOTH);
    $PrijsPerStuk = $resultUnitPrice["UnitPrice"];
// print de naam van het product en vervolgens vraagt hij de waarde die is standaard 1
// en wordt gevraagd met een number-field die enkel 0-9 toelaat
    echo'<div class="cartProduct"> ' .$naam. '.
        <input type="number" min="1" value="'.$waarde.'"  name="' . $index . '" class="calculator-input"
            onkeypress="return event.charCode >= 48 && event.charCode <= 57">' ;
    // bepaald de prijs en toont deze !($waarde == null) is er zodat hij het enkel doet als de waarde niet leeg is
    // anders blijft de prijs daarna nog staan

    if(!($waarde == null)) {
        $PrijsPerProduct = ($PrijsPerStuk * $waarde);

        print(" " . $waarde . "x = " . $PrijsPerProduct . "€");


        $geldopslag[$index] = $PrijsPerProduct;
    }
    echo '</div> <br>';
}
// berekenen van totaalbedrag en eventueel bezorgkosten
$totaalbedrag = array_sum($geldopslag);
if($totaalbedrag > 0) {
    if ($totaalbedrag <= 40) {
        $totaalbedrag = $totaalbedrag + 6.95;
    }
}
//als de winkelwagen leeg is geeft de website dat aan

if($totaalbedrag == 0) {
    print('uw winkelwagen is leeg' . '<br>');
}
print("uw totaal bedrag is: " . $totaalbedrag . '<br>');

// button om de page te refreshen
echo '<div class="leftbutton">
<button type="submit" value="submit" class="cartButton">aanpassen</button>
   </div> </form>';
// session aanmaken zodat hij het onthoud ook als je naar andere pagina's gaat
$_SESSION["Ses_producten"] = $producten;

//button om naar de betaalpagina te gaan geeft het totaalbedrag met eventuele bezorgkosten meegerekend mee
    echo '<div class="rightbutton">
    <form action="betaalpagina.php" method="post" >
<button type="submit" name="afrekenen" value="' . $totaalbedrag . '" class="cartButton"> afrekenen</button>
    </div>
    <div class="clearFloat"></div>
        </form>';
        //de link terug naar de home page en CSS voor footer en header
    echo "<div id=\"content\"> </div>";

?>
    <div class="continuebox">
<a href="Home.php">verder met winkelen</a>
    </div>
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
