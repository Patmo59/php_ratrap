<?php
$headerTitle = $title = "Session Page 1";
require("./ressources/template/_header.php");
session_start(); // pour manipuler la session il faut commencer par lancer avec session_start

/* Cette fonction commence une nouvelle session ou en récupère une qui existe déjà
 pour sasvoir si une session existe déjà  Php va regarder s'il
 y a un cookie au nom de la session, contenant un identifiant. Si non il va en créer un !
 un cookie est une information qui est transférée à chaque échange avec le serveur.
 le navigateur envoie les cookies au serveur et le szerveur les lui rend.
 si on a besoin de recuêrer l'identifiant de la session  on a au choix
 */
echo session_id(),"<br>";
var_dump($_COOKIE["PHPSESSID"]);
/* PAR DEFAUT LE NOM DE LA SESSION EST PHPSESSID on pourra choisir de modifier ce nom ( voir page 2)
Pour stocker ou récuperer la variable superglobal "$_SESSION"; elle n'est accessible qui'après une session_start();
cette variable est un tableau associatif classique.*/
$_SESSION["food"] = "pizza";
$_SESSION["age"] = 54;
$_SESSION["username"] = "Maurice";

?>
<hr>
<a href="./07-b-session.php">Page 2</a>
<?php
require("./ressources/template/_footer.php");
?>
