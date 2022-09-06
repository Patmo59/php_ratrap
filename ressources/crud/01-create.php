<?php 
/*
    Le CRUD est un accronyme signifiant :
        Create : créer de nouvelles lignes dans nos tables.
        Read : lire et afficher les données de nos tables.
        Update : mettre à jour les données.
        Delete : Supprimer les données.
    La plupart du temps, chaque table est accompagner de ces 4 actions. (sauf exception)

    Mais avant tout, créons une BDD pour notre projet,
    Appelons là "blog" et créons une table "users"
    qui prendra les colonnes suivantes :
        idUser int AI PK,
        username varchar(25),
        email varchar(255) UQ,
        password text,
        createdAt datetime DEFAULT timestamp;
*/
session_start();
// Si l'utilisateur est connecté, il n'a rien à faire sur l'inscription.
if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true){
    header("location: /");
    exit;
}
$username = $email = $password = "";
$error = [];
$regexPass = 
"/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";
// on vérifie notre formulaire.
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["inscription"]))
{
    // on inclu notre service de connexion
    require "../service/_pdo.php";
    // On se connecte à notre BDD.
    $pdo = connexionPDO();
    // username :
    if(empty($_POST["username"])){
        $error["username"] = "veuillez saisir un nom d'utilisateur";
    }else{
        $username = cleanData($_POST["username"]);
        /* 
            En PHP, on utilisera "preg_match" pour tester si 
            un string correspond à une regex.
        */
        if(!preg_match("/^[a-zA-Z' -]{2,25}$/", $username)){
            $error["username"] = "Veuillez n'utiliser que des lettres.";
        }
    }
    // Email:
    if(empty($_POST["email"])){
        $error["email"] = "Veuillez saisir un email";
    }else{
        $email = cleanData($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error["email"] = "Veuillez saisir un email valide";
        }
        /* 
            On souhaite que nos utilisateurs n'ai qu'un seul compte par email.
            Pour cela on va vérifier si cet email est déjà enregistré en BDD.

            Ici on va utiliser ce qu'on appelle une requête préparé. 
            à chaque fois que l'on rentre une information venant d'un utilisateur en BDD.
            Nous devons utiliser une requête préparé, cela permet de séparer les valeurs de l'utilisateur de la requête en elle même.
            Grâce à cela nous évitons les injections SQL.
        */
        $sql = $pdo->prepare("SELECT * FROM users WHERE email = :em");
        /*
            le ":em" est un placeholder qui va accueillir les données rentré par l'utilisateur.
            Pour cela on va donner à la fonction execute un tableau associatif contenant nos placeholder en index.
        */
        $sql->execute(["em"=>$email]);
        /* 
            Enfin on utilise "fetch" pour aller chercher l'information retourné par la requête.
        */
        $resultat = $sql->fetch();
        /* 
            Si on obtient un résultat, alors l'utilisateur existe déjà en BDD.
        */
        if($resultat){
            $error["email"] = "Cet email est déjà enregistré.";
        }
    }
    // password
    if(empty($_POST["password"])){
        $error["password"] = "Veuillez saisir un mot de passe";
    }else{
        $password = cleanData($_POST["password"]);
        if(!preg_match($regexPass, $password)){
            $error["password"] = "Veuillez saisir un mot de passe valide";
        }else{
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
    }
    // vérification password
    if(empty($_POST["passwordBis"])){
        $error["passwordBis"] = "Veuillez confirmer votre mot de passe.";
    }else{
        if($_POST["password"] != $_POST["passwordBis"]){
            $error["passwordBis"] = "Veuillez saisir le même mot de passe.";
        }
    }
    // envoi des données.
    if(empty($error)){
        $sql = $pdo->prepare("INSERT INTO users(username, email, password) VALUES(?,?,?)");
        /* 
            à la place d'un placeholder nommé comme précédement, Je peux utiliser des "?". Dans ce cas là, ce ne sera pas un tableau associatif que je donnerais mais un tableau classique. Seulement, ici l'ordre est très important.
        */
        $sql->execute([$username, $email, $password]);
        header("Location: /");
        die;
    }
}
$title = " CRUD - Create ";
$headerTitle = "Inscription";
require "../template/_header.php" ?>
<form action="" method="post">
    <!-- username -->
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" id="username" required>
    <span class="error"><?php echo $error["username"]??"" ?></span>
    <br>
    <!-- email -->
    <label for="email">Adresse email :</label>
    <input type="email" name="email" id="email" required>
    <span class="error"><?php echo $error["email"]??"" ?></span>
    <br>
    <!-- password -->
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>
    <span class="error"><?php echo $error["password"]??"" ?></span>
    <br>
    <!-- password verify -->
    <label for="passwordBis">Confirmation du mot de passe :</label>
    <input type="password" name="passwordBis" id="passwordBis" required>
    <span class="error"><?php echo $error["passwordBis"]??"" ?></span>
    <br>
    <input type="submit" value="Inscription" name="inscription">
</form>
<!-- 
    Pour des raisons de simplicité du cours, nous n'ajoutons pas de sécurité supplémentaire à ce formulaire, mais pensez à le faire sur vos projets. *
-->
<?php require "../ressources/template/_footer.php" ?>