<?php 
    /*
        1. Cette page n'est accessible que si on est connecté et que le message selectionné appartient 
            bien à l'utilisateur connecté. 
        2. affiche un formulaire d'édition, le traite puis redirige vers la page read.php
        3. Ajout de flash message en session.
    */
require "../../../service/_isloggedV2.php";
isLogged(true, "../connexion.php");



?>