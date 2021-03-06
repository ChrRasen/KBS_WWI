<html>
<head>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="all" href="style\Stylesheet.css">
    <link rel="stylesheet" type="text/css" media="all" href="style\StylesheetCAT.css">

    <?php
    session_start();
    if(isset($_SESSION["aantal"])) {
        unset($_SESSION["aantal"]);
    }
    if(isset($_SESSION["offset"])){
        unset($_SESSION["offset"]);
    }
    include "databaseConnection.php"
    ?>
</head>
<body>


<!-- Javascripts -->
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
</script>


<script  src="javascript/js.js"></script>
<script  src="javascript/jsPopup.js"></script>


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

