<html>
<head>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="all" href="style/Stylesheet.css">
</head>
<body>

<div id="header"></div>
<! -- Slideshow -->
<div class="content">
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


<div class="row">
    <div class="row-1">Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo</div>
    <div class="row-2">Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo</div>
    <div class="row-3">Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo</div>
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