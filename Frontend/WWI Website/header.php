<html>
<head>
    <?php include "./Index.php" ?>
<?php
if(empty($_SESSION["loggedin"])){
    print("");
    print("<script>  
//het herladen van de pagina wanneer je er voor het eerst komt.
//bron:https://stackoverflow.com/questions/41322317/how-to-automatically-reload-a-web-page
 (function () {
    if(window.location.href == \"http://localhost/KBS_WWI/Frontend/WWI%20Website/header.php\")
    {
        if (window.localStorage) {
            if (!localStorage.getItem('firstLoad')) {
                localStorage['firstLoad'] = true;
                window.location.reload();
            } else localStorage.removeItem('firstLoad');
        }
    }
})();
</script>");
    //voert script onderaan uit.
}elseif($_SESSION["loggedin"] == true){
    print("<BODY onLoad=\"autoChange()\">");
}else{
    print("<BODY>");
}
?>
</head>

<header>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <div class="logo">
        <a class="active" href="http://localhost/KBS_WWI/Frontend/WWI%20Website/Home.php"><img src="images/logo's/logoWWI.png" alt="WWI"></a>
    </div>
    <i class="fa fa-bars menu-toggle"></i>
    <ul class="nav">
        <li><a title="Wishlist" href="#"><i class="fas fa-heart"></i>
                Verlanglijst
            </a></li>
        <li><a title="Winkelwagen" href="http://localhost/KBS_WWI/Frontend/WWI%20Website/shopping_cart.php"><i class="fas fa-shopping-cart"></i>
                Winkelwagen
            </a></li>
        <?php
        if(empty($_SESSION["loggedin"])){
            print("<li><a title=\"Inloggen\" id=myBtn><i class=\"fas fa-user\"></i>
                Inloggen
            </a></li>");
        }else{
            print("<li><a title=\"Uitloggen\" href=\"http://localhost/KBS_WWI/Frontend/WWI%20Website/logout.php\" id='myBtn2'><i class=\"fas fa-user\"></i>
                Uitloggen
            </a></li>");
        }
        ?>
    </ul>


    <nav class="search">
        <ul>
            <li>
                <div class="dropdown">
                    <button class="dropbtn">Categorieën
                    </button>
                    <div class="dropdown-content">
                        <?php
                        $i=0;
                        $stockGroupName = mysqli_query($connection, "SELECT StockGroupName FROM stockgroups");
                        while($row = mysqli_fetch_array($stockGroupName, MYSQLI_ASSOC))
                        {
                            $cat = $row['StockGroupName'];
                            $cat = str_replace(' ', '+', $cat);
                            echo '<a href="http://localhost/KBS_WWI/Frontend/WWI Website/Categorie.php?CAT='.$cat.'">'.$row['StockGroupName'].'</a>';

                        }
                        ?>
                    </div>
                </div>
            </li>
            <li>
                <div class="search-container">
                    <form action="Zoeken.php">
                        <input type="text" placeholder="Zoeken.." name="zoeken">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
</header>



<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="form">
<!--    alle gegevens bij registeren en inloggen    -->
        <form  class="register-form" action="header.php" method="post">
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
        <form class="login-form" action="header.php" method="post">
            <input type="text" name="emailadres" placeholder="email"/>
            <input type="password" name="wachtwoord" placeholder="wachtwoord"/>
            <button type="submit" name="submitl">login</button>
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
    //Na het inloggen word je teruggestuurd naar de home pagina
    //Bron: https://stackoverflow.com/questions/15655073/settimeout-and-window-location-location-href-not-working
    function autoChange() {
        var timeID = setTimeout("location.href= './Home.php'", 1500)
    }


</script>
<?php
include('Registreerpagina.php');
include('Inlogpagina.php');
?>

</body>

</html>




















