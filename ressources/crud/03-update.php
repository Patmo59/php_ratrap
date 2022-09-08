<?php
require "../service/_isloggedV2.php";
isLogged(true, "./05-connexion.php");

/**
 * si l'utilisateur n'est pas connecté, il est redirigé.
 * si l'utiisateur  vient sur cette page, sans indiquer d'id, il est redirigé.
 * si l'utiisateur  vient sur cette page, sans que ce soit son id, il est redirigé.
 * 
 */
if(empty($_GET["id"]) || $_SESSION["idUser"] != $_GET["id"]){
    header("Location: ./02-read.php");
    exit;
}
// je recupère les informations de mon utilisateur
require "../service/_pdo.php";
$pdo = connexionPDO();
$sql = $pdo-> prepare ("SELECT * FROM users WHERE idUser = ?");
$sql -> execute([(int)$_GET["id"]]);
$user = $sql->fetch();
// declaration de variable pour le traitement du formaulaire
$username = $email = $password = "";
$error = [];
$regexPass = 
"/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

if($_SERVER["REQUEST_METHOD"]== "POST"  && isset($_POST["update"]))
{
    if(!empty($_POST["username"]))
    {
        $username = cleanData($_POST["username"]);
        if(!preg_match("/^[a-zA-Z' -]{2,25}$/",$username)){
            $error["username"]= "Votre nom d'utilisateur ne peut contenir que des lettres";
        }
    }else{
        $username = $user["username"];
    }

    if(!empty($_POST["email"]))
    {
        $email = cleanData($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

            $error["email"]= "Veuillez saisir un email valide";
        }
    }else{
        $email = $user["email"];
    }
    if(!empty($_POST["password"])){
        if(empty($_POST["passwordBis"])){
            $error["passwordBis"] = "Veuillez saisir à nouveau votre mot de passe";
        }else{
            if($_POST["password"] != $_POST["passwordBis"]){
                $error["passwordBis"] = "Veuillez saisir le meme mot de passe";
            }
        }
        $password = cleanData($_POST["password"]);
        if(!preg_match($regexPass,$password)){
            $error["password"] = "Veuillez saisir un mot de passe valide";
        }
        else{
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
    }else{
        $password = $user["password"];
    }
    if(empty($error)){
        $sql = $pdo->prepare("UPDATE users SET
            username= :us,
            email=:em,
            password=:mdp
            WHERE idUser = :id");
        $sql ->execute([
            "id"=> $user["idUser"],
            "em"=>$email,
            "mdp"=>$password,
            "us" => $username
        ]);
        $_SESSION["flash"] = "Votre profil a bien été édité";
        header("Location:  ./02-read.php");
        exit;
        /**
         * il est possible d'améliorer cette requète, en ne modifiant
         *  que les éléments que l'utilisateur a choisi
         * de modifier.
         */
    }
}// fin du traitement du formulaire
$title = "crud -Update";
$headerTitle = " Mise à jour du Profil";
require ("../template/_header.php");
if($user):
?>
<form action="" method="post">
    <!-- username -->
    <label for="username">Nom d'utilisateur :</label>
    <input 
        type="text" 
        name="username" 
        id="username" 
        value= "<?php echo $user["username"] ?>">
        <span class="error"><?php echo $error["username"]??"" ?></span>
        <br>
        <!-- email -->
        <label for="email">Adresse email :</label>
        <input 
        type="email" 
        name="email" 
        id="email" 
        value= "<?php echo $user["email"] ?>">
    <span class="error"><?php echo $error["email"]??"" ?></span>
    <br>
    <!-- password -->
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" >
    <span class="error"><?php echo $error["password"]??"" ?></span>
    <br>
    <!-- password verify -->
    <label for="passwordBis">Confirmation du mot de passe :</label>
    <input type="password" name="passwordBis" id="passwordBis" >
    <span class="error"><?php echo $error["passwordBis"]??"" ?></span>
    <br>
    <input type="submit" value="Mettre à jour" name="update">
</form>
<?php else: ?>
    <p>Aucun utilisateur trouvé</p>
<?php
endif;
require "../template/_footer.php";


