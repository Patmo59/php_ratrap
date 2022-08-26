<?php

#-------------------------------------------------------------------------
/* Par defaut rand() retourne une valeur aléatoire entre 0 et getrandmax()
mais on peut lui donner en argument une valeur minimum et maximum  */ 
echo"Choix aléatoire du serveur :";
$r = rand(0,100);// Déclaration de la variable $r nbre compris entre 0 et 100 
echo $r, "<br";
#-------------------------------------------------------------------------
echo" <H1>Condition</H1> <hr>";


if($r<50){    //si r est inferieur à 50
    echo"\$ est plus petit que 50. <br>";
}
elseif ($r>50){   // + grand
    echo"\$ est plus grand que 50. <br>";
}
else{     // = a 50
    echo"\$ est égal  50. <br>";
}
#-------------------------------------------------------------------------
echo" <H1>Autres syntaxes</H1> <hr>";
/**bien que plus rare, il est possibles d'écriree une condition en rermplacant les accolades,
 * elles sont remplacées par un ":" en début de condition et par endif à la fin  
 */
if($r<50): 
    echo"\$ est plus petit que 50. <br>";
    
    elseif ($r>50):   // + grand
        echo"\$ est plus grand que 50. <br>";

        else :     // = a 50
            echo"\$ est égal  50. <br>";
            
        endif;
        // on peut aussi supprimer dans le code au dessus les ":" et le endif, mais il faut obligatoirement qu'il n'y ait 
        //qu'une seule instruction à suivre.
        
        echo "<br> Les ternaires ";

        echo "\$r est plus" . ($r<=50? "petit ou egal à" : "grand que") . "50 <br>" ;
        
        echo "\$r est ".($r<=50? "plus petit que " : ($r>50?"plus grand que":"égal à"))."50 <br>" ;
        
        $message1 = "Bonjour tout le monde <br>";
        echo $message1?? "rien à dire <br>";
        echo $message2?? "rien à dire <br>";
        
        #-------------------------------------------------------------------------
        echo" <H1>Switch</H1> <hr>";

        
        $pays = ["France","Japon","Angleterre","Suisse","france",];
        $r2 = rand(0, count($pays)-1);
        echo $pays[$r2],"<br>";
        switch($pays[$r2]) {
            case "Japon":
                echo " Pays dont la cuisine est inscrite au patrimoine immateriel de l'Unesco";
                    break;   // chaque cas doit finir par un break
                case "Suisse":
                    echo" Pays ou tout le monde ne parle pas la meme langue ";
                        break;
                case "france":
                    echo " Mets une majuscule ! <br>"; // sans break, le cas suivant est effectué 
                case "France":
                    echo " Deuxième pays dont la cuisine est inscrite au patrimoine immateriel de l'Unesco";
                        break;
                        default: // si aucun cas ne correspond, c'est le cas default qui sera executé. 
                        echo "Je ne vais pas détailler tous les pays";
        }




?>