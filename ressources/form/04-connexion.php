<?php
// on crée une session
session_start();
/**
 * Verifier que l'on a une clé "logged dans notre session ; 
 * si elle existe , est-elle egal à True. Si oui on considère notre utilisateur comme connecté. 
 * Un utilisateur connecxté n'a rien à faire sur la page de connexion ; on le redirige ailleurs
 */
if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
    header("Location: /");
    die();
}
$email = $pass = "";
$error = [];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"]))
{
    if(empty($_POST["email"])){
        $error["email"] = "Veuillez entrer un email";
    }else{
        $email = trim($_POST["email"]);
    }
    if(empty($_POST["password"])){
        $error["pass"] = "Veuillez entrer un mot de passe";
    }else{
        $pass = trim($_POST["password"]);
    }
    if(empty($error)){
        /**
         * Normalelment on devrait aller chercher notre utilisateur en BDD. 
         * On a pas vu comment gerer un user en BDD... du coup on va utiliser le fichjieer users.json
         * avec une fonction pêrmettant de recuperer le contenu d'un fichier
         */

         $users = file_get_contents("./users.json");
         /**
          * json_decode() permet de transformer une chaine de caractère de type json en objet utilisable en php.
          *Si on lui donne en 2ème argument un bolléen à true, plutot qu'un objet, il nous rendra un tableau associatif.
          *on ne l'utilisera pas là, mais pour transformer un element php en json,  ,  c'est la fonction json_encode().
          */
         $users = json_decode($users , true);
         /**
          * On tente de récuperer un utilisateur.  si l'adresse email existe, on obtient l'utilisateur, 
          * sinon on obtient false
          */
         $user =$users[$email]?? false;
        //  var_dump($users); // permet de verifier l'acces au .json .

        if($user){
            /** Si on regarde notre fichier json, les mots de passe sont hachés
             * la Comparaison entre le ot de passe saisi et celui en memoire n'est pas possible.
             * Mais nosu pouvons faire appel :  password_verifiy() qui prendra en 1er argument
             *  le mdp en clair, en 2ème le mdp haché ; il nous retournera true s'ils correspondent, false dans l'autre cas.
             */
            if(password_verify($pass, $user["password"])){
                /**Si le mdp est correst, on crée en session une entrée à true indiquant quenotre utilisateur ("logged");
                 * Et on pourrra sauvegarde en session les infos du usezr si on souhaite les réutiiser ensuite.
                 *  (username et email).
                 * la deconnexion de se fera automatiquement au bout d'un certain temps ; 
                 * on pourra aussi sauvegarder une date d'expiration
                 */
                $_SESSION["logged"] = true;
                $_SESSION["username"] = $users["username"];
                $_SESSION["email"] = $users["email"];
                $_SESSION["expire"] = time()+ (60*60);
                // un fois connecté je redirige mon utilisateur
                header("Location: /");
            }else{
                /**
                 * ! Parlons sécurité :
                 * on remarquera que j'ai mis le meme msg d'erreur pour eviter en cas de malveillance de pouvoir
                 *  identifier si l'email est valide.
                 */
                $error["login"] = "Email ou mot de passe incorrecte !";
            }
        }else{
            $error["login"] = "Email ou mot de passe incorrecte !";
        }
    }

}
$title = " Connexion ";
$headerTitle = "Formulaire de connexion";
require("../template/_header.php");
?>
    <form action="" method="post"  >

    <label for="email">Votre Email :</label>
    <input type="email" name="email" id="email">
    <br>
    <span class="error"><?php echo $error["email"] ?? "" ?></span>
    <br>
    <label for="password">Votre Mot de passe :</label>
    <input type="password" name="password" id="email">
    <br>
    <span class="error"><?php echo $error["pass"] ?? "" ?></span>
    <br>
    <input type="submit" value="Connexion" name="login">
    <br>
    <span class="error"><?php echo $error["login"] ?? "" ?></span>
</form>

<?php
require("../template/_footer.php");
?>

<!-- gestionnaire de not de passe : keePass    master keeword : Azerty123+
fakePassword.kdbx est un fichier generé par le logiciel keePass pour permettre une gestion
des mots de passe
-->