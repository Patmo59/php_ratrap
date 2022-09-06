<?php
//préparation
session_name("PFCSESSION");
session_start();

$plS = $aiS ="";
$signs = ["p","f","c"];
$message = "Choisis !";
if(!isset($_SESSION["score"])) start();
//gestion des formulaires
if($_SERVER["REQUEST_METHOD"]== "POST"){
    if(isset($_POST["sign"]) && in_array($_POST["sign"], $signs)){
        $message = checkWin();
        header("refresh:2");
    }
}
// décloaration de fonctions
function start(){
    $_SESSION["score"] = ["ai"=> 0,"pl"=> 0];
    $_SESSION["signs"] = ["p"=> 0,"f"=> 0,"c"=> 0, "t"=>3];
}
function checkWin(){
    global $plS, $aiS;
    $plS = $_POST["sign"];
    $aiS = selectAI();
    $_SESSION["signs"][$plS]++;
    $_SESSION["signs"]["t"]++;
    if($plS === $aiS)
        return "Egalité!";
        elseif(
            ($aiS=== "c" && $plS === "p")||
            ($aiS=== "p" && $plS === "f")||
            ($aiS=== "f" && $plS === "c")
        ){
            $_SESSION["score"]["pl"]++;
                return "Gagné !";
        }
}
function selectAI(){
    $r = rand(0,100);
    $tp = $_SESSION["signs"]["p"]/$_SESSION["signs"]["t"]*100;
    $tf = $_SESSION["signs"]["f"]/$_SESSION["signs"]["t"]*100;
    return $r < $tp ? "f":($r < ($tf+$tp)? "c":"p");
}
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pierre Feuille Ciseaux</title>
</head>
<body>
    <!-- div.interface<div.score+div.message -->
    <div class="interface">
        <div class="score">
            <?php
                echo "IA : {$_SESSION['score']['ai']}| vous:{$_SESSION['score'] ['pl']}";                    
            ?>
        </div>
        <div class="message">
            <?php echo $message ?>
        </div>
    </div>
    <!-- div.zoneIA>div.card-wrapper*3>div.card>(div.front>img)+div.back -->
    <div class="zoneIA">
        <div class="card-wrapper">
            <div class="card">
                <div class="front"><img src="" alt=""></div>
                <div class="back"></div>
            </div>
        </div>
        <div class="card-wrapper">
            <div class="card <?php echo $aiS == ""? "reveal":"" ?>">
                <div class="front">
                    <img src="" alt="Ciseaux">
                </div>
                <div class="back"></div>
            </div>
        </div>
        <div class="card-wrapper">
            <div class="card">
                <div class="front"><img src="" alt=""></div>
                <div class="back"></div>
            </div>
        </div>
    </div>
    <!-- div.zonePlayer>div.card-wrapper*3.card>(div.front>img)+div.back>form:post>input:hidden+input:image -->
    <div class="zonePlayer">
        <div class="card-wrapper">
            <div class="card <?php $plS == "p"? "reveal": "" ?>"></div>
            <div class="front">
                <img src="" alt="Pierre">
            </div>
            <div class="back">
                <form action="" method="post">
                    <input type="hidden" name="sign" value="p">
                    <input type="image" src="" alt="Pierre">
                </form>
            </div>
        </div>
        <div class="card-wrapper">
            <div class="card <?php $plS == "f"? "reveal": "" ?>"></div>
            <div class="front">
                <img src="" alt="Feuille">
            </div>
            <div class="back">
                <form action="" method="post">
                    <input type="hidden" name="sign" value="f">
                    <input type="image" src="" alt="Feuille">
                </form>
            </div>
        </div>
        <div class="card-wrapper">
            <div class="card <?php $plS == "c"? "reveal": "" ?>"></div>
            <div class="front">
                <img src="" alt="Ciseaux">
            </div>
            <div class="back">
                <form action="" method="post"> 
                    <input type="hidden" name="sign" value="c">
                    <input type="image" src="" alt="Ciseaux
                    
                    
                    
                    
                    ">
                </form>
            </div>
        </div>
    </div>
</body>
</html>