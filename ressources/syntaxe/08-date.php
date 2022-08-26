<?php
$headerTitle = $title = "Dates";
require("./ressources/template/_header.php");
echo time(), "<br>";
/* Pour afficher une date  date() prend jusqu'à 2 arguments, le 1er est obligatoire
    le premier est un string
    le 2ème optionel est un timestamp ( par defaut le timestamp actuel )*/
    echo date(" , "), "<br>"; // si string vide => 0 affichage
    echo date("d/m/Y , "), "<br>"; // 25/08/2022 ,
    echo date("j/n/y , "), "<br>"; // 25/8/22 , sans les "0" dans le jour et le mois
    echo date("D = l / M = F  , "), "<br>"; //Thu = Thudaday Aug = August
    echo date("D = N = w , "), "<br>"; // Thu = 4 = 4 , w == dimanche "0", N 7 jour ds la semaine
    echo date("z ->W , "), "<br>"; // N° du jour et de la semaine 236 ->34 ,
    echo date("F -> t , "), "<br>"; // nbre de jours dans le mis August -> 31 
    echo date("Y -> L , "), "<br>"; //  bouléern :année bissextile ou non  2022 -> 0 ,
    echo date("h:i:s: a , "), "<br>"; // heure à l'US   10:38:58: am ,   ou pm 
    echo date("g:i:s A , "), "<br>"; // 10:40:39 AM , en majuscule  format 12  ss "0"
    echo date("H:i:s:v , "), "<br>"; // 10:42:20:000  h == 24 avec 0 v == millisecondes avec"0" pas sur tous les serveurs
    echo date("G:i:s , "), "<br>";   //10:44:23 => 24h
    echo date("O = P , "), "<br>";   //decallage horaire +0200 = +02:00 ,
    echo date("I -> Z , "), "<br>";  //   heure d'été  Z difference entre h et GMT  1 -> 7200 ,
    echo date(" c , "), "<br>";  //    2022-08-25T11:12:16+02:00 ,
    echo date(" r , "), "<br>";  //   Thu, 25 Aug 2022 11:13:00 +0200 , format RFC 2822
    echo "<hr>";
    // date("d/m/Y","D = l / M = F" );
    ?>



<?php
require("./ressources/template/_footer.php");
?>