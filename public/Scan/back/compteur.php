<?php
session_start();
//compter le nombre de chargement de la page (si session deconnectee)
// count the number of pages loaded (if disconnected session)

if(file_exists('./visiteurs/compteur_visites.txt')){

        $counterFile = fopen('./visiteurs/compteur_visites.txt', 'r+');
        $counting = fgets($counterFile);

}else{

        $counterFile = fopen('./visiteurs/compteur_visites.txt', 'a+');
        $counting = 0;

}

if(!isset($_SESSION['counting_visits']))
{
        $_SESSION['counting_visits'] = 'visits';
        $counting++;
        fseek($counterFile, 0);
        fputs($counterFile, $counting);
}

fclose($counterFile);