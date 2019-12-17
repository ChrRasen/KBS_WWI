<html>

<body>
<div id="header"></div>
        <div class="content">


<?php
include "Index.php";
?>
            <div class="paymentMethod">
                <div class="paymentHeader">
                    <ul>
                        <li style="color: black "><a href="http://localhost/KBS_WWI/Frontend/WWI%20Website/shopping_cart.php">Winkelwagen</a></li>
                    <li style="color: white; background-color: #62b4cf">Betaalmethode</li>
                        <li style="color: black;">Order review</li>
                    </ul>
                </div>
                <input type="image" name="redirect" value="http://localhost/KBS_WWI/Frontend/WWI%20Website/Afgerondebetaling.php" src="images/Logo's/ideal.png" alt="submit" ">
                <input type="image" name="redirect" value="http://localhost/KBS_WWI/Frontend/WWI%20Website/Afgerondebetaling.php" src="images/Logo's/paypal.png"alt="submit"  ">
                <input type="image" name="redirect" value="http://localhost/KBS_WWI/Frontend/WWI%20Website/Afgerondebetaling.php" src="images/Logo's/maestro.png"alt="submit"style="
    margin-bottom: 30  ">

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
    //    Javascript die header en footer ophaald.
    $(function(){
        $("#header").load("header.php");

        $("#footer").load("footer.php");
    });
</script>
</body>
</html>
