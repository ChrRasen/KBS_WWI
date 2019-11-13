<?php
session_start();
include "databaseConnection.php";
//

if(isset($_GET["CAT"])){
    $categorieNaam = $_GET["CAT"];
}else{
    $categorieNaam = $_SESSION["CAT"];
}

if(!isset($_GET["aantal"])){
    $limit = 25;
}else{
    $limit = $_GET["aantal"];
}
$_SESSION["CAT"] = $categorieNaam;
print($categorieNaam);
//$result = mysqli_query($connection, "SELECT * FROM stockitems");

$categorie = "SELECT s.stockitemname, s.stockitemid
FROM stockitems S JOIN stockitemstockgroups SI
ON S.stockitemid = SI.StockItemID JOIN stockgroups SG
ON SI.StockGroupID = SG.StockGroupID
WHERE StockGroupName =?
LIMIT ?";

$statement = mysqli_prepare($connection, $categorie);
mysqli_stmt_bind_param($statement, 'si', $categorieNaam, $limit);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

?>
<html>
<body>
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
        <input type="submit" value=25 name="aantal">
        <input type="submit" value=50 name="aantal">
        <input type="submit" value=100 name="aantal">

    </form>
</body>
</html>



