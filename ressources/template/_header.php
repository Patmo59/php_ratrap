<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--inclus dans le titre de l'onglet la valeur de $title = "- Include"
    présents dans le code de la page  -->
    <title>Cours PHP <?php echo $title?? "" ?></title>
    <!-- <link rel="stylesheet" href="./ressources/style/style.css"> -->
    <link rel="stylesheet" href="/php_ratrap/ressources/style/style.css">
</head>
<body>
   <!--si j'ai une variable "_header", j'affiche son contenu sinon Syntaxes-->

    <header> 
        <!--si je n'ai pas de  "??" $headerTitle dans ma page PHP, il affichera "Syntaxes a la place"-->
        <h1> <?php echo $headerTitle?? "Syntaxes" ?> </h1>
    </header>
    
    <!--si je ai   "??" $mainClass?? dans ma page PHP, il affichera la Naviga@ en tenant compte du CSS  cad à gauche de la page-->
    <main class="<?php echo $mainClass?? "" ?>">

        <!--j'ai retiré les balises de fin pour les placer dans le fichier "_footer"-->
