<?php
session_start();
include_once("./config.php");

// premier fichier pour début tp, fonctionnalités transférées vers authentification.php
// first file for start tp, features transferred to authentication.php

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['login'])) && (isset($_POST['password']))){
//var_dump($_POST);
        //tester les valeurs récupérées
        // test the retrieved values
        $login = test_input($_POST['login']);
        $password = test_input($_POST['password']);
        if (($login == 'admin') && ($password == 'hello')) {
            echo 'Bonjour Admin,  ceci est votre
            tableau de bord';
        }else{
            header('Location: http://localhost:8080/login.php');
        }
} else{
//var_dump($_POST);
    echo "<a href='.././login.php'>Retour</a><br/><br/>";
    echo "Il y a une erreur de saisie";
}
