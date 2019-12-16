<html>

<body>
<div id="header"></div>
        <div id="content">


<?php
include "Index.php";
?>
            <div style="" class="paymentMethod">
                <div class="paymentHeader">
                    <ul>
                    <li>Winkelwagen</li>
                    <li>Betaalmethode</li>
                    </ul>
                </div>
                <input type="image" name="redirect" value="http://localhost/KBS_WWI/Frontend/WWI%20Website/Afgerondebetaling.php" src="images/Logo's/ideal.png" ">Ideal<br>
                <input type="image" name="redirect" value="http://localhost/KBS_WWI/Frontend/WWI%20Website/Afgerondebetaling.php" src="images/Logo's/paypal.png" ">Paypal<br>
                <input type="image" name="redirect" value="http://localhost/KBS_WWI/Frontend/WWI%20Website/Afgerondebetaling.php" src="images/Logo's/maestro.png" t">Maestro<br>

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            <script>
                $('input[type="image"]').on('click', function() {
                    window.location = $(this).val();
                });
            </script>

            </form>

            </div>
            </div>
        </div>
</div>


</div>

    </div>



<div class="clearFloat"></div>
<div id="footer"></div>
<script>
    $(function(){
        $("#header").load("header.php");

        $("#footer").load("footer.php");
    });
</script>
</body>
</html>
