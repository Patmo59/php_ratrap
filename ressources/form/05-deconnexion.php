<?php
/**
 * Cette page ne devrait être accessible qu'à u utilisateur connecté
 * Bloquer l'accès à une page aux gens non connectés est une action que l'on va souvent repetr. 
 * Plutot que de réécrire le meme code à chq fois, autant faire un fichier "is_logged.php" qu'on va inclure
 */

require("../service/_islogged.php");
unset($_SESSION);
session_destroy();
setcookie("PHPSESSID", "", time()-3600);
/** Notre connexion étant gérée par la session, pour se déconnecter, il suffit de détruire la session.
 * puis on redirigera notre utilisateur
 */
header("location: ./04-connexion.php");
exit;
?>