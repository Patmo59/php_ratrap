<?php

/**
 * Ce fichier va contenir toutes les informations de connnexion à votre base de dopnnées
 * Faites bien attention à ce qu'il ne soit pas accessible par vos utilisateur .
 * Pour cela plusieurs possibilités, utiliser un router ou bien ranger de fichiers hors de la racine de votre sujet par exemple
 * */
 return[
    "host"=> "localhost",
    // nom de la base 
    "database"=> "blog",
    //l'username de connexion
    "user"=> "root",
    //mot de passe de connexion
    "password"=>"",
    // set de caractères utilisé par la base
    "charset"=> "utf8mb4",
    /**
     * un tableau d'options qui seront utilisées pour indiquer à PDO 
     * ( l'outils qu'on utilisera pour se connecter , commen réagir dans certains cas )
     */
    "options"=>[
        //mode d'affichage ,des erreurs
        PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,
        //mode de retour des données  par tableaux associatifs
        PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC,
        /*pdo peut eéuler lui meme les requetes préparées plutot que de laisser le pilote de la BSDD le faire.
        notre version MySQL gère très biens cela , on va donc désactiver celui sio de pdo*/
        PDO::ATTR_EMULATE_PREPARES => false
    ]
    ];

    /**
     * Une liste des différents attributs pour ces options peut se retrouver sur le lien :
     * 
     *   https://www.php.net/manual/fr/pdo.setattribute.php
     * 
        *ainsi que les différents FETCH_MODE ici :
        *https://www.php.net/manual/fr/pdostatement.fetch.php
     */
?>

