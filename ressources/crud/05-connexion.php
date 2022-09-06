<!-- Copiue du connesier 04-connexion  attention a remettre les chemin des require en ordreConnexion

<?php
session_start();
// si l'utilisateur est connecté il n'y a rien a faire sur l'inscription.
if(isset($_SESSION["logged"])&& $_SESSION["logged"]== true){
    // header("location: /"); // cette ligne me renvoie vers la page index de depart etant donné que je ne suis pas connecté
    exit;
}
$usermane = $email = $password= "";
$error =[];
if($_SERVER["REQUEST_METHOD"] == "POST"){
            // Je vérifie si le champ email n'est pas vide.
            if(empty($_POST["email"])){
                $error["email"] = "Veuillez entrer un email.";
            }else{
                $email = trim($_POST["email"]);
            }
            // Je vérifie si le champ password n'est pas vide
            if(empty($_POST["password"])){
                $error["password"] = "Veuillez entrer un mot de passe.";
            }else{  // a verifier si on en a besoin
                $pass = trim($_POST["password"]);
            }
        }
$title = "CRUD - Create";
$headerTitle = "CONNEXION";
require "../../template/_header.php" 
?>
  <!-- form:post>label+input:email+span.error+br+label+input:password+span.error+br+input:submit -->
<form action="" method="post">
    <span class="error"><?php echo $error ["login"]?? ""; ?></span>
    <!-- email -->
    <label for="">Email</label>
    <input type="email" name="email" id="email">
    <span class="error"><?php echo $error ["email"]?? ""; ?></span>
    
    <br>
    <!-- password -->
    <label for="password">Mot de Passe </label>
    <input type="password" name="password" id="password">
    <span class="error"><?php echo $error ["email"]?? ""; ?></span>
    <br>
    <input type="submit" value="Connexion">
</form>

<?php require "../../template/_footer.php" ?>