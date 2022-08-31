<?php

//Include et require permettent d'inclure d'autres fichiers dans notre code
// Dans un dossier "ressoures", nous allons créer un dossier "template" contenant les fichiers suivants :

// "_header.php";
// "_footer.php";
// "_ nav.php";


// Puis toujours dans note dossier ressources, on va créer un dossier "style.css :"
// le "_" en debut  est une convention que ce fichier ne doit pas etre chargé seul : c'est seulement
//un composant, une parite de quelque chose d'autre.
// require bloque le script en cas d'erreur " Fatal Error",  include donne un warning
$title = "-Include";
$headerTitle = "Include et Require";
$mainClass = "includeNav";
require("./ressources/template/_header.php");


include("./ressources/template/_nav.php");  /* raccourcis de saisie :p#para$*5>lorem25*/
?>
 <div>
     <p id="para1">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis consequuntur facere dolorem harum sit aspernatur repellat mollitia, voluptates eaque! Nemo error dolorem quis commodi! Consectetur.</p>
     <p id="para2">Praesentium quidem vitae voluptatem distinctio necessitatibus nostrum vel nisi nobis aspernatur amet. Magnam aspernatur voluptatem reprehenderit dolor illo quisquam quas quaerat, quis hic expedita debitis.</p>
     <!-- <p id="para3">Provident animi non adipisci facere ut asperiores facilis rerum ex dolorem, laborum aliquam qui suscipit ullam minus eveniet hic similique eius? Inventore consequuntur doloribus dolores!</p>
     <p id="para4">Ducimus temporibus similique totam! Debitis accusantium deleniti voluptatem totam, quaerat, ea vero nisi fugiat hic autem, illo consequatur sit natus accusamus optio perspiciatis non tenetur.</p>
     <p id="para5">Eveniet voluptatibus reiciendis iusto enim laborum in, quos nemo, officiis blanditiis dolores veniam, excepturi cum ut illo. Recusandae soluta vero aut, laborum debitis dicta impedit.</p> -->
    </div>
    <?php
    //require_once verifie si le fichier footer.php n'est pas déjà inclus. Là il est appelé 3 fois mais ne s'affiche que deux fois
    // incluse_once meme option que require...
require("./ressources/template/_footer.php");
require("./ressources/template/_footer.php");
require_once("./ressources/template/_footer.php");
?>