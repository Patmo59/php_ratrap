<?php
session_start();
$title = "crud -READ";
$headerTitle = " liste utilisateurs";
require("../service/_pdo.php");
$pdo = connexionPDO();
/**
 * dansla requete qier je vais faire ici, i n'y a aucune entrée de l'utilisateur, donc pas besoin de preparer ma qequete
 * Je peux lancer directement ma requete avec "query"
 */
$sql = $pdo-> query("SELECT idUser,username FROM users");
/**
 * quand on souhaite récuperer plusieurs résultats on peut remplacer fetch par fetch all
 */
$users = $sql-> fetchAll();
$title = "CRUD -READ";
$headerTitle= "liste utilisateurs";
require("../template/_header.php");
/**
 * un flah message est un message qui doit s'afficher après une action 
 * , puis disparaitree unef ois la page actualisée ou changée.
 */
if(isset($_SESSION["flash"])){
    echo $_SESSION["flash"];
    unset($_SESSION["flash"]);
}
if($users):

?>
<table>
    <!-- thead>tr>(th{id})+(th>{username})+(th>{action}) -->
    <thead>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>action</th>
        </tr>
    </thead>

    <?php foreach($users as $row):?>
        <tr>
            <!-- tr>td*2+td>a*3 -->
            <td><?php echo $row["idUser"] ?></td>
            <td><?php echo $row["username"] ?></td>
            <td>
                <a href="./exercice/blog/read.php?id=<?php
                    echo $row["idUser"] ?>">Voir</a>
                <?php if(isset($_SESSION["idUser"]) && $_SESSION["idUser"] === $row["idUser"]): ?>
                    &nbsp;|&nbsp;
                <a href="./03-update.php?id=<?php
                    echo $row["idUser"] ?>">Editer</a>
                <a href="./04-delete.php?id=<?php echo $row["idUser"]?>"
                >Supprimer</a>
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
endif;
// var_dump($_SESSION);
require("../template/_footer.php");
?>
