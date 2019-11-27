<html>

<body>
<?php
session_start();
$aantal = array();
$producten = array("Jelle", "Christian", "Andy");
if(isset ($_POST["erbij"])) {
    $producten = $_POST["erbij"];
}
$i = 0;



foreach($producten as $index => $waarde){

    echo '<form action="shopping_cart.php" method="post">
    ' .$waarde.'
<input type="number" min="1" name="hoeveelheid" value="1" id="'.$i.'" class="calculator-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></div>
    <button type="submit" value="submit">kies</button>
    
    </form>';
    if(isset($_POST["hoeveelheid"])) {
        $hoeveelheid = $_POST["hoeveelheid"];
       // array_push($aantal, $hoeveelheid);
        $aantal[$i] = $hoeveelheid;
    }
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
