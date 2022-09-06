<?php
if(session_status() === PHP_SESSION_NONE)
    session_start();
    /**
     * Parametre un token en session et ajoute un imput:hidden 
     * contenant ce token.Optionnellement ajoute un temps avant 
     * l'expiration du token
     * @param integer $time
     * @return void
     */
function setCsrf(int $time = 0): void{
    if($time>0)
    $_SESSION["tokenExpire"]= time() + 60 *$time;
/**
 * Random-byts va retourner un nombre d'octets aléatoires
 *  d'une longeur donnée en parametre.
 * bin2hex converti  en hexadecimal
 */
    $_SESSION["token"] = bin2hex(random_bytes(60));
    echo '<input type="hidden" name="token" value="'.$_SESSION["token"].'">';
}
function isCsrfValid():bool{
    /*
     *Si tokenExpire n'exite pas ou qu'il est plus grand que le timestamp actuel
     */
    if(isset($_SESSION["tokenExpire"]) || $_SESSION["tokenExpire"] >time()){
        if(isset($_SESSION["token"], $_POST["token"]) && $_SESSION["token"] == $_POST["token"])
        return true;
    }
    header($_SERVER['SERVER_PROTOCOL']. ' 405 Method Not Allowed');
    return false;
}
?>