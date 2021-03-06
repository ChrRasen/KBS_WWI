<?php
session_start()
?>
<html>
<head>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="all" href="style\Stylesheet.css">
</head>
<body>
<header>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <div class="logo">
        <a class="active" href="#home"><img src="images/logo's/logoWWI.png" alt="WWI"></a>
    </div>
    <i class="fa fa-bars menu-toggle"></i>
    <ul class="nav">
        <li><a title="Wishlist" href="#"><i class="fas fa-heart"></i>
                Verlanglijst
            </a></li>
        <li><a title="Winkelwagen" href="#"><i class="fas fa-shopping-cart"></i>
                Winkelwagen
            </a></li>
        <li><a title="Inloggen" id=myBtn><i class="fas fa-user"></i>
                Inloggen
            </a></li>
    </ul>


    <nav class="search">
        <ul>
            <li>
                <div class="custom-select" style="width:200px;">
                    <select>
                        <option value="0">Select car:</option>
                        <option value="1">Audi</option>
                        <option value="2">BMW</option>
                    </select>
                </div>
            </li>
            <li>
                <div class="search-container">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </li>
        </ul>

</header>


<div class="content"></div>
<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="form">
        <form class="register-form" action="Test_index.php" method="post">
            <input type="text" name="naam" placeholder="voornaam"/>
            <input type="text" name="email" placeholder="email address"/>
            <input type="text" name="tussenvoegsel" placeholder="tussenvoegsel"><br>
            <input type="text" name="achternaam" placeholder="achternaam"><br>
            <input type="password" name="wachtwoord" placeholder="wachtwoord"/>
            <input type="password" name="wachtwoord2" placeholder="wachtwoord controleren"/>
            <input type="text" name="postcode" placeholder="postcode"/>
            <input type="text" name="straatnaam" placeholder="straatnaam"/>
            <input type="text" name="huisnummer" placeholder="huisnummer"/>
            <input type="text" name="woonplaats" placeholder="woonplaats"/>
            <button type="submit" name="submitr">create</button>
            <p class="message">Hebt u al een account? <a href="#">Login</a></p>
        </form>
        <form class="login-form" action="Test_index.php" method="post">
            <input type="text" name="emailadres" placeholder="email"/>
            <input type="password" name="wachtwoord" placeholder="wachtwoord"/>
            <button type="submit" name="submitl">login</button>
            <p class="message">Niet geregisteerd? <a href="#">Creëer een account</a></p>
        </form>
    </div>
</div>

<footer>
    <div class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h1 class="footer-text"><i class="fas fa-address-card"></i><span> Over ons</span></h1>
                <a class="footer-text" href="#Over ons">Wie zijn wij?</a>
                <a class="footer-text" href="#Over ons">Nieuws</a>
                <a class="footer-text" href="#Over ons">Werken bij WWI</a>

            </div>
            <div class="footer-section aVoorwaarden">
                <h1 class="footer-text"><i class="fas fa-link"></i><span> Links</span></h1>
                <a class="footer-text" href="Algemene voorwaarden">Algemene voorwaarden</a>
                <a class="footer-text" href="Cookies">Cookies</a>
            </div>
            <div class="footer-section contact">
                <h1 class="footer-text"><i class="fas fa-phone"></i><span> Service</span></h1>
                <a class="footer-text" href="#Klantenservice">Klantenservice</a>
                <a class="footer-text" href="#Klantenservice">Bezorging</a>
                <a class="footer-text" href="#Klantenservice">Retourneren</a>
                <a class="footer-text" href="#Klantenservice">Garantie</a>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; Wide World Importers
        </div>
    </div>
</footer>

<!-- Javascripts -->

<script  src="Frontend/WWI Website/javascript/js.js"></script>
<script  src="Frontend/WWI Website/javascript/jsPopup.js"></script>

<script>
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
</script>
<script>
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<?php
include('Registreerpagina.php');
include('Inlogpagina.php');
?>
</body>

</html>