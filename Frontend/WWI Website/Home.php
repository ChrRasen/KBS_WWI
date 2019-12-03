<html>
<head>

<?php include "index.php" ?>
</head>
<body>

<div id="header"></div>
<! -- Slideshow -->
<div id="content">
<div class="slideshow-container">
    <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="images/Slideshow/1.jpg" style="width:100%">
        <div class="text">Black friday deals!</div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="images/Slideshow/2.jpg"  style="width:100%">
        <div class="text">2 halen 1 betalen!</div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="images/Slideshow/3.jpg"  style="width:100%">
        <div class="text">Vandaag besteld morgen in huis!</div>
    </div>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

<div class="content">
<div class="row">
    <div class="row-1"><h2>Eerder bekeken</h2><?php
        include "HomeProducten.php";
        ?></div>
    <div class="row-2"><h2>Aandachtstrekkers</h2><?php
        include "HomeProducten.php";
        ?></div>
    <div class="row-3"><h2>Aanbiedingen</h2><?php
        include "HomeProducten.php";
        ?>
    </div>
</div>

    <div class="clearFloat"></div>
</div>
</div>
<div id="footer"></div>




<!-- Javascripts -->
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
</script>
<script>
    $(function(){
        $("#header").load("header.php");

        $("#footer").load("footer.php");
    });
</script>

</body>
</html>