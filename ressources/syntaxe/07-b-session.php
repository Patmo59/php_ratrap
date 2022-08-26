<?php
$headerTitle = $title = "Session Page 2";
require("./ressources/template/_header.php");
/* Si on a besoin de la session que sur de rares pages, autant ne pas l'activer pour rien et faire
 la session start uniquement là où on en a besoin.
si la majorité de votre site a besoin de la session on peut lancer le session start dans un header 
il sera alors inclus dans toutes nos pages.

Generalement la session prend fin lorsque l'utilisateur ferme son navigateur. Mais il est possible
 d'augmenter sda duréee de vie */
 session_start(["cookie_lifetime" =>3600]); // 3600 secondes ( 0 par défaut)
 var_dump($_SESSION);
 echo "<hr>";
//  echo "<br>";
 /* Attention, la durée de vie d'un cookie n'est pas très précise ; le navigateur vérifie de tps en tps 
 si certains cookies sont trop vieux ; alors il les supprime.
 */
echo $_SESSION["username"] . " aime la "
    . $_SESSION["food"] . " et a "
    .$_SESSION["age"]. " ans ! <br>";
    /* Quand on utilise la session, il est plus propre de vérifier qu'elle existe bien avant de l'utiliser*/
    if(isset($_SESSION["username"],
            $_SESSION["food"],
            $_SESSION["age"]
    )) {
        echo $_SESSION["username"] . " aime la "
            . $_SESSION["food"] . " et a "
            .$_SESSION["age"]. " ans ! <br>";
    }
// Pour supprimer des informations on continuera de gerrer le tableau classiquement :
    unset($_SESSION["food"]);
    // POur supprimer la seesion en entier 
    session_destroy();
    // Cela dit , au rechargement il n'y aura certes plus rien, 
    //la supperglobal $-SESSION est tjrs utilisable jusque là !
var_dump($_SESSION);
//on pourra donc ajouter 
unset($_SESSION); // le cookie est tjrs présent et échangé avec le navigateur.
// il faudra lui donner une durée de vie négative
setcookie("PHPSESSID", "", time()-3600); // la date étant passée, le navigateur le supprimera aussi 

/* Quand on a plusieurs projets sous e meme nom de domaine on peut changer le nom de la session

pour cela on fera avant de démarrer la seesion start*/

session_name("usersession");
session_start();  // Dans le navigateur on verra l'apparition d'un nouveua cookie distinct
//qui différenciera les sessions.
$_SESSION["legume"] = "carottes";
echo "<br>";
var_dump($_SESSION);
?>


<hr>
<a href="./07-b-session.php">Page 2</a>
<a href="./07-a-session.php">Page 1</a>
<?php
require("./ressources/template/_footer.php");
?>