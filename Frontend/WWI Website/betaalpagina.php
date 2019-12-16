<html>

<body>
<div id="header"></div>
        <div id="content">


<?php
include "Index.php";
?>
            <div style="text-align: center" class="paymentMethod">
                <div class="paymentHeader">
                    <ul>
                    <li style="display: inline">Winkelwagen</li>
                    <li style="display: inline">Betaalmethode</li>
                    </ul>
                </div>
            <input type="radio" name="redirect" value="http://localhost/KBS_WWI/Frontend/WWI%20Website/Afgerondebetaling.php">Ideal<br>
            <input type="radio" name="redirect" value="http://localhost/KBS_WWI/Frontend/WWI%20Website/Afgerondebetaling.php">Paypal<br>
            <input type="radio" name="redirect" value="http://localhost/KBS_WWI/Frontend/WWI%20Website/Afgerondebetaling.php">Maestro<br>

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            <script>
                $('input[type="radio"]').on('click', function() {
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
