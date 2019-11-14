<?php
session_start();
include "databaseConnection.php";
//zorgt er voor dat de juiste waardes er zijn
if(isset($_SESSION["offset"])){
    $offset = $_SESSION["offset"];
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
if(!isset($_GET["aantal"])){
    $limit = 25;
}else{
    $limit = $_GET["aantal"];
}
//zorgt er voor dat het de goede producten laat zien (0 tot 25 of 26 tot 50 etc.)
if(isset($_GET["pagina"])){
    if($_GET["pagina"] == "terug"){
        $offset = $offset -1;
    }else{
        $offset = $offset +1;
    }
}
$offsetSQL = $offset * $limit;

$offsetSQL = $limit * $offset;
$_SESSION["offset"] = $offset;
$_SESSION["CAT"] = $categorieNaam;
print($categorieNaam);
//$result = mysqli_query($connection, "SELECT * FROM stockitems");

//de sql query om de producten te laten zien
$categorie = "SELECT s.stockitemname, s.stockitemid
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
<body>
<br>
<?php
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $StockItemName = $row["stockitemname"];
    $StockID = $row["stockitemid"];
    echo '<a href="http://localhost/Project%20KBS/Product.php?ProductID='.$StockID.'">"'.$StockItemName.'"</a>';
    print("<br>");
}
?>
    <form action="Categorie.php" method="GET">
        <?php //zorgt er voor dat je niet terug kan wanneer je bij de eerste bent
        if($offset != 0){echo'
        <input type="submit" value="terug" name="pagina">
        ';} ?>
        <input type="submit" value=25 name="aantal">
        <input type="submit" value=50 name="aantal">
        <input type="submit" value=100 name="aantal">
        <input type="submit" value="volgende" name="pagina">
    </form>
</body>
</html>

