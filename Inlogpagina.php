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
        $emailadres_err = "Please enter email.";
    } else {
        $emailadres = trim($_POST["emailadres"]);
    }

    if (empty(trim($_POST["wachtwoord"]))) {
        $password_err = "Please enter your password.";
    } else {
        $wachtwoord = trim($_POST["wachtwoord"]);
    }

    if (empty($emailadres_err) && empty($password_err)) {

        $sql = "SELECT email, wachtwoord FROM klantgegevens WHERE email = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_emailadres);

            $param_emailadres = $emailadres;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $emailadres, $hashed);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($wachtwoord, $hashed)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["email"] = $emailadres;

                            header("location: index.php");
                        } else {
                            $password_err = "The password or emailadress you entered was not valid.";
                        }
                        mysqli_stmt_close($stmt);
                    }

                    mysqli_close($connection);
                }
            }
        }
    }
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
    <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
Emailadres: <input  type="text" name="emailadres"><br>
    <span <?php echo $emailadres_err; ?>>
    </span>
</div>
    <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
        <span <?php echo $password_err; ?>>
        </span>
Wachtwoord: <input type="password" name="wachtwoord"><br>
<input  type="submit" value="Inloggen">
</form>
</body>
</html>