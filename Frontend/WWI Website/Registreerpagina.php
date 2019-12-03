<?php
include "DatabaseConnection.php";
?>

<?php
//kijkt of de website één maal is gesubmit en haalt dan de waarde email op zo niet geeft hij niks weer.
if(!isset($_POST['submitr'])){
    return false;
}else {
    $email = $_POST['email'];
}

// dit gaat na of de email gelijk is aan een email in de database en het zojuist ingevoerde email
$query = "SELECT * FROM  `klantgegevens`  WHERE `email`= ?";
$searchQuery = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($searchQuery, 's', $email);
mysqli_stmt_execute($searchQuery);
$result = mysqli_stmt_get_result($searchQuery);

    //kijkt of de website één maal is gesubmit en haalt dan de waardes op zo niet geeft hij niks weer.
if (mysqli_num_rows($result) > 0 ){
    print("Email address al in gebruik");
    die;
        //als het email address al in de database staat word deze error gegevens en stopt het script.
}elseif($_POST['naam'] == "" OR $_POST['achternaam'] == "" OR $_POST['email'] == "" OR $_POST['wachtwoord'] == "" OR $_POST['postcode'] == "" OR $_POST['straatnaam'] == "" OR $_POST['huisnummer'] == "" OR $_POST['straatnaam'] == ""){
    print("Naam, Achternaam, Email, Wachtwoord, Postcode, Straatnaam, Huisnummer en Woonplaats zijn allemaal verplicht");
    die;
    //als één van de gegevens niet is ingevuld word er een error gegeven dat de verplichte velden ingevuld moeten worden en stopt het script.
}elseif($_POST['wachtwoord'] != $_POST['wachtwoord2']){
    print("Wachtwoorden komen niet overeen");
    die;
    //Als wachtwoorden niet gelijk zijn aan elkaar krijg je een error en stopt het script.
}else{
    print("Account Aangemaakt");
}
    //Account is aangemaakt

$link = $connection;

/* check connection */
if (!$link) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//bekijkt wat er ingevuld moet worden met de gegevens variabelen
$stmt = mysqli_prepare($link, "INSERT INTO klantgegevens VALUES(?,?,?,?,?,?,?,?,?)");
mysqli_stmt_bind_param($stmt, 'sssssssis', $email, $naam, $tussenvoegsel, $achternaam, $hashed, $postcode, $straatnaam, $huisnummer, $woonplaatst);

$naam = $_POST['naam'];
$tussenvoegsel = $_POST['tussenvoegsel'];
$achternaam = $_POST['achternaam'];
$email = $_POST['email'];
$wachtwoord = $_POST['wachtwoord'];
$postcode = $_POST['postcode'];
$straatnaam = $_POST['straatnaam'];
$huisnummer = $_POST['huisnummer'];
$woonplaatst = $_POST['woonplaats'];

//Geeft een hash aan een ingevuld wachtwoord gebruikt SHA512(code)
$hashed = hash('sha512',$wachtwoord);

/* voert de prepared statement uit */
mysqli_stmt_execute($stmt);

/* Sluit de prepared statement af */
mysqli_stmt_close($stmt);

?>
