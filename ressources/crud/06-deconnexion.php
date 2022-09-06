<?php

require("../service/_isloggedV2.php");
islogged(true, "./05-connexion.php");
unset($_SESSION);
session_destroy();
setcookie("PHPSESSID", "", time()-3600);
header("location: ./05-connexion.php");
exit;
?>