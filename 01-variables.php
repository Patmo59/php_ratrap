<h1>bonjour tout le monde</h1>

 <?php 
 echo "hello world";
echo "<br>";
var_dump("hello world", 10);
echo "<br>";
var_export("Salutations");
echo "<br>";  //le ; est obligatoire pour valider la lifgne, sauf avant le \?\>

print_r("test");  // le site de documentation php.net est en français

//phpinfo();  // renvoie toute les infos relative au serveur

echo getenv("SERVER_NAME");
#-------------------------------------------------------------------------
echo" <H1> Déclarations des Variables </H1> <hr>";
$banane;
// var_dump($banane);

$banane ="jaune";
echo "banane : ", $banane, "<br>";

//constante
define("AVOCAT","vert"); 
echo "avocat : ", AVOCAT, "<br>"; // on ne change pas la valeur d'une constante
var_dump(get_defined_vars());  //permet de recupérer toutes les variables actuellement définies

//variables dynamiques : 

$fruits ="fraise";
$$fruits  ="rouge";
echo "<br>", $fraise, "<br>";  // la variable reprend la valeur de $fruit
echo "<br>", $$fruits, "<br>";  // la variable reprend la valeur de $fruit

//on peut supprimer une variable via unset()
unset($banane);

var_dump(get_defined_vars());  // il n'y a plus banane dans le tableau get defined

#-------------------------------------------------------------------------
echo" <H1> Types des Variables </H1> <hr>";
//declaration de variables
$num = 5;
$dec = 0.5;
$str = "coucou";
$arr = [];
$boo= true;
$nul = NULL;
$obj = (object)[];
//affichage des variables
echo gettype($num), "<br>";
echo gettype($dec), "<br>";
echo gettype($str), "<br>";
echo gettype($arr), "<br>";
echo gettype($boo), "<br>";
echo gettype($nul), "<br>";
echo gettype($obj), "<br>";

#-------------------------------------------------------------------------
echo" <H1>Chaines de Caractères</H1> <hr>";
echo "bonjour", 'Salut' ,`Coucou`, "<br>";// eviter "les" backticks"

echo "ceci est une message
si long qu'il tient 
sur plusieurs lignes";  // ne tiendra que sur une ligne dans le navigateur
echo"<hr>";
echo "ceci est une message ,<br>";
echo "si long qu'il tient,<br>" ;
echo "sur plusieurs lignes,<br>";  // ne tiendra que sur une ligne dans le navigateur
echo"<hr>";


$nom = "maurice";
$age = 54;

echo "$nom  a $age.<br>";

echo '$nom  a $age.<br>';
// php  la concatenation se fait à l'aide d'un point "."
echo $nom. " a ". $age ." ans. <br>";
//équivalent à $nom = $nom;"DUPONT";
$nom .= " DUPONT";
echo $nom ,"<br>";

"<br>";
echo strlen($nom),"<br>";
echo str_word_count($nom),"<br>";
echo strrev($nom),"<br>";
echo strpos($nom, "DU"),"<br>";
echo $nom[8],"<br>";

echo str_replace( "ce", "cette", $nom), "<br>";

#-------------------------------------------------------------------------
echo" <H1>NOMBRES</H1> <hr>";

// IL EST POSSIBLE DE PREFIXER LES NOMBRES POUR INDIQUER LEUR BASE;  #0b pour binaire
$bin = 0b10000;

echo"\$bin = $bin <br>";

# " 0" pour octale ;
$oct = 020;
echo"\$oct = $oct <br>";

$dec =16;
echo"\$dec = $dec <br>";

$hexa = 0x10;
echo"\$hexa = $hexa <br>";

var_dump("3.14 is int ?", is_int (3.14));
echo "<br>";

var_dump("3.14 is float ?", is_float (3.14));
echo "<br>";
echo PHP_INT_MAX , "<BR>" , PHP_INT_MIN ,"<br>";
echo PHP_FLOAT_MAX , "<BR>" , PHP_FLOAT_MIN ,"<br>";

var_dump("le string '0123456' est il un nombres ?", is_numeric("0123456"));
echo "<br>";


var_dump((int)"42A", (int)3.14);
echo"<br>";
var_dump((int)"42A", (string)3.14);// 3.14 devient une chaine de caractères


//opérateur mathematiques

echo "<br>";
echo "1+1=", 1+1 , "<br>";
echo "1-1=", 1-1 , "<br>";
echo "2*2=", 2*2 , "<br>";
echo "8/4=", 8/2 , "<br>";
//modulo retourne le reste d'une division
echo "11%3=", 11%3 , "<br>";
//puissance
echo "2**4=", 2**4 , "<br>";

