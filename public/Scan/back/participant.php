<?php
session_start();
include_once('config.php');

//aller dans le dossier participants et lire chaques fichiers, afficher le nom et le prénom de tous les participants
//go to the participant folder and read each file, display the name and surname of all participants

echo "<a href='.././connecter.php'>Retour</a><br/><br/>";
echo "Voici la liste des participants au grand jeu ".constant("TITLE_1")." :<br/><br/>";

$dir = dir('.././participants');

while($getAllFiles = $dir->read()){

    $allParticipants = file(".././participants/$getAllFiles");

    foreach($allParticipants as $key => $value){

        $valueArray = explode(';',$value);
        echo '<tr><td>Nom : '.$valueArray[1].'</td><br/><td>Prénom : '.$valueArray[2].'</td></tr><br/><br/>';
    }
}