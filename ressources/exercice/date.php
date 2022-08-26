<!-- 
    ----------------------------Exercice D1------------------------------ 
    écrire une fonction "frenchDate" qui retournera la date du jour 
    en français, puis l'afficher (exemple : jeudi 25 août 2022);
-->
<?php
// Pour aborder le probleme il faut passer par deux variables pour afficher en français le jour et le mois 
//en convertissant les n° "01 pour Janvier" "02 pour fevrier" "03 pour mercredi" au moyen d'un tableau
// de variable dont l'index représentera le jour ou le mois
function frenchDate(){
        $m = ["janvier","fevrier","mars","avril","mai","juin","juillet",
        "aout","septembre","octobre","novembre","decembre","" ];// chq mois correspond a un index qui sera appelé 
                    // par l'argument n du format date"n" qui renvoie le n° du mois auquel on retranche -1 
                    // parce que l'index commence à "0"
        $d = ["dimanche","lundi","mardi","mercedi","jeudi","vendredi","samedi"];
        $today = $d[date("N")];// renvoie le chiffre du jour de la semaine
        $month = $m[date("n")-1];// renvoie le chiffre du mois sans le "0"
        $jour = date("j"); // renvoie le n° du jour
        $annee = date("Y");// renvoie le chiffre de l'année 
        return "$today $jour $month $annee";
}
echo frenchDate(); // renvoie jeudi 25 aout 2022

?>
<hr>
<!-- 
    ----------------------------Exercice D2------------------------------ 
    Utiliser la fonction précédement créé pour afficher la date 
    puis l'heure depuis laquelle l'utilisateur visite le site.
    On utilisera les sessions.
-->
<?php
// session_start(frenchDate);
// echo session_id(),"<br>";
// $_SESSION(duree);
// echo session_id(duree),"<br>";
// var_dump($_COOKIE["duree"]);



?>
<hr>
<!-- 
    ----------------------------Exercice D3------------------------------ 
    Afficher depuis combien de seconde l'utilisateur est présent sur
     le site.
-->