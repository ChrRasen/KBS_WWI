<?php
include "databaseConnection.php";
$search = "%" . $_GET['zoeken'] . "%";
$search2 = $_GET['zoeken'];
$searchQuery = "SELECT * FROM stockitems WHERE StockItemName LIKE ? OR StockItemID = ? OR SearchDetails LIKE ?";

$searchSQL = mysqli_prepare($connection, $searchQuery);
mysqli_stmt_bind_param($searchSQL, 'sss', $search,$search2, $search);
mysqli_stmt_execute($searchSQL);
$result = mysqli_stmt_get_result($searchSQL);
?>

<html>
<head></head>
<style>
    img {
        width:150px;
    }
</style>
<body>
<?php
if( $_GET['zoeken'] == ""){
    print("Vul iets in!");
}elseif(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $StockItemName = $row["StockItemName"];
        $StockItemID = $row["StockItemID"];
        $StockItemPrice = $row['UnitPrice'];
        $StockPhoto = '<img src="data:image/jpg;base64,' . $row['Photo'] . '">';
        Print('<a href="http://localhost/KBS_WWI/Product.php?ProductID=' . $StockItemID . '">' . $StockPhoto. '<br>' .$StockItemName . "<br> " . $StockItemPrice . "<br>". '</a><br>');
    }
}else {
    print("Geen resultaten");
}
?>
</body>
</html>