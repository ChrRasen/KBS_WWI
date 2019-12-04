<html>
<head>

</head>
<body>
<div id="header"></div>
<div id="content"></div>
    <?php
    include "DatabaseConnection.php";
    include "Index.php";
    ?>
    <br>
    <font size="10"><center>Betaling succesvol<br></center></font>
    <br>
    <br>
<form action="Home.php" method="post">
    <div style="width: 100%;text-align:center;">
        <input type="submit" name="winkel" value="Klik hier om verder te gaan met winkelen"/>
    </div>
</form>
    <?php
    unset($_SESSION["Ses_producten"]);
    ?>
    <br>
    <center><img src="Project/Afgerond.jpg" alt="Afgerond"  height="500" width="500"></center>
    <br>
    <br>
<div id="footer"></div>
<script>
    $(function(){
        $("#header").load("header.php");

        $("#footer").load("footer.php");
    });
</script>
</body>
</html>