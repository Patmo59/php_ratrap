<?php
/** Une des attaques les plus commuens est l'attaque "XSS"
 * (Cross-Site-Scripting). Elle consiste à executer un scripot venant d'une source externe à votre site.
 * La meilleure façon de s'en proteger est :
 * !"Don't trust users !"
 * on s'en est déjà protegeé grace à l'assainissement des entrées de l'utilisateur( htmlspecialchars et
 * autres).
 */
require("../service/_islogged.php");
$error = $password ="";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hash"])){
    if(empty($_POST["hash"])){
        $error = "Veuillez entrer un mot de passe";
    }else{
        /**Le mot de passe n'ayant poas à etre affiché et enore moins en clair, 
         * on n'a pas besoin d'assainir le string. Mais on utilisera qd mm 
         * 1.PASSWORD_DEFAULT
         * 2.PASSWORD_BCRYPT
         * 3.PASSWORD_ARGON2I
         * 4.PASSWORD_ARGON2ID
         * Ce sont des constantes representant des algorythme de hachages 
         * 1. est une valeur qui peut evoluer dans le temps.Actuellment (8.1) est egal a 2., mais
         * si un meilleur algorythme de tri est ajouté à PHP, alors DEFAULT pourra évoluer
         * et changer d'algorythme.
         * en 3ème argument, on, pêut ajouter des options aus algorythme de tri. 
         * Par exempkle pour bcryt o peut ajouter un "coût (cost) qui peut augmenter la 
         * sécurité au cout d'une durée de hachage plus longue (par defaut ce cout vaut 10).
         * $password = password_hash($password, PASSWORD_BCRYPT,["cost"= =>20];
         * 
         */
        $password = trim($_POST["password"]);
        /**Password hash permet de hacher le mdp donné en 1er argumt.
         * En 2 argumt, on va donner une constante prédéfiniee dans php au choix entre 
         */
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    /** Le 2ème point à gérer sont les attaques par "BRUTE FORCE" ; cela consiste à 
     * tenter toutes les combinaisons email-mdp possibles pour trouver un compte avec lequel
     *  se connecter on pourra ignorer les attaques manuelles où l'utilisateur 
     *  prendra des jours, voir des mois pour en trouver un de bon
     *  Le probleme vient des "bots" qui pourront faire plusieurs dizaine de tentaives par seconde.
     * Pour se proteger de ce type d'attaque, plusieurs solutions:
     *    1. Bloquer l'utilisateur après x tentatives et cela jusqu'au reset de son mdp ; 
     *       pb : Quelqu'un d'honnete pais maladroit pourrait être agacé. 
     *       le malveillant pourrait s'amuser à bloquer tous vos utilisateur.
     *    2. Ajout d'un "CAPTCHA3 (completely Automated Public Turing test to 
     *      tell Computer and Human Apart).
     *    *          Le principe d'un CAPTCHA est de forcer l'utilisateur à faire 
     *          ne action qu'un bot ne pourrait pas ou difficilement réaliser
     *    3. L'ajout d'une authentification à double facteur ; Cela consite à avoir en plus du mdp habituel,
     *       un code temporaire généré et envoyé via une application par email ou <sms></sms>
     *      Ici nous allons implémenter un petit CAPTCHA fait main, mais pour ceux qui veulent
     *       aller plus loin, voici le lien vers la documentations de Google :
     *          https://developpers.google.com/recaptcha/docs/v3  */

     if(!isset($_POST["captcha"], $_SESSION["captchaStr"]) || $_POST["captcha"] != $_SESSION["captchaStr"]){
        $error = "Captcha incorrecte";
     }
}
$title = " Security ";
$headerTitle = "Sécutité";
require("../template/_header.php");
?>
<h1>Bienvenue 
    <h2>Saisissez votre mdp à crypter</h2>
    <?php echo $_SESSION["username"] ?></h1>

<form action="" method="POST">
<input type="text" name="password"
    placeholder="Mot de passe à Hacher" required>
    <!-- Début de Captcha-->
    <div>
        <label for=""captcha">Veuillez recopier le texte ci dessous 
        pour valider : </label><br>
        <img src="../service/_captcha.php" alt="CAPTCHA"><br>
        <input type="text" id="captcha" name="captcha" pattern="[A-Z0-9]{6}">
    </div>
    <!-- Fin de Captcha-->

<input type="submit" value="Hacher" name="hash">
<span class="error"><?php echo $error ?? ""?> </span>

</form>
<!--on est ici sur un outils pour développeur, donc on se permet d'afficher le mot de passe haché, mais evidemmmnet
dans la réalité on n'affiche rien ni en clair ni en haché-->
<?php if(empty($error) && !empty($password)): ?>
    <div><br>
        Votre mot de passe haché est :<br><br>
        <?php echo $password?>
    </div>
<?php
endif;
require("../template/_footer.php");
?>