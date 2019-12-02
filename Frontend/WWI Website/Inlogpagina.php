<?php
require_once "DatabaseConnection.php";

if(!isset($_POST['submitl'])){
    return false;
}else {
    $email = $_POST['emailadres'];
}

if (empty($_POST["emailadres"])) {
    $emailadres_err = "Email of wachtwoord klopt niet.";
} else {
    $emailadres = $_POST["emailadres"];
}

if (empty($_POST["wachtwoord"])) {
    $password_err = "Email of wachtwoord klopt niet.";
} else {
    $wachtwoord = $_POST["wachtwoord"];
    $wachtwoord = hash('sha512',$wachtwoord );
}

$sqlquery = "SELECT email,password FROM klantgegevens WHERE email = ? AND password = ?";
$searchQuery = mysqli_prepare($connection, $sqlquery);
mysqli_stmt_bind_param($searchQuery, 'ss',$emailadres ,$wachtwoord);
mysqli_stmt_execute($searchQuery);
$result = mysqli_stmt_get_result($searchQuery);

if(!isset($_POST['submitl'])){
print("");
}else
    if(mysqli_num_rows($result) == 1){
    print("Ingelogd");
    $_SESSION["loggedin"] = true;
    $_SESSION["email"] = $emailadres;
}else{
    print("Email of wachtwoord klopt niet.");
}
?>