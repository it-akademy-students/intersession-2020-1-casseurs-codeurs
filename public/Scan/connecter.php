<?php
session_start();
include_once("./back/config.php");
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c4573f525d.js" crossorigin="anonymous"></script>
    <title><?= constant("TITLE_4"); ?></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-info">
      <a class="navbar-brand" href="http://localhost:8080"><?= constant("TITLE_4"); ?></a>
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
            <a class="nav-link" href="./back/participant.php">Voir les participants</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-check"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="./back/logout.php">Se déconnecter</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-md-0" method="get" action="./back/rechercher.php">
          <input name="search" class="form-control text-wrap" type="text" placeholder="Saisissez votre texte">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Rechercher</button>
        </form>
      </div>
    </nav>
    <h1 class="display-4 p-4"><?= constant("TITLE_4"); ?></h1>
    <h2 class="display-6 pl-4">Bonjour <?= constant("TITLE_4"); ?>,  ceci est votre tableau de bord</h2><br/>
    <footer class="footer mt-auto py-3" style="position : absolute; bottom : 0; text-align : center;">
      <div class="container">
        <span class="text-muted">&copy; tp dfs-php, 2019.</span>
      </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>