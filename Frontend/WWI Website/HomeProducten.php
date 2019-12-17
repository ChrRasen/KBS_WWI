<html>
<head>
    <link rel="stylesheet" type="text/css" media="all" href="style/stylesheet.css">
</head>
</html>
<?php

//haalt de producten op voor de home pagina doormiddel van query + random getal tussen 1 en 227.

for($i = 0 ; $i < 3; $i++){
    $search = rand(1,227);
    $searchQuery = "SELECT S.StockItemID,S.SearchDetails,S.StockItemName,S.UnitPrice,F.Photo FROM stockitems S
    JOIN foto F ON S.StockitemID = F.StockitemID
    WHERE S.StockItemID = $search";

    $searchSQL = mysqli_prepare($connection, $searchQuery);
    mysqli_stmt_execute($searchSQL);
    $result = mysqli_stmt_get_result($searchSQL);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $StockItemName = $row["StockItemName"];
    $StockItemID = $row["StockItemID"];
    $StockItemPrice = $row['UnitPrice'];
    $StockPhoto2 = $row['Photo'];
    $Picture = "<img src=\"$StockPhoto2\" />";
    Print('<div class="productHome"><a href="http://localhost/KBS_WWI/Frontend/WWI Website/Product.php?ProductID=' . $StockItemID . '">' . $Picture ."<p>" . $StockItemName . "</p><p class='price'> " ."€". preg_replace('/\./', ',',  $StockItemPrice) . "</p>".'</a></div>');
}

?>