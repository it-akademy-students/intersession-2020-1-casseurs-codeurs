<?php
include_once('./config.php');

// vérification de l'identifiant et du mot de passe
// check username and password
if(isset($_POST['login']) && (isset($_POST['password']))){

    $login = test_input($_POST['login']);
    $password = test_input($_POST['password']);
    
    if (($login !== LOGIN) || ($password !== PASSWORD) ){
        echo "<a href='.././login.php'>Retour</a><br/><br/>";
        echo "Désolé, nous ne trouvons aucune correspondance, veuillez recommencer votre saisie SVP ";
    }else{
        session_start();
        $_SESSION['login'] = LOGIN;
        header('Location: http://localhost:8080/connecter.php');
    }
}