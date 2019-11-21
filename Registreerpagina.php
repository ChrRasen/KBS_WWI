<html>
<?php
include "DatabaseConnection.php";
//$registratie = $connection->prepare("INSERT INTO Klantgegevens(naam, tussenvoegsel, achternaam, email, wachtwoord, postcode, straatnaam, huisnummer, woonplaats) VALUES(?,?,?,?,?,?,?,?,?)");
//$prepRegistratie = mysqli_prepare($connection, $registratie);
//mysqli_stmt_bind_param($prepRegistratie, 'ssssss,', $naam, $tussenvoegsel, $achternaam, $email, $wachtwoord, $adres);
//mysqli_stmt_execute($prepRegistratie);
//$result = mysqli_stmt_get_result($prepRegistratie);
?>
<head>
</head>
<body>
<form action="Registreerpagina.php" method="post">
    Naam:  <input type="text" name="naam" value="Test"><br>
    Tussenvoegsel:  <input type="text" name="tussenvoegsel" value=""><br>
    Achternaam:  <input type="text" name="achternaam" value="test"><br>
    Email:  <input type="email" name="email" value="test@test.test"><br>
    Wachtwoord:  <input type="password" name="wachtwoord" value="test"><br>
    Wachtwoord conformatie:  <input type="password" name="wachtwoord2" value="test"><br>
    Postcode:  <input type="text" name="postcode" value="test"><br>
    Straatnaam:  <input type="text" name="straatnaam" value="test"><br>
    Huisnummer:  <input type="text" name="huisnummer" value="1"><br>
    Woonplaats:  <input type="text" name="woonplaats" value="test"><br>
    <input type="submit" name="submit" value="Registreer">
</form>

<?php
if(!isset($_POST['submit'])) {
    return FALSE;
}else {
    $naam = $_POST['naam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $postcode = $_POST['postcode'];
    $straatnaam = $_POST['straatnaam'];
    $huisnummer = $_POST['huisnummer'];
    $woonplaatst = $_POST['woonplaats'];
}

$controle = $connection->prepare("SELECT email FROM klantgegevens");

if(!isset($_POST['submit'])){
    return FALSE;
}elseif($_POST['email'] == $controle){
    print("Email address al in gebruik");
}elseif($_POST['naam'] == "" OR $_POST['achternaam'] == "" OR $_POST['email'] == "" OR $_POST['wachtwoord'] == "" OR $_POST['postcode'] == "" OR $_POST['straatnaam'] == "" OR $_POST['huisnummer'] == "" OR $_POST['straatnaam'] == ""){
    print("Naam, Achternaam, Email, Wachtwoord, Postcode, Straatnaam, Huisnummer en Woonplaats zijn allemaal verplicht");
}elseif($_POST['wachtwoord'] != $_POST['wachtwoord2']){
    print("Wachtwoorden komen niet overeen");
}else {
    print("Account is aangemaakt");
}

    $registratie = $connection->prepare("INSERT INTO Klantgegevens(naam, tussenvoegsel, achternaam, email, wachtwoord, postcode, straatnaam, huisnummer, woonplaats) VALUES(?,?,?,?,?,?,?,?,?)");
    $prepareSQL = mysqli_prepare($connection, $registratie);
    mysqli_stmt_bind_param($prepareSQL, 'sssssssss,', $naam, $tussenvoegsel, $achternaam, $email, $wachtwoord, $postcode, $straatnaam, $huisnummer, $straatnaam);
    mysqli_stmt_execute($prepareSQL);
    if(mysqli_stmt_affected_rows($prepareSQL) != 1){
        die("issue");
    }
    ?>

</body>
</html>