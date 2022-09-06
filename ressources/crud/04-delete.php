<?php
require "../service/_isloggedV2.php";
isLogged(true, "./05-connexion.php");

if(empty($_GET["id"]) || $_SESSION["idUser"] != $_GET["id"]){
    header("Location: ./02-read.php");
    exit;
}
require "../service/_pdo.php";
$pdo = connexionPDO();
$sql = $pdo->prepare("DELETE FROM users WHERE idUser=?");
$sql->execute([(int)$_GET["id"]]);
//on deconnecte l'utilisateur
unset($_SESSION);
session_destroy();
setcookie("PHPSESSID", "" , time()-3600);
//avant de le rediriger on lui affiche un petit message
header("refresh: 5; url =  /");
$title = "CRUD- Delete";
$headerTitle = "Suppression d'utilisateur";
require "../template/_header.php";
//rowCount permet de savoir combien de lignes ont été effacées par la drnière requete
echo  $sql-> rowCount(), "ligne (s) effacée(s)";
?>
<p>Vous avez bien <strong>supprimé</strong> votre compte .
vous allez être redirigé d'ici peu
</p>
<?php 
require "../template/_footer.php";