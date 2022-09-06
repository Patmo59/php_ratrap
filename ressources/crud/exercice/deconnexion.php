<?php

require("../../service/_isloggedV2.php");
islogged(true, "./connexion.php");
unset($_SESSION);
session_destroy();
setcookie("PHPSESSID", "", time()-3600);
header("location: ./connexion.php");
exit;
?>