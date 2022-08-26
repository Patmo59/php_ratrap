<?php 
#------------------------------------------------------------------------
echo "<h1> déclaration des fonctions. </h1><hr>";
/*
    Pour déclare une fonction en PHP, on utilisera le mot clef "function" suivi 
    du nom de la fonction, puis des parenthèses et enfin des accolades
    dans les lesquels ont placera les instructions de notre fonction.
*/
function salut(){
    echo "Salut tout le monde ! <br>";
}
// Pour appeler une fonction, il suffit d'écrire son nom suivi de "()";
salut();
/*
    PHP lira les déclaration de fonction avant de lire le reste du code.
    On pourra donc appeler une fonction, avant sa déclaration.
*/
salut1();
function salut1(){
    echo "Salut les autres ! <br>";
}
$isTrue = true;
/* 
    Une fonction conditionnelle, (fonction déclaré dans une condition)
    ne peut être appelé avant sa déclaration.
*/
if($isTrue){
    // retourne une erreur.
    // salut2();
    function salut2(){
        echo "Salut moi même ! <br>";
    }
    salut2();
}
/*
Attention de bien vérifier que la fonction est déclaré avant de 
l'appeler.
*/
if($isTrue)salut2();
/*
Une fonction peut se contenter d'effectuer des actions, mais aussi 
peut retourner des informations. 
Pour cela on utilisera le mot clef "return",
Ce mot clef mettra fin à la fonction et retournera la valeur qui suis.
Il est aussi possible d'utiliser return sans valeur à retourner,
Juste pour mettre fin à la fonction.
*/
function aleaString(){
    $r = rand(0,100);
    // si $r est plus petit que 50, je met fin à la fonction
    if($r<50)return;
    // sinon je retourne la valeur de $r sous forme de string.
    return (string)$r;
}
// On peut utiliser la valeur de retour directement dans une autre fonction
echo aleaString(), "<br>";
// Ou alors l'assigner à une variable.
$alea = aleaString();
echo "$alea <br>";
#------------------------------------------------------------------------
echo "<h1> Les arguments. </h1><hr>";
/*
    Entre les parenthèses de la déclaration de fonction, nous pouvons
    avoir entre 0 et l'infini arguments. Ces arguments seront séparé d'une virgule.
    Quand on appelle une fonction avec un argument, la valeur donnée 
    est transmise à la variable déclaré en tant qu'argument.
*/
function bonjour($nom){
    echo "Bonjour $nom ! <br>";
}
// Ici $nom prend la valeur "Maurice";
bonjour("Maurice");
// Si on ne donne pas exactement le même nombre d'argument, cela retourne une erreur !
// bonjour();
// bonjour2("Maurice");
function bonjour2($n1, $n2){
    echo "Bonjour $n1 et $n2 ! <br>";
}
bonjour2("Maurice", "Charli");
// Il est possible de déclaré une fonction, qui prend un nombre d'argument infini.
function bonjour3(...$noms){
    // $noms devient un tableau contenant tous les arguments.
    foreach($noms as $n){
        echo "Salut $n ! <br>";
    }
}
bonjour3("Maurice", "Charli", "Pierre");
// il est possible de donner à nos arguments, des valeurs par défaut.
// Dans ce cas, l'argument devient optionnel.
function bonjour4($n1, $n2 = "personne d'autre"){
    // les arguments obligatoires sont placés avant les optionnels.
    echo "Bonjour $n1 et $n2 ! <br>";
}
// Si je donne un seul argument, le second prendra sa valeur par défaut.
bonjour4("Maurice");
// Si j'en donne deux, le second oubliera la valeur par défaut.
bonjour4("Maurice", "Charli");
/*
Quand on donne un argument via une variable, la variable de base n'est pas changée, seulement la valeur est transmise.
*/
function titre($nom){
    $nom .= " le grand";
    return $nom;
}
$maurice1 = "Maurice";
$maurice2 = titre($maurice1);

