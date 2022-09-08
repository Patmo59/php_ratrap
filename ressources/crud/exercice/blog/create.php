<?php 
    /*
        1. Cette page n'est accessible que si on est connecté.*/
       // 2. Traite le formulaire de nouveau message puis redirige vers la page read.php
       // 3. Ajout de flash message en session.

$title  = " BLOG - Créer un message";
$headerTitle = "Ecrire un message";
require "../../../template/_header.php" ;

?>

<form action="" method="post">
 
    <label for="message">Message</label>
    <textarea name="" id="textarea" cols="30" rows="10" required></textarea>
    <span class="error"><?php echo $error["message"]??"" ?></span>

    <input type="submit" value="Envoi" name="envoi">
</form>

<?php
require "../../../template/_footer.php";
?>