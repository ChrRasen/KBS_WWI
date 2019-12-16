<?php
include "DatabaseConnection.php";
include "Index.php";

if(isset($_POST["Review"])) {
    $productID = $_POST["Review"];
}else{
    $productID = $_SESSION["ProductID"];
}
$email = $_SESSION["email"];
if(!isset($_SESSION["ProductID"])){
    $_SESSION["ProductID"] = $productID;
}

$stockItemDetails = mysqli_query($connection, "SELECT StockItemName, photo FROM stockitems WHERE StockItemID = $productID");
$resultStockItemDetails = mysqli_fetch_array($stockItemDetails);
$stockPhoto = $resultStockItemDetails['photo'];


$searchQuery2 = "SELECT Photo FROM foto WHERE StockitemID = ?";

$searchSQL2 = mysqli_prepare($connection, $searchQuery2);
mysqli_stmt_bind_param($searchSQL2, 's', $productID);
mysqli_stmt_execute($searchSQL2);
$result2 = mysqli_stmt_get_result($searchSQL2);
?>
<html>
<body>
<div id="header"></div>
<div id="content">
<br>


<div class="container">
    <?php
      echo'<h2 class="title is-primary">'.$resultStockItemDetails['StockItemName'].'</h2>';
    if(mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            $StockPhoto2 = $row["Photo"];
            print("<img src=\"$StockPhoto2\" style=\"width: 150px\"><br>");
            break;
        }
    }
      ?>
      <form method="post" action="Review.php">
        <div class="box">
          <label for="counter-input" class="label">Character count: <span id="counter-display" class="tag is-success">0</span>/255</label>
            <br>
          <textarea class="textarea" name="textarea" id="counter-input" maxlength="255" cols="75" rows="10" style="resize: none"></textarea>
            <br>
            <input type="radio" name="score" value="1"> 1
            <input type="radio" name="score" value="2"> 2
            <input type="radio" name="score" value="3"> 3
            <input type="radio" name="score" value="4"> 4
            <input type="radio" name="score" value="5"> 5
            <br>
            <button class="productButton" name="submit" type="submit" value="true">submit review</button>
        </div>
      </form>
    </div>
</div>

<?php
if(isset($_POST["submit"])) {
    $text = $_POST["textarea"];
    $score= $_POST["score"];
    if ($_POST["submit"] == true) {
        $stmt = mysqli_prepare($connection, "INSERT INTO review (Email, StockItemID, Score, Comentaar) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'siis', $email, $productID, $score, $text);
        $SQLreview = mysqli_stmt_execute($stmt);
        header('Location: http://localhost/KBS_WWI/Frontend/WWI%20Website/Product.php?ProductID='.$productID);
    }
}
?>

<!--telt hoeveel characters er in de input is gedaan en update het in html-->
<script>
(() => {
const counter = (() => {
const input = document.getElementById('counter-input'),
display = document.getElementById('counter-display'),
changeEvent = (evt) => display.innerHTML = evt.target.value.length,
getInput = () => input.value,
countEvent = () => input.addEventListener('keyup', changeEvent),
init = () => countEvent();

return {
init: init
}

})();

counter.init();

})();
</script>

<div class="clearFloat" top="10px"></div>
<div id="footer"></div>
<script>
    $(function(){
        $("#header").load("header.php");

        $("#footer").load("footer.php");
    });
</script>
</body>
</html>