//    La valeur de $maurice1 n'a pas changé.
echo "$maurice1 est devenu $maurice2 ! <br>";
/*
    Mais il est possible de changer la valeur d'une variable donnée 
    en argument. C'est ce qu'on appelle, 
    passer les arguments par référence.
*/
function titre2(&$nom){
    $nom .= " le grand";
}
titre2($maurice1);
echo "Voici $maurice1 !";
#------------------------------------------------------------------------
echo "<h1> récurcivité </h1><hr>";
/* 
Une fonction récurcive, est une fonction qui s'appelle elle même.
De ce fait, il faudra faire attention de bien prévoir une façon
de sortir de la récurcivité, sinon nous somme dans une boucle infini.
*/
function decompte($n){
    // action à réaliser
    echo $n, "<br>";
    // condition de sortie
    if($n<= 0)return;
    // récurcivité
    decompte(--$n);
}
decompte(5);
#------------------------------------------------------------------------
echo "<h1> Typage et Description </h1><hr>";
/*
    Sur les dernières versions de PHP, il est possible, conseillé bien 
    que non obligatoire, de typer ses arguments et valeur de retour, 
    ainsi que de décrire ses fonctions.

    faire ceci ne va pas changer le fonctionnement de votre code, 
    mais permettra de s'y retrouver plus facilement si vous y revenez
    plus tard ou si votre code est repris par un autre.
*/
/**
 * Cette fonction retourne la présentation du personnage.
 * 
 * Les arguments doivent être le nom de l'utilisateur,
 * l'âge et un boolean indiquant si il travaille ou non.
 *
 * @param string $nom
 * @param integer $age
 * @param boolean $travail
 * @return string
 */
function presentation(string $nom, int $age, bool $travail): string{
    return "Je m'appelle $nom et j'ai $age ans. Je "
        . ($travail?"travaille":"ne travaille pas") ."!<br>";
}
echo presentation("Maurice", 54, false);
#------------------------------------------------------------------------
echo "<h1> Portée des variables et static </h1><hr>";
// une variable déclarée hors d'une fonction,  ne sera pas accessible dans celle ci.
$z = 5;
// $z est déclarée hors de tout block, on dit qu'elle est global.
function showZ(){
    // echo $z;
    /* le premier echo ne fonctionne pas car $z est global, donc 
    inexistante dans la fonction. 
    mais avec le mot clef "global" on peut appeler une variable 
    définie globalement.*/
    global $z;
    echo $z;
}
showZ();
echo "<br>";
/*
    Normalement, une variable déclarée dans une fonction, est détruite à la fin de celle ci.
    Le mot clef "static", permet de garder cette variable en sauvegarde.
*/
function compte(){
    $a = 0;
    static $b = 0;
    // $b ne sera déclaré à 0 que la première fois que la fonction est appelée. Ensuite il gardera sa valeur.
    echo "a : $a <br> b : $b <br>";
    $a++;
    $b++;
}
compte();
compte();
compte();
compte();
#------------------------------------------------------------------------
echo "<h1> Fonction anonyme, flechée, et callback </h1><hr>";
/*
    Bien que rarement utilisées, il est possible de créer des fonctions anonymes et fléchées en PHP.
    Une fonction anonyme est une fonction qui ne porte pas de nom.
    Elle sera soit rangée dans une variable, soit utilisé en callback d'une autre fonction. (Un callback est une fonction donnée en argument d'une autre fonction)

    Une fonction fléchée, est une version raccourcie de la fonction anonyme.
*/
$tab = ["sandwich", "ramen", "pizza"];
/**
 * Cette fonction prend un tableau et utilise la fonction donné 
 * en callback pour afficher le contenu du tableau.
 *
 * @param array $arr
 * @param callable $func
 * @return void
 * */
//
 //le type callable indique que cet argument peut etre appelé
function dump(array $arr, callable $func): void{
    foreach($arr as $a){
        $func($a);
        echo "<br>";
    }
}
dump($tab, function($x){echo $x;});
dump($tab, fn($x) => var_dump($x));
// la fonction ne peut etre employée avant sa déclaration

$superfunction
= function($x){
        print($x);

};
// je donne ma variable en callback de ma fonction dump
dump($tab, $superfunction);


?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>