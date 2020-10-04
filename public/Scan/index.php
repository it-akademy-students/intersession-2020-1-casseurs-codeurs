<?php
session_start();
include_once("./back/config.php");
include("./back/compteur.php");
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title><?=constant("TITLE_1"); ?></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-info">
      <a class="navbar-brand" href="http://localhost:8080"><?=constant("TITLE_1"); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="http://localhost:8080">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost:8080/jeu.php">Jeu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost:8080/login.php">Login</a>
          </li>
        </ul>
      </div>
    </nav>
    <h1 class="display-4 p-4"><?=constant("TITLE_1"); ?></h1>
    <div class="jumbotron">
      <h2 class="display-4">Bonjour !</h2>
      <p class="lead">Bienvenue sur <?=constant("TITLE_1"); ?> !</p>
      <hr class="my-4">
      <p>Pour participer au grand jeu <?=constant("TITLE_1"); ?>, cliquez ci-dessous.</p>
      <a class="btn btn-success btn-lg" href="http://localhost:8080/jeu.php" role="button">Participer au jeu</a>
    </div>
    <h4 class="pl-4">Il y a <?= $counting ; ?> visiteur(s)</h4>
    <footer class="footer mt-auto py-3 text-center" style="position : absolute; bottom : 0;">
      <div class="container">
        <span class="text-muted">&copy; tp dfs-php, 2019.</span>
      </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
