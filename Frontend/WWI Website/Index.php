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
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">

            <div class="login"><h2>Login</h2>
                <label for="uname">Username:</label>
                <input type="text" placeholder="Enter Username" name="uname" id="uname" required/>
                <label for="psw">Password: </label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required/>
                <label for="submit"></label>
                <input class="submit" type="submit" value="inloggen" name="inloggen" id="submit"/>
            </div>
            <div class="register"><h2>Registreren</h2>
            </div>
        </div>

    </div>
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
<!-- Trigger/Open The Modal -->


<!-- The Modal -->





<br>

<!--<div style="text-align:center">-->
<!--    <span class="dot" onclick="currentSlide(1)"></span>-->
<!--    <span class="dot" onclick="currentSlide(2)"></span>-->
<!--    <span class="dot" onclick="currentSlide(3)"></span>-->
<!--</div>-->

<! -- Footer -->
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script  src="javascript/js.js"></script>
<script  src="javascript/jsPopup.js"></script>
</body>

</html>

