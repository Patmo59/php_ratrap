<?php
        /**
         * DAns PHP il existe pllusieurs outils de connexion à une Bdd.
         * les deux les plus utilisés sont "MySQLLi" et "PDP"
         * Attention lors de vos recherches , dans le passé, il y avait un outils MySql mais il est obsolète
         * MySqlLi est adapté uniquement aux bBdd avec un pmilote MySql.
         * Pdo est adapté à n'importe quel pilote
         * PDO signifie PHP Data Object
        */
function connexionPDO(): PDO{
    $config = require __DIR__ ."/../config/_blogConfig.php";
    /**
     * dns signifie  Data Sourse Name c'est un string conteant toutes les infos pour localiser la BDD 
     * elle orendra la forme suivante :
     *      "pilote": host="hebergeure,port="port de la bdd";
     * bdname= "nom de la bdd"; charset="charset utilisé pa lma bdd"
     * le tout sans espace, en remplacant les valeurs entre "" par les valeurs apporpriées. 
     * exemple :
     *  mysql:host=localhost;port=3306;dbname=blog;charset=utf8mb4
     */
        $dsn = 
        "mysql:host=".$config["host"]
        ."; dbname=".$config["database"]
        .";charset=".$config["charset"];
try{
        /**
         * on crée une nouvelle instance de PDP en lui donnant  le 
         * 
         *  dsn en 1 er argument,   
         * ensuite le nom d'utilisateur en 2ème,
        *   le mot de passe en 3ème,
        *  ses otpions en 4ème.*/
    $pdo = new PDO(
        $dsn,
        $config["user"],
        $config["password"],
        $config["options"]
    );
    // on retourne notre nouvel PDO 
    return $pdo;
}catch(PDOException $e){
        /**
         * On capture l'eerue sous forme d'un PDOEsception 
         * puis on lance trow avec le message capturé en 1er argument
         */

    throw new PDOException(
        $e -> getMessage(),
        (int)$e ->getCode()
    );

    }
}
    /**
     * Profitons pour avoir un fichier importé dans tous nos formulaires pour y 
     * ajouter une fonction que l'on utiise assui dans tous nos formulaires
     *
 * @param string $data
 * @return string
 */
function cleanData(string $data):string{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
?>

