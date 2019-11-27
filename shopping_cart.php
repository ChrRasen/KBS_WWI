<html>

<body>
<?php
session_start();
$producten = array("Jelle", "Christian", "Andy");
if(isset ($_GET["erbij"])) {
    $producten = $_GET["erbij"];
}

$i = 0;
if(!isset($_GET[$i])) {
    $aantal = array(1,1,1);
}else{
    $n = 0;
    $aantal= array();
    foreach ($producten as $index){
        $aantal[$n] = $_GET[$n];
    }

}

foreach($producten as $index => $waarde){

    echo '<form action="shopping_cart.php" method="get">
    ' .$waarde.'
<input type="number" min="1" name='.$i.' value='.$aantal[$i].' class="calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>
    ';
    print($aantal[$i]);
    if(isset($_GET[$i])) {
        $hoeveelheid = $_GET[$i];
       // array_push($aantal, $hoeveelheid);
        $aantal[$i] = $hoeveelheid;
    }
    $i++;

}
print_r($aantal);

?>
<button type="submit" value="submit">kies</button>

</form>


<?php
$_SESSION["wwaantal"] = $aantal;
$_SESSION["wwproducten"] = $producten;
//wanneer butten gedrukt{
//   $aantal[0] = button;
//}


?>
</body>
</html>
