<?php
//connectie word gemaakt met de database
require_once "DatabaseConnection.php";

//er wordt gekeken of de gegevens kloppen
if(!isset($_POST['submitl'])){
    return false;
}else {
    $email = $_POST['emailadres'];
}

//als het emailadres niet klopt of niet in de database staat komt er een melding
if (empty($_POST["emailadres"])) {
    $emailadres_err = "Email of wachtwoord klopt niet.";
} else {
    $emailadres = $_POST["emailadres"];
}

//als het wachtwoord niet klopt of niet in de database staat komt er een melding
if (empty($_POST["wachtwoord"])) {
    $password_err = "Email of wachtwoord klopt niet.";
} else {
    $wachtwoord = $_POST["wachtwoord"];
//de gebruikte hash methode word benoemd om het wachtwoord uit de database te decrypten
    $wachtwoord = hash('sha512',$wachtwoord );
}

//doormiddel van een sql query word het email adres en wachtwoord uit de database gehaald
$sqlquery = "SELECT email,password FROM klantgegevens WHERE email = ? AND password = ?";
$searchQuery = mysqli_prepare($connection, $sqlquery);
mysqli_stmt_bind_param($searchQuery, 'ss',$emailadres ,$wachtwoord);
mysqli_stmt_execute($searchQuery);
$result = mysqli_stmt_get_result($searchQuery);

//als alles klopt word de sessie gestart en ben je ingelogd en er wordt doorverwezen naar de homepagina
if(!isset($_POST['submitl'])){
print("");
}else
    if(mysqli_num_rows($result) == 1){
        echo "<p align=center>Ingelogd u wordt doorverwezen.</p> ";
    $_SESSION["loggedin"] = true;
    $_SESSION["email"] = $emailadres;
}else{
        echo "<p align=center>Email of wachtwoord klopt niet.</p> ";
}
?>