<?php
session_start();
include "databaseConnection.php";

//zorgt er voor dat de juiste waardes er zijn
if(isset($_GET["offset"])){
    $offset = $_GET["offset"];
}else{
    $offset = 0;
}

//zorgt er voor dat het de juiste categorie laat zien
if(isset($_GET["CAT"])){
    $categorieNaam = $_GET["CAT"];
}else{
    $categorieNaam = $_SESSION["CAT"];
}

//zorgt er voor dat het de juiste aantal prducten laat zien (25, 50 of 100)
if(!isset($_GET["aantal"]) && !isset($_SESSION["Saantal"])){
    $limit = 25;
}else if(isset($_GET["aantal"])){
    $limit = $_GET["aantal"];
}else if(isset($_SESSION["Saantal"])){
    $limit = $_SESSION["Saantal"];
}

//zorgt er voor dat het de goede producten laat zien (0 tot 25 of 26 tot 50 etc.)
if(isset($_GET["pagina"])){
    $offset = $_GET['pagina'];
}

//moet error message weergeven
if($offset < 0){
    $offset = 0;
}

$offsetSQL = $limit * $offset;
$_SESSION["CAT"] = $categorieNaam;
$_SESSION["Saantal"] = $limit;


print($categorieNaam. "<br>");

//sql query voor een count zodat je kan kijken of die niet veder kan gaan en maximum aantal pagina's kan berekenen
$max = "SELECT COUNT(s.stockitemid) AS maxitems FROM stockitems S JOIN stockitemstockgroups SI
ON S.stockitemid = SI.StockItemID JOIN stockgroups SG
ON SI.StockGroupID = SG.StockGroupID
WHERE StockGroupName =?";

$statementMax = mysqli_prepare($connection, $max);
mysqli_stmt_bind_param($statementMax, 's', $categorieNaam);
mysqli_stmt_execute($statementMax);
$resultmax = mysqli_stmt_get_result($statementMax);

//de sql query om de producten te laten zien
$categorie = "SELECT s.stockitemname, s.stockitemid, Photo, UnitPrice
FROM stockitems S JOIN stockitemstockgroups SI
ON S.stockitemid = SI.StockItemID JOIN stockgroups SG
ON SI.StockGroupID = SG.StockGroupID
WHERE StockGroupName =?
LIMIT ? OFFSET ?";

$statement = mysqli_prepare($connection, $categorie);
mysqli_stmt_bind_param($statement, 'sii', $categorieNaam, $limit, $offsetSQL);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);


?>
<html>
<head>
    <style>
        img {
            width:150px;
        }
    </style>
</head>
<body>
<br>
<?php
while ($row = mysqli_fetch_array($resultmax, MYSQLI_ASSOC)) {
   $maxItems = $row["maxitems"];
}

$maxPages = $maxItems / $limit;

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $StockItemName = $row["stockitemname"];
    $StockID = $row["stockitemid"];
    $StockPhoto = $row["Photo"];
    $StockItemPrice = $row["UnitPrice"];
    $StockItemPrice = $row['UnitPrice'];
    $StockPhoto = '<img src="data:image/jpg;base64,' . $row['Photo'] . '">';
    Print('<a href="http://localhost/KBS/KBS_WWI/Product.php?ProductID=' . $StockID . '">' . $StockPhoto. '<br>' .$StockItemName . "<br> " ."€". preg_replace('/\./', ',', $StockItemPrice) . "<br>". '</a><br>');
    print("<br>");
}
?>
    <form action="Categorie.php" method="GET">
        <?php //zorgt er voor dat je niet terug kan wanneer je bij de eerste bent
        if($offset != 0){
            $offset--;
            echo'<button type="submit" value='.$offset.' name="pagina"> vorige </button>
        '; $offset++;}
        else{ echo'<input type="submit" value="vorige" name="pagina" disabled>
        ';}
        ?>

        <?php
        //while loop die zorgt dat je snell terug kan gaan of veder kan gaan
        $i = 0;
        while($i < $maxPages){
            if($i != $offset){
                $n= $i + 1;
                echo'<button type="submit" value='.$i.' name="pagina"> '.$n.' </button>';
                ;}
                else{ $n= $i + 1;
                    echo'<input type="submit" value='.$n.' disabled>';
                   }
            $i++;
        }
        ?>

        <?php
        //zorgt er voor dat je naar de volgende pagina kan, en je kan er niet op klikken wanneer je bij de laatste pagina bent
        if($offset + 1 < $maxPages) {
            $offset++;
            echo '<button type="submit" value='.$offset.' name="pagina"> volgende </button>';
        $offset--;}
        else{
            echo '<input type="submit" value="volgende" disabled>';
        }
        ?>
        <br>
        <br>
        <input type="submit" value=25 name="aantal">
        <input type="submit" value=50 name="aantal">
        <input type="submit" value=100 name="aantal">
    </form>
</body>
</html>

