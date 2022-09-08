<?php 
    /*
        1. Cette page n'est accessible que si on est connecté et que le message selectionné appartient 
            bien à l'utilisateur connecté. 
        2. Traite la suppression puis redirige vers la page read.php
        3. Ajout de flash message en session.
    */
 
    require "../../../service/_isloggedV2.php"; 
    isLogged(true, "./05-connexion.php");
    
    if(empty($_GET["id"])){
        header("Location: ../blog/read.php"); 
        exit;
    }
    require "../../../service/_pdo.php"; 
    $pdo = connexionPDO();
    $sql = $pdo->prepare("DELETE FROM messages WHERE idMessage=?");
    $sql->execute([(int)$_GET["id"]]);
    //on deconnecte l'utilisateur
    // unset($_SESSION);
    // session_destroy();
    // setcookie("PHPSESSID", "" , time()-3600);
    //avant de le rediriger on lui affiche un petit message
    header("refresh: 30; url =../blog/read.php  "); 
    $title = "CRUD- Delete";
    $headerTitle = "Suppression d'utilisateur";
    require "../../../template/_header.php";
    //rowCount permet de savoir combien de lignes ont été effacées par la drnière requete
    echo  $sql-> rowCount(), "ligne (s) effacée(s)";
    ?>
    <p>Vous avez bien <br> <strong>supprimé</strong><br> <?php echo  $sql-> rowCount() ?> ligne.
    vous allez être redirigé d'ici peu
    </p>
    <?php 
    require "../../../template/_footer.php"; 
?>

