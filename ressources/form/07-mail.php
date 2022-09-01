<?php
$title = " Email ";
$headerTitle = "Courriel";
require("../template/_header.php");
if(!empty($envoi)):
?>
<p>
    <?php echo $envoi?>
</p>
<?php endif?>

<form action="" method="post">
    <input type="email" name="email" placeholder="Votre Email">
    <span class="error"><?php echo $error["email"]??""?></span>
    <br>
    <input type="text" name="sujet" id="Sujet du massage">
    <span class="error"><?php echo $error["sujet"]??""?></span>
    <br>
    <textarea name="corps" placeholder="Votre message" cols="30" rows="10"></textarea>
    <span class="error"><?php echo $error["corps"]??""?></span>
    <div>
        <label for="captcha">Veuillez recopier le texte ci dessous pour valider :</label>
        <br>
        <img src="../service/_captcha.php" alt="CAPTCHA">
        <input type="text" id="captcha" pattern="[A-Z0-9]"{6}>
    </div>
    <input type="submit" value="Envoyer" name="contact">
</form>

<?php
require("../template/_footer.php");
?>