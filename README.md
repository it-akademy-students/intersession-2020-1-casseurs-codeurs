<a href="http://erre-tec.hd.free.fr/">
    <img src="public/img/swapp_image_logo.png" alt="SWAPP logo" title="SWAPP" align="right" height="60" />
</a>

## "SWAPP : Open Source Security Scanner for web apps"

----------------

## Description :


Application permettant de détecter les erreurs de code et failles de sécurité dans le code de projets publics déposés sur GitHub et codés en PHP 5.4 minimum.

L'application est visible à l'adresse suivante : <http://erre-tec.hd.free.fr/>

Version : 1.0.0  
Date : 2020-07-27  
Responsables : [Team](TEAM.md)  

----------------

![Version flag](https://img.shields.io/badge/Version-1.0.0-green?style=flat-square)
![Date flag](https://img.shields.io/badge/Date-27%2F07%2F2020-blue?style=flat-square)
[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-v2.0%20adopted-ff69b4.svg)](code_of_conduct.md)



## Documentation

**SWAPP** est un outil permettant d'analyser les fichiers PHP d'un repository Github.
    Il fournit trois types d'analyse statique:
    
        - Une détectant les erreurs de code à l'aide de PHPStan
        - Une autre répertoriant les failles de sécurité à travers Progpilot
        - Un rapport permettant de migrer de PHP 5 à PHP 7 via PHP7Mar
        
**SWAPP** nécessite PHP >= 7.1., composer, npm, yarn.

## Mise en route

#### Installation
Pour commencer, clonez le repository. Ensuite executez les commandes:
    ```composer update```
    ```npm i```
    ```yarn```
    
Renommez le fichier .env.exemple en .env et remplissez les variables:

        - DB_* (vos identifiants de base de données)
        - MAIL_* (vos identifiants pour le service mail)
        - MIX_APP_URL (l'url de votre application)
        - STRIPE_PUBLISHABLE_KEY (La key fournit par Stripe pour le service de don)

Executez les commandes:
    ```php artisan migrate```
    ```php artisan cache:clear```
    ```php artisan config:clear```
    ```php artisan key:generate```
    ```php artisan jwt:secret```

Enfin, deux commandes sont nécessaires lors du lancement de l'application:
   ```npm run prod``` (ou ```npm run hot``` en local => /public/hot)
   ```php artisan queue:work``` (lance le système de file d'attente asynchrone)
   
#### Informations

L'analyse d'un repository peut demander plusieurs minutes, c'est pourquoi **SWAPP** fonctionne de manière asynchrone afin de ne pas bloquer l'utilisateur. 
Les résultats de l'analyse sont transmis par email.
Pour les utilisateurs connectés, il est possible d'accéder à un historique et même aux fichiers de résultats de l'analyse.
De plus, les utilisateurs ont accès aux statistiques de leurs scans.
Actuellement, l'api Github nous limite à 60 appels par heure maximum. Une fois l'application en ligne, vous pourrez générer un token via Oauth2 sur la plateforme Github.
Il vous faudra ensuite modifier la fonction getGithubContent() dans l'ApiController et renseigner le token généré. Votre limite passera ainsi à 5000 appels par heure.

Pour finir, **SWAPP** possède un système de don via la plateforme Stripe pour soutenir le projet.

Code with love :heart: !
