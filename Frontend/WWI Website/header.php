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
        <form  class="register-form">
            <input type="text" placeholder="voornaam"/>
            <input type="password" placeholder="wachtwoord"/>
            <input type="password" placeholder="wachtwoord controleren"/>
            <input type="text" placeholder="email address"/>
            <input type="text" placeholder="postcode"/>
            <input type="text" placeholder="straatnaam"/>
            <input type="text" placeholder="huisnummer"/>
            <input type="text" placeholder="woonplaats"/>
            <button>create</button>
            <p class="message">Hebt u al een account? <a href="#">Login</a></p>
        </form>
        <form class="login-form">
            <input type="text" placeholder="email"/>
            <input type="password" placeholder="wachtwoord"/>
            <button>login</button>
            <p class="message">Niet geregisteerd? <a href="#">Creëer een account</a></p>
        </form>
    </div>
</div>
<!-- Javascripts -->

<script  src="javascript/js.js"></script>
<script  src="javascript/jsPopup.js"></script>

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
</body>

</html>

