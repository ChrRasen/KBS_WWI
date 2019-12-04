<?php
$productID = $_POST["Review"];
include "Index.php"
?>
<html>
<body>
<div id="header"></div>
<div id="content">
<br>

<div class="container">
      <h1 class="title is-primary">Enter text:</h1>
      <form>
        <div class="box">
          <label for="counter-input" class="label">Character count: <span id="counter-display" class="tag is-success">0</span></label>
            <br>
          <textarea class="textarea" name="textarea" id="counter-input" maxlength="255" cols="75" rows="10" style="resize: none"></textarea>
        </div>
      </form>
    </div>
</div>
<!--telt hoeveel characters er in de input is gedaan en update het in html-->
<script>
(() => {
const counter = (() => {
const input = document.getElementById('counter-input'),
display = document.getElementById('counter-display'),
changeEvent = (evt) => display.innerHTML = evt.target.value.length,
getInput = () => input.value,
countEvent = () => input.addEventListener('keyup', changeEvent),
init = () => countEvent();

return {
init: init
}

})();

counter.init();

})();
</script>



<div class="clearFloat" top="10px"></div>
<div id="footer"></div>
<script>
    $(function(){
        $("#header").load("header.php");

        $("#footer").load("footer.php");
    });
</script>
</body>
</html>