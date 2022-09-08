<?php
/**
 * REsumons ce que l'on a vu:
 *  1. il est important de mettre le fichier contenant les informations
 * de connexion à votre BDD dans un dossier inaccessible aux utilisateurs.
 *  2. Au lieu de repeter à chaque fois la connexion à la BDD dans chaque 
 * fichier où vous en avez bsoin, le faire dans un fichier include
 *  sera plus pratique.
 *  3.  Si des informations rentrées poar l'utilisateur sont requises
 *  dans votre requète, il faut faire une requète préparée.
 */
//Connexion :
$pdo = new PDO(
    "mysql:host=localhost;
    port:=3306;
    dbname=biere;
    charset=utf8mb4",
     "root",
     "",
     [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDo::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // PDO::ATTR_EMULATE_PREPARES => false
     ]
     );
     //Requète simple (non securisée)
     $sql = $pdo ->query("SELECT * FROM couleur ");
     echo "<pre>". print_r($sql ->fetchAll(),1). "</pre><hr>";

     // Requete préparée (parametre anonyme)
     $sql = $pdo ->prepare("SELECT * FROM couleur WHERE NOM_COULEUR=?");
     $sql->execute(["Blanche"]);
     echo "<pre>". print_r($sql -> fetch(),1). "</pre><hr>";

     // Requete préparée (parametre nommé)
     $sql = $pdo ->prepare("SELECT * FROM couleur WHERE NOM_COULEUR=:col");
     $sql->execute(["col"=>"Brune"]);
     echo "<pre>". print_r($sql -> fetch(),1). "</pre><hr>";
     
     /**
      * Pour "execute" il n'y a que deux types possibles : Null ou string
      * parfois on a besoin d'éléments plus precis ; par exemple
      *si on laisse activé l'émulation des requetes préparées par PDO,
      * on va avoir un probleme si on execute un parametre avec "LIMIT".
      *Ce dernier n'accepte que des chiffres et execute transforme notre 
      *nombre en string.
      *Une autre facon de faire est de lier les parametres en utilisant les methodes :
      * bindValue()  ou bindParam()
      *Elles ont l'avantage de popuvoir accepter plus de type sous 
      *la forme de constante :
      *      -PDP::PARAM_NULL
      *     -PDP::PARAM_BOOL
      *    -PDP::PARAM_INT
      *   -PDP::PARAM_STR
      */
      $sql = $pdo ->prepare("SELECT * FROM couleur LIMIT :lim");
      // provoque une erreur si parape émulé par PDO.
    //   $sql->execute(["lim"=>2]);
    $sql->bindValue("lim", 2, PDO::PARAM_INT);
    $sql-> execute();
    echo "<pre>". print_r($sql -> fetchAll(),1). "</pre><hr>";
    
    /**
     * Execute doit etre appelé quand meme, mais il ne doit etre laissé vide.
     * Soit o parametre via les bind, soit via execute mas pas les deux
     */
    /**
     * Différence entre bindValue et bindParam :
     */
    $couleur = "Blanche";
    $sql = $pdo->prepare("SELECT * FROM couleur WHERE NOM_COULEUR = :col");
    $sql->bindValue("col", $couleur, PDO::PARAM_STR);
    $couleur = "Ambrée";
    $sql->execute();
    echo "<pre>". print_r($sql -> fetchAll(),1). "</pre><hr>";
        /**
         * Au dessus on nous repond "Blanche"
         * En dessous on nous repond "Ambrée"
         * bindValue va lier la valeur de la variable.
         * bindParam va lier la variable elle meme.
         * 
         * Donc dans le dernier cas, si la variable
         *  change avant l'execution, cela change le resultat
         * 
         */

    $couleur = "Blanche";
    $sql = $pdo->prepare("SELECT * FROM couleur WHERE NOM_COULEUR = :col");
    $sql->bindParam("col", $couleur, PDO::PARAM_STR);
    $couleur = "Ambrée";
    $sql->execute();
    echo "<pre>". print_r($sql -> fetchAll(),1). "</pre><hr>";

    ?>