<?php
//mettre en commentaire pour le debogage
// comment for debugging
error_reporting(0);

//constante noms des pages
//const page names
define("TITLE_1", "Mon Super Site Web");
define("TITLE_2", "Le grand Jeu Mon Super Site Web");
define("TITLE_3", "Login");
define("TITLE_4", "Admin");

//constante login
//const login
define('LOGIN','admin');
define('PASSWORD','hello');

//fonction test des inputs, vérifie et sécurise les données reçues
// input test function, checks and secures the received data
function test_input($data){
    $data = trim($data);
    $data = htmlentities($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}