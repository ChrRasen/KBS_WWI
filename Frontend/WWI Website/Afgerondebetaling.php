<html>
<head>

</head>
<body>
<div id="header"></div>
<div class="content">
    <?php
    include "DatabaseConnection.php";
    include "Index.php";
    ?>
    <br>
<!--  laat de betaling succesvol text zien  -->
    <font size="10"><center>Betaling succesvol<br></center></font>
    <br>
    <br>
<!--  geeft de knop weer om terug naar home te gaan  -->
<form action="Home.php" method="post">
    <div style="width: 100%;text-align:center;">
        <input type="submit" class="productButton"  name="winkel" value="Klik hier om door te gaan"/>
    </div>
</form>
    <?php
    //verwijderd product pagina
    unset($_SESSION["Ses_producten"]);
    ?>
    <br>
<!--  plaatje van afgerond  -->
    <center><img src="Project/Afgerond.jpg" alt="Afgerond"  height="450" width="450"></center>
    <br>
    <br>
</div>
<div class="clearFloat"></div>
<div id="footer"></div>
<script>
//    Javascript die header en footer ophaald.
    $(function(){
        $("#header").load("header.php");

        $("#footer").load("footer.php");
    });
</script>

</body>
</html>