<?php 
/* si aucun utilisateur n'est selectionné renvoi la pages liste utilisteur je redirige vers la liste des utlisateurs*/

if(!isset( $_GET["id"]) == true){
    header("location: ../../03-update.php"); 
    exit;
}
    
/* 
1. Ne venir ici que si un utilisateur a été selectionné en GET.
        2. Afficher tous les messages de l'utilisateur avec un message indiquant si il n'y en a aucun.

        3. Si on est sur la page de l'utilisateur connecté, afficher un bouton effacer et un bouton modifier 
        à côté de chaque message de l'utilisateur.
        4. Toujours si c'est la page de l'utilisateur connecté, afficher un formulaire permettant de poster 
        de nouveaux messages. qui redirigera vers la page create.
        5. vérifie si il y a un flash message en session, l'affiche puis le supprime.
        */
session_start();
$title = " Blog - Read";
$headerTitle= " Liste des messages";
require "../../../service/_pdo.php";
$pdo = connexionPDO();
//  création de la requete pour extraire tous les messages de l'user ou l'id de user = la valeur de l'id
// du lien sur lequel je click. [$sql = $pdo ->query("SELECT idMessage, message,createdAt,idUser FROM messages WHERE idUser =  $_GET["id"]");]
// pour la securite  je tranforme ma requete en requete préparée comme ci dessous

$sql = $pdo -> prepare("SELECT idMessage, message,createdAt,idUser FROM messages WHERE idUser = :us");// ! IMPORTANT !
$sql->execute([
    "us"=> $_GET["id"]
]);

$sql1 = $pdo -> prepare("SELECT idUser, username FROM users WHERE idUser = :us");
$sql1->execute([
    "us"=> $_GET["id"]
]);
// Definition de la variable Messages
$messages = $sql -> fetchAll();
$users = $sql1 -> fetch();
$title = " Blog - Read";
$headerTitle= " Liste des messages";
require("../../../template/_header.php");

if(isset($_SESSION["flash"])){
    echo $_SESSION["flash"];
    unset($_SESSION["flash"]);
}
if($messages):// si undefined variable c'est que je n'ai pas défini ce
    // qu'elle devait contenir a savoir une requete avec un fetch
if($users):

?>
    <h3><?php echo $users["username"] ?><h3> <!--pour afficher username je dois 
                créer une deuxième requete sql et dans la mesure ou je ne cherche 
                qu'un seul element, j'utilise fetch() qui va m'afficher que le 
                premier element du tableau associatif-->

<table>
    <thead>
        <tr>
            <th>idMessage</th>
            <th>message</th>
            <th>createdAt</th>
            <th></th> <!-- correspond à la colonne contenant les boutons-->
        </tr>
    </thead>
    <?php foreach($messages as $row):?>


        <tr>
            <td><?php echo $row["idMessage"] ?></td>
            <td><?php echo $row["message"] ?></td>
            <td><?php echo $row["createdAt"] ?></td>
    
            <td>
                &nbsp;|&nbsp;
                <a href="./update.php?id=<?php echo $row["idMessage"] ?>"> Modifier</a>
                <!-- Si je suis connetcé afficher aussi Editer et Supprimer -->
                <?php if(isset($_SESSION["idUser"]) && $_SESSION["idUser"] === $row["idUser"]): ?>
                    <!-- &nbsp;|&nbsp;
                    <a href="../03-update.php"?id=<?php  // TODO 
                        echo $row["idUser"] ?>">Editer</a> -->
                        &nbsp;|&nbsp;
                    <a href="../blog/delete.php?id=<?php echo $row["idMessage"]?>" 
                    >Supprimer</a>
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
endif;
endif;
require "../../../template/_footer.php";


?>