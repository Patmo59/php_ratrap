<?php
if(session_status() === PHP_SESSION_NONE)
session_start();

// la liste des caractères acppetes dans le captcha 
$caracters ="ABCDEFGHIJKLMNOPQRSTUVWXYZ012346789";
/**Génère une chaine de caractères aléatoires 
 * 
 * @param string $ carcters
 * @param integer $strenght
 * @return string
*/
function generateString(string $caracters, int $strenght = 10):
string{
    $randStr = "";
    for( $i = 0; $i < $strenght; $i++){
        $randStr .= $caracters[rand(0,strlen($caracters)-1)];
        //  equivalent à : $randStr = $randStr . $caracters[rand(0,strlen($caracters)-1)]
    }
    return $randStr;
}
$image = imagecreatetruecolor(200,50);
//genere une nouvelle image de largeur et hauteur qui est un objet de classe GdImage
//active les fonctions d'antialias pour améliorer la qualité de l'image

imageantialias($image, true); // anticrénelage 

$colors =[];
$red = rand(125,175);
$green = rand(125,175);
$blue = rand(125,175);

for ($i=0;$i<5;$i++){
    /** Prend un objet GdImage en 1er argument, puis 3 valeurs numériques
     *  représentant les niveaux de couleur RGB
     * Retourne un INT représentant un identifiant pour la couleur générée ainsi */

    $colors[]= imagecolorallocate(
        $image,
        $red    - 20 * $i, 
        $green  - 20 * $i,
        $blue   - 20 * $i
    );
}

imagefill($image, 0,0, $colors[0]);
    for ($i=0;$i<10;$i++){
        imagesetthickness($image, rand(2,10));
    }
for($i=0;$i<10;$i++){
    //parametre une largeur pour les lignes (en px)
    imagesetthickness($image,rand(2 , 10));
    /*dessine un rectangle dans l'image donnée en 1er argument, prend la position de départ (x,y)
    donnée en 2ème argument, position de fin en 3ème argument et position xy en 4ème et 5ème argument
    la couleur est donnée en 6ème argument
    */
    imagerectangle(
        $image,
        rand(-10 , 190),
        rand(-10,10),
        rand(-10, 190),
        rand(40,60),
        $colors[rand(1,4)]
    );
}
$textColors = [
    imagecolorallocate($image,0,0,0),
    imagecolorallocate($image,255,255,255),
];
$fonts = [
    __DIR__ .'/../font/Acme-Regular.ttf',
    __DIR__ .'/../font/arial.ttf',
    __DIR__ .'/../font/typewriter.ttf',
];
// je choisis une taille pour le string de mon captcha
$strLength = 6;
// je genere mon string aléatoire
$captchaStr = generateString($caracters,$strLength);
// je sauvegarde mon string en session
$_SESSION["captchaStr"]= $captchaStr;


for($i=0; $i<$strLength;$i++){
    /**Choix de l'espacement pour les lettres ainsi que la position initiale */
    $letterSpace = 170/$strLength;
    $initial = 15;

    /**  imagettftext permet d'écrire  dans l'image en 1er Argument, à la taille donnée en 2ème argmt,
     * penchées selon l'angle donné en 3ème argmt, à la position (x,y) 
     * donnée en 4 ème et 5ème argumt, de la couleur donnée en 6ème argmt,
     * le texte donné en 8ème argmt
     */

    imagettftext(
        $image,
        24,
        rand(-15,15),
        $initial + $i * $letterSpace,
        rand(25, 45),
        $textColors[rand(0,1)],
        $fonts[array_rand($fonts)],
        $captchaStr[$i]
    );
}
// indique en entête de notre fichier qu'il est de type image/png.
header("Content-type: image/png");
//converti notre objet GdImage au format png
imagepng($image);
?>
