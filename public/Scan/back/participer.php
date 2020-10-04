<?php
session_start();
include_once("./config.php");

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['email'])) && (isset($_POST['name'])) && (isset($_POST['firstName'])) && (!empty($_POST['email'])) && (!empty($_POST['name'])) && (!empty($_POST['firstName']))){

// tester et afficher les valeurs récupérées
// test and display the recovered values
/*
    foreach($_POST as $key => $value){
        test_input($_POST);
        echo $key, "=", $value, "<br/>";
    }
*/    
//creer un fichier '$_POST[email].txt' dans repo /participants et y écrire les données récupérées
// create a file '$ _POST [email] .txt' in repo / participants and write the recovered data
    $email = test_input($_POST['email']);
    $name = test_input($_POST['name']);
    $firstName = test_input($_POST['firstName']);
    $datasInput = $email.';'.$name.';'.$firstName;
    $file = $email.'.txt';
//vérifier si l'email est déjà rentrer
// check if the email is already in
    if (file_exists(".././participants/$file")) {
        echo "Vous avez déjà participé !";
    }else{
        fwrite(fopen(".././participants/$file",'w+'),$datasInput);
        fclose(".././participants/$file");

        echo "<a href='.././index.php'>Retour</a><br/><br/>";
        echo "Bonne chance et merci d'avoir participer au grand jeu ".constant("TITLE_1")." :<br/><br/>";
    }
} else{
    echo "<a href='.././jeu.php'>Retour</a><br/><br/>";
    echo "Il y a une erreur de saisie";
}