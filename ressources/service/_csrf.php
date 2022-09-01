<?php
if(session_status() === PHP_SESSION_NONE)
    session_start();
    /**
     * Parametre un token en session et ajoutye un imput:hidden contenant ce token
     * optionnellment ajoute un temps avant l'expiration du token
     * 
     *
     * @param integer $time
     * @return void
     */
function setCsrf(int $time = 0): void{
    if($time>0)
    $_SESSION["tokenExpire"]= time() + 60 *$time;
/**
 * Random-byts va retourner un nopmbre d'octet aléatoire d'une longeur donnée en parametre.
 * bin2hex convertit  en hexadecimal
 */
    $_SESSION["token"] = bin2hex(random_bytes(60));
    echo '<input type="hidden" name="token" value="'.$_SESSION["token"].'">';
}

function isCsrfValid():bool{
    /*
     *Si tokenExpire n'esite pas ou qu'il est plsu gand que le time stamp actuel
     */
    
    if(isset($_SESSION["tokenExpire"]) || $_SESSION["tokenExpire"] >time()){
        if(isset($_SESSION["token"], $_POST["token"]) && $_SESSION["token"] == $_POST["token"])
        return true;
    }
    header($_SERVER['SERVer_PROTOCOL']. ' 405 Method Not Allowed');
    return false;
}
?>