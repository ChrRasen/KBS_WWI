<?php
session_start();
//huidige sessie word gedestroyed
session_destroy();
//word teruggestuurd naar home pagina zodat er bijvoorbeeld met een ander account kan worden ingelogd
header('Location: Home.php');
exit;
?>