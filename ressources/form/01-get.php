<?php 
/* Quelques conventions :
    1. Quand on place toute notre logique PHP dans le même fichier que notre HTML.
        On placera souvent toute la logique PHP en haut du fichier, avant le moindre HTML.
    2. On aura tendance à déclarer toutes les variables que l'on va utiliser en haut de notre code pour s'en souvenir et pouvoir les modifier facilement sans recherche. 
*/
// On va déclarer une variable pour chaque input de notre formulaire.
$username = $food = $drink = "";
// ainsi qu'une variable qui est un tableau qui contiendra nos erreurs.
$error = [];
// Optionnellement, je vais créer des tableaux qui seront utiles pour la vérification de nos champs à choix limité. (radio, select)
$foodList = ["welsh", "cannelloni", "oyakodon"];
$drinkList = ["jus de tomate", "milkshake", "limonade"];
// On trouvera dans la superglobal $_SERVER, la méthode avec laquelle la page a été requise.
// var_dump($_SERVER["REQUEST_METHOD"]);
// par défaut, quand on va de page en page, on est en méthode GET.

/*
    Lorsque l'on veut regarder le contenu d'un formulaire envoyé en méthode GET, On va vérifier deux choses :
        1. Si on est bien arrivé en méthode GET sur la page.
        2. Si notre formulaire a bien été soumis.
*/
if($_SERVER["REQUEST_METHOD"] == "GET" 
    && isset($_GET["submit"])){
        // Ensuite on va vérifier si tous nos inputs "requis" ne sont pas vides
        if(!empty($_GET["username"])){
            // on déclare une fonction pour éviter d'avoir à réécrire à chaque _GET 
            // le contenu de la fonction.
            // la fonction cleanData est appliquée sur chaque _GET nous empêcher
            // toute insertion de code malveillant
            $username = cleanData($_GET["username"]);
            /** L'enregistrement ds la bdd se fera sous forme de varchar(); il faut vérifier que la saisie de l'utilisateur à la fois au minimum et au maximum */
            if(strlen($username)<3 ||strlen($username>30)){
                $error["username"] = "Votre nom d'utilisateur n'a pas la bonne taille"; 
            }
        }
        else{
            $error["username"] = "Veuillez entrer un nom d'utilisateur";
        }
        if(!empty($_GET["food"])){
            $food = cleanData($_GET["food"]);
            if(!in_array($food,$foodList)){
                $error["food"] = "Ce repas n'existe pas !";
            }
        }
        else{
            $error["food"] = "Veuillez choisir votre nouriture favorite";
        }
        if(!empty($_GET["drink"])){
            $drink = cleanData($_GET["drink"]);
            if(!in_array($drink, $drinkList)){
                $error["drink"] = "Cette boisson n'existe pas !";
            }
        }
        else{
            $error["drink"] = "Veuillez choisir une boisson";
        }
    }
    function cleanData (string $data): string{
        
        $data = trim($data);//trim supprime les espaces en début et fin  du string
        
        $data = stripslashes($data);//stripslahes supprime les "\" pour éviter que des caractères soient échapés
        
        return htmlspecialchars($data); // htmlspecialchars convertit les caractères spéciaux en entité Html
        // exemple : "<" devient "&lt;"
        
        // return htmlspecialchars(stripslashes(trim($data))); // autre façon d'ecrire ce qui précède;

        /** Il existe d'autres façons de nettoyer les entrées; 
         * !  TESTEZ CE QUI DOIT FONCTIONNER? MAIS AUSSI CE QUI NE DOIT PAS FONCTIONNER
         */
    }
$title = " GET ";
$headerTitle = "Formulaire en GET";
require("../template/_header.php");
?>
<!-- l'attribut action, permet d'indiquer vers quelle page
rediriger l'utilisateur pour traiter le formulaire.
Si on le laisse vide, il rechargera uniquement la page. 
L'attribut method permet d'indiquer avec quelle méthode 
les données seront transférées, généralement en GET ou en POST-->
<form action="" method="GET">
    <!-- "input" quand on veut traiter un formulaire, il est important de ne pas oublier l'attribut "name" il permettra de récupérer les informations. -->
    <input type="text" placeholder="Entrez un nom" name="username">
    <!-- les span.error serviront à afficher nos messages d'erreur. -->
    <span class="error"><?php echo $error["username"]??"" ?></span>
    <br>
    <fieldset>
        <legend>Nourriture Favorite</legend>
        <input type="radio" name="food" id="welsh" value="welsh">
        <label for="welsh">Welsh (car vive le fromage)</label>
        <br>
        <input type="radio" name="food" id="cannelloni" value="cannelloni">
        <label for="cannelloni">Cannelloni (car les ravioli c'est surfait)</label>
        <br>
        <input type="radio" name="food" id="oyakodon" value="oyakodon">
        <label for="oyakodon">Oyakodon (car j'aime l'humour noir)</label>
        <br>
        <span class="error"><?php echo $error["food"]??"" ?></span>
    </fieldset>
    <label for="boisson">Boisson Favorite</label>
    <br>
    <select name="drink" id="boisson">
        <option value="jus de tomate">Jus de tomate (je suis un vampire)</option>
        <option value="milkshake">Milkshake (aux fruits de préférence)</option>
        <option value="limonade">Limonade (j'ai besoin de sucre)</option>
    </select>
    <span class="error"><?php echo $error["drink"]??"" ?></span>
    <br>
    <!-- J'ai ajouté un "name" au bouton submit afin de vérifier
    si c'est le bon formulaire qui a été soumis. -->
    <input type="submit" value="Envoyer" name="submit">
</form>
<!-- La zone suivante aura pour rôle d'afficher le résultat du 
formulaire. 
empty() va vérifier si la variable fourni en argument est vide
isset($_GET["submit"]) va vérifier si dans les informations 
fourni en get se trouve une clef "submit" -->
<?php if(empty($error) && isset($_GET["submit"])): ?>
    <h1>Meilleur repas :</h1>
    <p>
        <?php echo "Pour $username, le meilleur repas est \"$food\" avec \"$drink\".";?>
    </p>
<?php endif; ?>
<?php 
require("../template/_footer.php");
?>