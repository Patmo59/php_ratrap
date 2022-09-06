<?php
/** Une des attaques les plus communes est l'attaque "XSS"
 * (Cross-Site-Scripting). Elle consiste à executer un script
 *  venant d'une source externe à votre site.
 * La meilleure façon de s'en proteger est :
 * !"Don't trust users !"
 * on s'en est déjà protegé grace à l'assainissement des entrées
 *  de l'utilisateur( htmlspecialchars et autres).
 */
require("../service/_isloggedV2.php");
// j'inclus mon fichier csrf
require("../service/_csrf.php");
$error = $password ="";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hash"])){
    if(empty($_POST["hash"])){
        $error = "Veuillez entrer un mot de passe";
    }else{
        /**Le mot de passe n'ayant pas à etre affiché et enore moins en clair, 
         * on n'a pas besoin d'assainir le string. Mais on utilisera qd même 
         * 1.PASSWORD_DEFAULT
         * 2.PASSWORD_BCRYPT
         * 3.PASSWORD_ARGON2I
         * 4.PASSWORD_ARGON2ID
         * Ce sont des constantes representant des algorythmee de hachage 
         *  1. est une valeur qui peut evoluer dans le temps.
         * Actuellement (8.1) est egal a PASSWORD_BCRYPT., mais si un meilleur algorythme
         * de tri est ajouté à PHP, alors DEFAULT pourra évoluer
         * et changer d'algorythme.
         * en 3ème argument, on peut ajouter des options aux algorythmes de tri. 
         * Par exemple pour BCRYPT on peut ajouter un "coût" (cost) 
         * qui peut augmenter la sécurité au cout d'une durée de hachage
         * plus longue (par defaut ce cout vaut 10).
         * $password = password_hash($password, PASSWORD_BCRYPT,["cost"= =>20];
         */
        $password = trim($_POST["password"]);
        /**Password hash permet de hacher le mdp donné en 1er argumt.
         * En 2 argumt, on va donner une constante prédéfinie dans php 
         * au choix entre 
         */
        $password = password_hash($password, PASSWORD_DEFAULT);
        }

       /** Le 2ème point à gérer sont les attaques par "BRUTE FORCE" ; 
        * cela consiste à tenter toutes les combinaisons email-mdp possibles 
        * pour trouver un compte avec lequel se connecter. On pourra ignorer 
        * les attaques manuelles où l'utilisateur prendra des jours,
        * voir des mois pour en trouver un de bon.
        * Le probleme vient des "bots" qui pourront faire plusieurs dizaine
        * de tentaives par seconde. Pour se proteger de ce type d'attaque,
        * plusieurs solutions:
        * 1. Bloquer l'utilisateur après x tentatives et cela jusqu'au 
        *  reset de son mdp ; 
        *  pb : Quelqu'un d'honnête pais maladroit pourrait être agacé. 
        *  et -- le malveillant pourrait s'amuser à bloquer tous vos utilisateurs.
        * 2. Ajout d'un "CAPTCHA3 (completely Automated Public Turing test to 
        *  tell Computer and Human Apart).
        *  Le principe d'un CAPTCHA est de forcer l'utilisateur à faire 
        *  une action qu'un bot ne pourrait pas ou difficilement réaliser.
        * 3. L'ajout d'une authentification à double facteur ; Cela consite
        *  à avoir en plus du mdp habituel, un code temporaire généré et
        *   envoyé via une application par email ou sms.
        * 
        * Ici nous allons implémenter un petit CAPTCHA fait main, mais pour 
        *  ceux qui veulent aller plus loin,
        *  voici le lien vers la documentation de Google :
        *          https://developpers.google.com/recaptcha/docs/v3  
        */
     if(!isset($_POST["captcha"], $_SESSION["captchaStr"]) || 
        $_POST["captcha"] != $_SESSION["captchaStr"]){
            $error = "Captcha incorrecte";
        /**
         * Parlons des attaques CSRF ou XSRF (Cross-site Request Forgery).
         * Cette attaque a pour but de créer une requete get ou post sur un site externe, 
         * mais de renvoyer les informations de cette requete , vers votre site
         * afin que votre site valide une requete que votre utilisateur
         * n'aurait pas voulu.
         * 
         * Pour se proteger de ce genre de requete, un captcha peut suffire,
         * mais si on demande à vos utilisateurs de remplir un capchta 
         * à chaque petit message qu'il veut envoyer , cela va vite les agacer.
         * 
         * On utilisera dopnc des jetons (token) CSRF.
         * Le principe est de générer un jeton sauvegardé en session et 
         * de donner un input hidden à notre formulaire contenant ce jeton, 
         * puis verifier si les deux correspondent.
         * 
         * Pour cela on va passer par un fichier externe que l'on va créer
         *  dans nos "services " _csrf.php
         */
        if(!isCsrfValid()){
            $e = " La methode utilisée n'est pas permise ou vous avez été trop lent";
        }
     }
}
$title = " Security ";
$headerTitle = "Sécutité";
require("../template/_header.php");
?>
<h1>Bienvenue 
    <h2>Saisissez votre mdp à crypter</h2>
    <!-- <?php echo $_SESSION["username"] ?></h1> -->

<form action="" method="POST">
    <input type="text" 
    name="password"
    placeholder="Mot de passe à Hacher" required>

    <!-- Début de Captcha-->
    <div>
        <label for="captcha">Veuillez recopier le texte ci dessous 
            pour valider : </label><br>
        <img src="../service/_captcha.php" alt="CAPTCHA"><br>
        <input type="text" id="captcha" name="captcha" pattern="[A-Z0-9]{6}">
    </div>
    <!-- Fin de Captcha-->

    <!--Debut CSRF-->
    <?php setCsrf(15)?>
    <!-- Fin CSRF-->

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
<!-- On peut verifier l'insertion de la protection CSRF en inspectant le fichier ou
l'on voit l'insertion du token cf /Documentation/Capture.jpg
-->