<html>

<body>
<?php
session_start();
$aantal = array();
$producten = array("Jelle", "Christian", "Andy");
if(isset ($_GET["erbij"])) {
    $producten = $_GET["erbij"];
}
$i = 0;
$hoeveelheid = array();


foreach($producten as $index => $waarde){

    echo '<form action="shopping_cart.php" method="get">
    ' .$waarde.'
<input type="number" min="1" name="'.$i.'" value="1" class="calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>
    <button type="submit" value="submit">kies</button>
    
    </form>';
    if(isset($_GET[$i])) {
        $hoeveelheid[$i] = $_GET[$i];
        array_push($aantal, $hoeveelheid);
        //$aantal = array_replace($aantal ,$hoeveelheid);
  //  }
    $i++;

}
print_r($aantal);





$_SESSION["wwaantal"] = $aantal;
$_SESSION["wwproducten"] = $producten;
//wanneer butten gedrukt{
//   $aantal[0] = button;
//}






?>
</body>
</html>
