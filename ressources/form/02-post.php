<?php 
/** Les seules différences entre le formulaire _GET et celui Ci en _POST sont
 *  1. la v"rification de la méthode en Post
 * 2. l'attribut "méthodeé qui passe en post
 * 3. l'utilisation du $_Post au lieu de $_GET
  */

  /*  AJOUTONS UNE CHECKBOX cgu par exemple
        AJOUTONS AUSSI DES CLASSES en cas d'erreur
            ET AMELIORONS NOS INPUTS "SELECT" ET "RADIO"*/
$username = $food = $drink = "";
$error = []; 
$foodList = [
    "welsh"=> "Welsh (car vive le fromage)",
     "cannelloni"=>" Cannelloni (car les ravioli c'est surfait)",
      "oyakodon" => "Oyakodon (car j'aime l'humour noir)"
    ];
$drinkList = [
    "jus de tomate" => "Jus de tomate (je suis un vampire)" ,
    "milkshake" => "Milkshake (aux fruits de préférence)" , 
    "limonade" => "Limonade (j'ai besoin de sucre)" 
];

if($_SERVER["REQUEST_METHOD"] == "POST" 
    && isset($_POST["submit"])){
        if(!empty($_POST["username"])){
            $username = cleanData($_POST["username"]);
            if(strlen($username)<3 ||strlen($username>30)){
                $error["username"] = "Votre nom d'utilisateur n'a pas la bonne taille"; 
            }
        }
        else{
            $error["username"] = "Veuillez entrer un nom d'utilisateur";
        }
        if(!empty($_POST["food"])){
            $food = cleanData($_POST["food"]);
            if(!array_key_exists($food,$foodList)){
                $error["food"] = "Ce repas n'existe pas !";
            }
        }
        else{
            $error["food"] = "Veuillez choisir votre nouriture favorite";
        }
        if(!empty($_POST["drink"])){
            $drink = cleanData($_POST["drink"]);
            if(!array_key_exists($drink, $drinkList)){
                $error["drink"] = "Cette boisson n'existe pas !";
            }
        }
        else{
            $error["drink"] = "Veuillez choisir une boisson";
        }
        // le champ est -il vide ?
        if(!empty($_POST["cgu"])){
            $cgu = $_POST["cgu"];
            //une seule valeur possible , on peut la verifier directmement
            if($cgu != "cgu"){
                //a noter que la valuer d'une checkbox ouy radio , si elle n'est pas définie, vaut "on"
                $error["cgu"] = "Ne mofifiez pas nos formulaires !";

            }
        }
    }
    function cleanData (string $data): string{
        
        $data = trim($data);
        
        $data = stripslashes($data);
        
        return htmlspecialchars($data);
    }
$title = " POST ";
$headerTitle = "Formulaire en POST";
require("../template/_header.php");
?>
<form action="" method="POST">
    <input type="text" 
    placeholder="Entrez un nom" 
    name="username"
    class="<?php echo (empty($error["username"])? "":"formError")?>"
    value="<?php echo $username ?>"> <!--permet de memoriser la saisie pour eviter d'avoir à tout resaisir-->
    <span class="error"><?php echo $error["username"]??"" ?></span>
    <br>
    <fieldset class="<?php echo(empty($error["food"])? "":"formError")?>"> <!--permet de memoriser la saisie pour eviter d'avoir à tout resaisir-->
        <legend>Nourriture Favorite</legend>
        <?php foreach($foodList as $k => $f): ?>
            <input 
            type="radio" 
                name="food"
                id="<?php echo$k ?>" 
                value="<?php echo $k ?>">
                <?php echo $food === $k ? "checked":""; ?> <!--permet de memoriser la saisie pour eviter d'avoir à tout resaisir-->
                <!--Si notre variable $food est egale à l'iteration actuelle, alors on lui ajoute l'attibut "checked"-->
        <label for="<?php echo$k ?>"><?php echo $f ?>
        </label>
        <br>
        <?php endforeach; ?>
        <span class="error"><?php echo $error["food"]??"" ?></span>
    </fieldset>
    <label for="boisson">Boisson Favorite</label>
    <br>

    <select name="drink" id="boisson">

    <?php foreach($drinkList as $k => $d): ?>
        <option value ="<?php echo $k ?>"
        <?php echo ($drink === "k"?"selected":"" )?>  <!--permet de memoriser la saisie pour eviter d'avoir à tout resaisir-->
        >
            <?php echo $d ?>
        </option>
    <?php endforeach; ?>
        
    </select>
    <span class="error"><?php echo $error["drink"]??"" ?></span>
    <br>
    <!-- on ajoute une checkbox "cgu" -->
    <input type="checkboc" name="cgu" id= "cgu" value = "cgu">
    <label for="cgu">J'accepte que mes connées ne m'appartiennent plus></label>
    <span class="error"><?php echo $error["cgu"]??"" ?></span>
        <!-- fin de checkbox -->

    <input type="submit" value="Envoyer" name="submit">
</form>
<?php if(empty($error) && isset($_POST["submit"])): ?>
    <h1>Meilleur repas :</h1>
    <p>
        <?php echo "Pour $username, le meilleur repas est \"$food\" avec \"$drink\".";?>
    </p>
<?php endif; ?>
<?php 
require("../template/_footer.php");
?>