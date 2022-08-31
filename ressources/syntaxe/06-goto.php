<?php
$headerTitle = $title = "Go To";
// $mainClass = "includeNav";
require("./ressources/template/_header.php");
require("./ressources/template/_nav.php");
?>

<h1>GO TO</h1>
<?php

/* goto permet de sauter une partie du code pour aller à la suivante. On peut s'en servir avec une condition pour ne pas faire certaines actions.
On peut s'en servir à la façon d'un break pour sortir d'une boucle
!Attention, on ne peut pas :
entrer dans une fonction, une boucle ou une condition avec goto
sortir d'une fonction
goto fonctionne en 2 parties , la 1ere est une balise qui servira d'ancre à notre goto, cad l'endroit où aller
il est representé par "unMot:"
et le mot clef goto suivi du nom d'une <ancre>*/
?>
<div class="goto">
    <?php
    for ($i =0; $i<100;$i++){
        echo "Ceci est le message $i ! <br>";
        if($i ===5){
            // on indique où l'on veut se rendre à l'ancre "fin"
            goto fin;
        }
    }
    echo "Les chaussetts de l'archiduchesse..";
    // ici on déclare notre ancre "fin"
    fin : 
    echo "ceci est la fin";
    ?>
</div>
<?php
require("./ressources/template/_footer.php");

?>
