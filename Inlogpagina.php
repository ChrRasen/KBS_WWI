<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

require_once "DatabaseConnection.php";

$emailadres = $wachtwoord = "";
$emailadres_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["emailadres"]))) {
        $emailadres_err = "Email of wachtwoord klopt niet.";
    } else {
        $emailadres = trim($_POST["emailadres"]);
    }

    if (empty(trim($_POST["wachtwoord"]))) {
        $password_err = "Email of wachtwoord klopt niet.";
    } else {
        $wachtwoord = trim($_POST["wachtwoord"]);
        $wachtwoord = hash('sha512',$wachtwoord );
    }

}
$sqlquery = "SELECT email,password FROM klantgegevens WHERE email = ? AND password = ?";
$searchQuery = mysqli_prepare($connection, $sqlquery);
mysqli_stmt_bind_param($searchQuery, 'ss',$emailadres ,$wachtwoord);
mysqli_stmt_execute($searchQuery);
$result = mysqli_stmt_get_result($searchQuery);

if(!isset($_POST['Inloggen'])){
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

<html>
<head>
    <link rel="stylesheet" type="text/css" href="stylesheet KBS.css">
</head>
<body >
<div class="center-text">
<h1>Inloggen</h1>
</div>
<form class="center-block" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
Emailadres: <input  type="text" name="emailadres"><br>
</div>
    <div >
Wachtwoord: <input type="password" name="wachtwoord"><br>
<input  type="submit" name="Inloggen" value="Inloggen">
</form>
</body>
</html>