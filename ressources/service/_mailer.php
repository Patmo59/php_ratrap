<?php
/**
 * L'envoi des mails depuis le local peut etre une plaie à configurer ; 
 * de plus cela demanderait de modifier certains parametres php. 
 * Pour rendre les choses plus simples nous utiliserons 2 outils:
 * 
 * PHPMAILER qui est une librairie simpolifia,nt grandement l'envoi des mails
 * 
 * et 
 * https://mailtrap.io qui va permettre d'intercepter les faux mails envoyés depuis le localhost 
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMPT;
use PHPMailer\PHPMailer\Exception;
/**
 * Ensuite si on a fait l'installation via Composer
 * On va pouvoir utiliser autolaoder de composer
 * CEluisic va permettre d'utiliser les classes de nos bibliothèques sans avoir besoin 
 * de les require
 */
require __DIR__ . "/../vendor/autoload.php";
/**
 * Envoi d'un mail
 * 
 * @param string $from
 * @param string $to
 * @param string $subject
 * @param string $body
 * @return string
 */
function sendMail(string $from,string $to,string $subject,string $body): string
{
    /**
     * J'instanciez un nouvel objet phpMailer
     * le parametre à true  permet d'activier les erreurs sous sorme d'execption
     */
    $mail = new PHPMailer(true);
    try {
        /**
         * parametre du serveur :
         * on active l'utilisation de SMPT : (Simple Mail Transfer Protocol)
         */
        $mail -> isSMTP();
        /**
         * on indique ou est hebergé le serveur de mail
         */
        $mail-> Host = "smtp.mailtrap.io";
        /**
         * on active l'authentification par SMTP
         */
        $mail ->SMTPAuth= true;
        /**
         * on indique par quel port du serveur le mail va passer
         */
        $mail ->Port = 2525;
        /**
         * on place l'username et le password
         */
        $mail->Username = 'fb28071dc7cdfc';
        $mail->Password = '10b3123df34645';
        /**
         * $mail->SMTPDebug = SMTP::DEBUG_SERVER;
         */
        /**
         * Le type de chiffrement utilisé pour envoyer le mail. ici
         * je ne l'utiliserai pas car il peut entrer en conflit avec mailtrap
         */
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTP;
        /**
         * Expediteur et Destinataire
         * "setFrom" prendra l'adresse de l'expediteur et optionnellement un nom
         */
         $mail->setFrom($from);
        /**
         * addAdress ajoute un destinaitaire
         */
        $mail->addAdress($to);
        /**
         * addReplyTo permet d'indiquer à qui on repond
         * addCC  permet d'ajouter une copie
         * addBCC  permet d'ajouter une copie cachée
         * 
         * * PIECE JOINTE
         * addAttachment ($path,$name)ajoute le fichier doné en premeier  argmt comme piece jointe et le renome si
         * lez 2ème est donné
         * 
         * *copnenu
         * isHTML indique que le format du mail est du html
         *
         */
        $mail->isHTML(true);

        $mail->Subject= $subject;
        $mail->Body= $body;
        /**
         * AltBody pour ajhoouter un corps différent pour les applications
         * qui ne gèrent pas le HTML

         *Enfin il ne nous reste plus qu'à envoyer le tout          */
        $mail-> send();
        return "message envoyé";
        
    }catch (Exception $e){
        return " Le message n'a pas pu être envoyé. Mailer Error :
        {$mail -> ErrorInfo}";
    }
}

?>