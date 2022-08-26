
<?php

#-------------------------------------------------------------------------
echo" <H1>While</H1> <hr>";

/**Les boucles permettent de repeter l'action qui se trouve entre accolades */

$x =0;
while($x < 5){  // tant que la condition est "true", l'action est répétée
    echo $x, "<br>";
    $x++;
}
echo "<hr>";
echo" 'les : ' <br>";
while($x<10):
    echo $x, "<br>";
    $x++;
endwhile;

echo "<hr>";
while($x<15)
echo $x++, "<br>";


#-------------------------------------------------------------------------
echo" <H1>Do .... While</H1> <hr>";

/**le Do While effectuera au moins une fois l'action, avant de vérifier s'il doit continuer */

do{
    echo $x, "<br>";
    $x++;
}while($x<5);

do
echo $x++, "<br>";    
while($x<20);


#-------------------------------------------------------------------------
echo" <H1>FOR</H1> <hr>";
/**Particulièrement adaptée aux valeurs numériques
 * elle est structurée ainsi
 * for (expr1,expr2,expr3,expr,...)
 * "expr1" sera éaluée avant de commencer la boucle
 * "expr2" sera évaluée au début de chaque itération  si true il continue
 */

for($y=0;$y<5; $y++){
    echo $y,"<br>";
}

for($y=0;$y<5; $y++):
    echo $y,"<br>";
endfor;

for($y=0;$y<5; $y++)
echo $y,"<br>";

#-------------------------------------------------------------------------
echo" <H1>FOR</H1> <hr>";

$a =["spaghetti","thon","mayonnaise","oignon"];

foreach($a as $food){
    
    echo $food, "<br>";
}

echo "<hr>";
// si l'on souhaite recuperer la clé qui va avc la valuer ( dans les tableaux associatifs)
echo "Avec la Clé <br>";
foreach($a as $key => $food){
    echo "$key : $food <br>";
}


#-------------------------------------------------------------------------
echo" <H1>continue et break</H1> <hr>";


foreach($a as $food){
    if($food === "spaghetti") continue;
    if($food === "mayonnaise") break;

    echo $food, "<br>";/// thon  : il arrete la boucle dès qu'il voit mayonnaise, thon est juste avant....
    // sont utilisés dans toutes les boucles.
}
  

















echo"<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>"
?>