<?php
$headerTitle = $title = "Session Page 2";
require("./ressources/exercice/template/_header.php");
?>
<!-- 
    
    ----------------------------Exercice B1------------------------------ 
    Soit x un chiffre donné, écrire un algorythme qui affiche les 10 chiffres suivants.
-->
<?php
$x = 5;
for($i = $x+1; $i<= $x+10; $i++){
    echo $i, "<br>";
}
?>
<!-- 
    ----------------------------Exercice B2------------------------------ 
    Soit y un chiffre donné, écrire un algorythme qui affiche les tables de multiplication jusqu'à 10
    de ce chiffre.
-->
<?php 
$y = 73;
for($i = 1; $i<=10; $i++){
    echo "$y * $i = ". $y*$i."<br>";
}
?>
<!-- 
    ----------------------------Exercice B3------------------------------ 
    Soit z un chiffre donné, écrire un algorythme qui affiche la factoriel de z.
-->
<?php
$z = 4;
$total = 1;
for($i = 1; $i<=$z; $i++){
    $total *= $i;
}
echo "La factoriel de $z vaut $total . <br>";
?>
<!-- 
----------------------------Exercice B3------------------------------ 
Soit a un tableau de dix nombres, écrire un algorythme qui affiche le plus grand nombre dans ce tableau.
ainsi que la position de ce dit nombre.
-->
<?php
$a = [67, 98, 34, 38, 85,56, 0, 12, 96, 85];
$b = [];
for($i = 0; $i<10; $i++){
    $b[]= rand(0, 100);
}

$max = $pos = 0;
foreach($a as $k => $v){
    if($k == 0 || $max < $v){
        $max = $v;
        $pos = $k;
    }
}
echo "Le plus grand nombre est $max et se trouve à la position $pos. <br>";

rsort($b);
echo "Le plus grand nombre est $b[0] et se trouve à la position 0. <br>";

?>
<?php
require("./ressources/exercice/template/_footer.php");
?>