<?php

include "index.php";
//zorgt er voor dat de juiste aantal producten laat zien
if(isset($_GET["offset"])){
    $offset = $_GET["offset"];
}else{
    $offset = 0;
}

//zorgt er voor dat het de juiste aantal prducten laat zien (25, 50 of 100)
if(!isset($_GET["aantal"]) && !isset($_SESSION["Saantal"])){
    $limit = 25;
}else if(isset($_GET["aantal"])){
    $limit = $_GET["aantal"];
}else if(isset($_SESSION["Saantal"])){
    $limit = $_SESSION["Saantal"];
}

$_SESSION["Saantal"] = $limit;

//zorgt er voor dat het de goede producten laat zien (0 tot 25 of 26 tot 50 etc.)
if(isset($_GET["pagina"])){
    $offset = $_GET['pagina'];
}

//moet error message weergeven
if($offset < 0){
    $offset = 0;
}

$offsetSQL = $limit * $offset;
$_SESSION["Saantal"] = $limit;

// haalt de waarde op van de input in het zoek veld

if(isset($_GET['zoeken'])) {
    $search = "%" . $_GET['zoeken'] . "%";
    $search2 = $_GET['zoeken'];
}else {
    $search = "%" . $_SESSION['search'] . "%";
    $search2 = $_SESSION['search'];
}
$_SESSION["search"] = $search2;

//query voor het zoeken van producten
$searchQuery = "SELECT S.StockItemID,S.SearchDetails,S.StockItemName,S.UnitPrice,F.Photo FROM stockitems S
JOIN foto F ON S.StockitemID = F.StockitemID
WHERE S.StockItemName LIKE ? OR S.StockItemID = ? OR S.SearchDetails LIKE ? OR F.Photo = S.StockItemID
GROUP BY S.StockItemID
ORDER BY S.StockItemID
LIMIT ? OFFSET ?";

//statements voor het verwerken van de query zoeken
$searchSQL = mysqli_prepare($connection, $searchQuery);
mysqli_stmt_bind_param($searchSQL, 'sssii', $search,$search2, $search, $limit, $offsetSQL);
mysqli_stmt_execute($searchSQL);
$result = mysqli_stmt_get_result($searchSQL);

//query voor het aantal producten op voorraad
$max ="SELECT COUNT(*) as maxitems FROM stockitems WHERE StockItemName LIKE ? OR StockItemID = ? OR SearchDetails LIKE ?";

//statements voor het verwerken van de query aantal producten
$maxSQL = mysqli_prepare($connection, $max);
mysqli_stmt_bind_param($maxSQL, 'sss', $search,$search2, $search);
mysqli_stmt_execute($maxSQL);
$resultmax = mysqli_stmt_get_result($maxSQL);

while ($rowmax = mysqli_fetch_array($resultmax, MYSQLI_ASSOC)){
    $maxitems = $rowmax["maxitems"];
}
$maxPages = $maxitems / $limit;
?>

<html>
<head></head>
<body>
<!-- De divjes voor de content en de header -->
<div id="header"></div>
<div id="content">
<?php
echo '<div id="header"></div>';
//laat zien op de pagina wat de resultaten zijn van de zoek query en verwerkt deze in variabelen
print("<h1>U heeft gezocht op: ".$search2. "</h1>");
if(!isset($_GET['zoeken']) && !isset($_SESSION["search"])){
    print("Vul iets in!");
}elseif(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $StockItemName = $row["StockItemName"];
        $StockItemID = $row["StockItemID"];
        $StockItemPrice = $row['UnitPrice'];
        $StockPhoto2 = $row['Photo'];
        $Picture = "<img src=\"$StockPhoto2\" />";
        Print('<div class="product"><a href="http://localhost/KBS_WWI/Frontend/WWI Website/Product.php?ProductID=' . $StockItemID . '">' . $Picture ."<p>" . $StockItemName . "</p><p class='price'> "."€". preg_replace('/\./', ',', $StockItemPrice) . "</p>".'</a></div>');
    }
}else {
    print("Geen resultaten");
}

?>

<div class="paging">

    <div class="paging">

<form action="Zoeken.php" method="GET">
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
    <button type="submit" value=25 name="aantal">25</button>
    <button type="submit" value=50 name="aantal">50</button>
    <button type="submit" value=100 name="aantal">100</button>

</form>
</div>

<div class="clearFloat" top="10px"></div>

</div>


<div class="clearFloat"></div>

<div id="footer"></div>
<!-- haalt de header en de footer op doormiddel van javascript -->
<script>
    $(function(){
        $("#header").load("header.php");

        $("#footer").load("footer.php");
    });
</script>
</body>
</html>