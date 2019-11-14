<html>
<?php
include "DatabaseConnection.php";
$registratie = $connection->prepare("INSERT INTO gebruikers(naam, tussenvoegsel, achternaam, email, wachtwoord, adres) VALUES(?,?,?,?,?,?)");
$prepRegistratie = mysqli_prepare($connection, $registratie);
mysqli_stmt_bind_param($prepRegistratie, 'ssssss,', $naam, $tussenvoegsel, $achternaam, $email, $wachtwoord, $adres);
//mysqli_stmt_execute($prepRegistratie);
//$result = mysqli_stmt_get_result($prepRegistratie);
?>
<head>
</head>
<body>
<form action="Inlogpagina.php">
    Naam:      <input type="text" name="naam"><br>
    Tussenvoegsel: <input type="password" name="tussenvoegsel">
    Achternaam: <input type="password" name="achternaam">
    Email: <input type="password" name="email">
    Wachtwoord:<input type="password" name="wachtwoord">
    Wachtwoord conformatie: <input type="password" name="wachtwoord">
    adres: <input type="password" name="adres">
    <input type="submit" value="Registreer">


</body>
</html>



