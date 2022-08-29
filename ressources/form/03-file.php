<?php
/**
 * ici nous alons voir comment uploader un fichier sur notre serveur.
 * Meme si nous le faisons pas ici i est important de retnir que lorsque 
 * l'on téléverse un fichier, nous ne le mettons dans la base Bdd.
 * on va le stocker dans un dossier, pouis suavegarder le nom du fichier et/ou le chemin
*/
$error = $target_file=$target_name=$mime_type=$oldname= "";
/* $target_dir va contenir le chemin vers le dossier upload.Pour des raisons de sécurité, si vous
    comptez rendre les fichiers téléversés accessibles à vos utilisateurs il est important 
    que le dossier ne soit pas au milieu de dossiers sensibles de votre projet.
    Les utilisateurs accédant à ces fichiers pourraient  voir le chemin vers le dossier d'upload.
*/
$target_dir = "./Upload/";
// on crée un tableau des types mimes que l'on accepte pour notre télévesement.
$typesPermis = ["image/png","image/jpeg","applicxation/pdf","image/gif"];

    // Arrive-ton en Post par le formulaire que l'on a créé ?
if($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["upload"])){
    /**Lorsque l'on upload un fichier, le serveur va le sauvegarder dans un dossier
     * temporaire et le supprimera ue fois l'execution du script terminé.
     * on va verifier que ce fichier correspond bien à nos attentes, avant de la dépalcer ailleurs.
     * La première étape est de vérifier si upload du fichier s'est bien passé et 
     * qu'il existe bel et bien dans le dossier temporaire.
     * on n'utilise pas $_GET ou $_POST  mais $_FILES. L'input nommé ici  "fichier" on va chercher 
     * $_FILES["fichier"] ; cette entrée est ell meme un tableau associatif comportant plusieurs informations:
     *  la 1ère est "tmp_name qui est l'adresse du nfichier temporaire : on utrilise "is_upload_file()" 
     * pour verifier qu'il a bioen été téléversé  */
    if(!is_uploaded_file($_FILES["fichier"] ["tmp_name"])){
        $error = " Veuillez sélectionnner un fichier";
    }else{
        $oldname = basename($_FILES["fichier"] ["name"]);
        /*
         * Le seconde étape est de préparer un nouveau nom pour notre fichier .... Pourquoi ? 
        *que se passet-il si deux utilisateur téléverse un fichier tel que CV.pdf? 
        *le seconbd fichier écrasera le prmeie  
        * pour éviter cela on va renommer les fichier grace à la fonction "uniqid()"; 
        *elle peut etre utilisée sans argument et produira 13 caractères aléatoires.
         ! (Attention  à ne pas utiliser pour la sécurité )
        *"uniqid( "" , true)" Avec son 2ème argument a True , on passera à 23 caractères
        *"uniqid('chaussette' ) le 1er argument permet de préfixer l'id.
        */

        /* dans l'exemple cidessous, on va se retrouver avec un nom composé du timestamp 
        *actuel suivi d'un tiret, puis de 23 caractères aléatoires, puis d'un tiret et de 
        l'ancien nom du fichier. Pu de chances d'aoir des doublons */
        $target_name = uniqid(time()."-", true) ."-".$oldname;
        /**on concatène le chemin vers le dossier d'upload au nouveau nom de notre fichier.
         * on ne le ferra pas ici, mais on pourrait vouloir créer un dosier par utilisateurs, 
         * ou un dossier par mois par exemple ; dans ce cas on pourait utiliser : is_dir()
         * pour verifier si le dossier existe et mkdir() pour créer le nouveau dossier.
         * on aurrait plus qu'à ajouter ce dossier à notre concaténation.
         */
        $target_file =$target_dir.$target_name;

        /**
         * on récupèe le type mime du fichier dans sa zone temporaire.
         * sir internet, on pourra tyrouver d'autres aières de faire pour vérifier l'extension 
         * d'un fichier ; cette dernière se change très facilement, ce qui n'est pas "secure"
         */
        $mime_type = mime_content_type($_FILES["fichier"] ["tmp_name"]);

        /** File_exist() permet de verifier l'existence du fichier; il prend en argument 
         * le chemin vers un fichier. Dans notre cas, très peu de chance que cela arrive, mais
         *  cela peut etre utile dans d'autres cas*/
        if(file_exists($target_file)){
            $error = "Ce fichier existe déjà";
        }
        /**
         * on vérifie la taille du fichier pour éviter que jnotre utilisateurs ne remplisse notrte serveur de plusieurs mega-octets.
         */
        if($_FILES["fichier"]["size"]> 500000){         /* équivalent à petite image  500ko*/
            $error = " Ce fichier est trop volumineux !";
        }  
        /**
         * on verifie si le type mime fait partie ou non des type acceptés
         */
        if(!in_array($mime_type,$typesPermis)){
            $error = "Ce type de fichier n'est pas accepté ";
        }
        /**
         * si notre variable $error est vide
         */
        if(empty($error)){
            /**
             * on utilise move_uploaded_file() pour déplacer notre fichier depuis son emplacement 
             * temporaire vers son emplacement final assorti de son nouveau nom.
             * Cette fonction retourne un booléen indiquant si le déplacement  s'est passé sans problème ; 
             * on place la fonction directement dans une condition pour indiquer ou non le problème.
             * on aurrait aussi pu écrire : $uploaded = move_uploaded_file($from, $to);
             * if(uploaded)
             */
            if(move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file)){
                /**Si tout s'est bien passé, on arrivera ici et il nous restera plus qu'à enregistrer
                 *  le nom du fichier et/ou le chemin dans la Bdd */
            }else{
                $error =" Erreur lors de l'upload";
            }
        }
    }
}

$title = " UPLOAD ";
$headerTitle = "Téléversement";
require("../template/_header.php");
?>
    <form action="" method="post" enctype="multipart/form-data">
    <label for="fichier">Choisir un fichier</label>
    <input type="file" name="fichier" id="fichier">
    <input type="submit" value="Envoyer" name="upload">
    <span class="error"><?php echo $error??"" ?></span>
</form>
<?php
if(isset($_POST["upload"]) && empty($error)): ?>
<p>
    Votre fichier a bien été téléversé sous le nom " <?php echo $target_name ?>".<br>
    <a     href="<?php echo $target_file ?>"
    download="<?php echo $oldname ?>">ICI</a>
</p>
<?php
endif;
require("../template/_footer.php");
?>