$x =5;
$x += 2;
$x-= 3;
$x *= 4;
 $x /=2;
 $x %= 3;
 echo $x,"<br>";
 echo"<hr>";
 echo $x++, "-->" , $x, "<br>";
 echo ++$x, "-->" , $x, "<br>";
 echo $x--, "-->" , $x, "<br>";
 echo --$x, "-->" , $x, "<br>";
 
 
 #-------------------------------------------------------------------------
 echo" <H1>Les Tableaux</H1> <hr>";

$a = array("banane","pizza","avocat");
$b = ["banane","pizza","avocat"];

//echo  $a ; // echo ne fonctionnne pas suir un tableau

var_dump($a,$b);
// la balise "<pré>" "</pre>" permet de gader la mise en forme
echo "<pre>".print_r($b,1). "</pre>";
echo "j'aime la $a[0], la $a[1] et l'$a[2] <br>";

echo count($a), "<br>"; // donne la taille du tableau  3

$b[]= "fraise"; // ajoute au tableau "fraise"
echo "<pre>".print_r($b,1). "</pre>";


$person = ["prenom"=>"Maurice", "age"=>52];
echo "<pre>".print_r($person,1). "</pre>";
// tableau associatif
// on crée une nouvelle clé pour un ajour si la clé n'existe pas
//tableau multidimmentionnnel = tableau qui contient au moins un autre tableau
echo $person ["prenom"] ."a" . $person["age"] . "ans. <br>";
$person["loisir"] = ["pétanque","bowling"];
//pour selectionner un tableau multidim i faudra écrire les clefs les unes après les autres ¤array[1][0][3...]
echo "<pre>".print_r($person,1). "</pre>";
echo $person["loisir"][0], "<br>";  //pétanque

//supression d'un element du tableau utiliser unset
echo "SUPPRESSION";
unset($b[1]);
echo "<pre>".print_r($b,1). "</pre>"; // on retrouve un pb avec le suivi des index ; pour y reemedier 
$b = array_values($b);
var_dump($b);

//autre façon de faire

array_splice($a,1,1);
echo "<pre>".print_r($a,1). "</pre>"; 

// pour remplacer 
echo "REMPLACER";

array_splice($a,0,1,["brocili","pamplemouse"]);
echo "<pre>".print_r($a,1). "</pre>"; 

// pour fusionner
echo "FUSIONNER";
$ab = array_merge($a,$b);
echo "<pre>".print_r($ab,1). "</pre>"; 

echo"TRIER";
sort($ab);
echo "<pre>".print_r($ab,1). "</pre>"; // rsort() pour trier en ordre descendant
//pour les tableaux associatifs  asort(); par ordre croissant des valeurs , ksort(); pour trier les cléfs par ordre croissant, 
//arsort et krsort en décroissant 



#-------------------------------------------------------------------------
echo" <H1>Boolean</H1> <hr>";


$t = true;
$f = false;
var_dump($t,$f);// il y a d'autres manières d'obtenir ces 2 valeurs

echo"<br> 5<3 : ";
var_dump(5<3);

echo"<br> 5=<3 : " ;
var_dump(5<=3);  // et ainsi de suite ,5>3 5>=3.....
echo"<br>";
echo"<br>";
echo "COMBINAISON";
echo"<br>5>3 && 5<2 : ";// on peut aussi ecire || ( ou ) ou xor : est true si l'un des deux resultat est true.
var_dump(5>3 && 5<2);

echo"<br>!(5>3 && 5<2) : ";
var_dump(!(5>3 && 5<2));



#-------------------------------------------------------------------------
echo" <H1>Les variables superglobals</H1> <hr>";

//les variables superglobals sont des variables définies par défaut dans PHP.
//Elles sont accessibles n'importe où dans votre code

//echo "<pre>".print_r($GLOBALS,1); "</pre>"; 

//echo "<pre>".print_r($_SERVER,1); "</pre>"; contient les information liées au serveur

//echo "<pre>".print_r($_REQUEST,1); "</pre>"; contient les information liées au serveur


//echo "<pre>".print_r($_POST,1); "</pre>"; contient les information envoyées en mode POST

//echo "<pre>".print_r($_GET,1); "</pre>"; contient les information envoyées en mode GET

//echo "<pre>".print_r($_ENV,1); "</pre>"; contient les variables d'environnement

//echo "<pre>".print_r($_COOKIES,1); "</pre>"; contient les cookies


//echo "<pre>".print_r($_session,1); "</pre>"; contient les informations stockées en session


?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
