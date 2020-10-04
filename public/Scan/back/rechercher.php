<?php
session_start();
include_once("./config.php");

// pour afficher le resultat de la recherche (si connecte en tant qu'admin)
// to display the search result (if logged as admin)

if (($_SERVER["REQUEST_METHOD"] == "GET") && (isset($_GET['search']))) {
    
    echo "<a href='../connecter.php'>Retour</a><br/><br/>";
    echo "Résultat de votre recherche :<br/>";

    $request = test_input($_GET['search']);
    $dir = dir('.././participants');

    while($getAllFileNames = $dir->read()) {
        
        $response = mb_stristr($getAllFileNames,$request).'<br/>';
        echo $response;
    }
}