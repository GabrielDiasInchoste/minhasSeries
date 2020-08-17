<?php
    session_start(); //DEVE SER A PRIMEIRA LINHA

    //Finaliza a sessão logado da Aplicação
    if(isset($_GET['acao']) && $_GET['acao']=="sair"){
        unset($_SESSION['logado']);
    }
?>

<?php define('BASE_URL', 'http://localhost/minhasSeries'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Minhas Séries | ADS</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="<?= BASE_URL; ?>/template/album.css" rel="stylesheet">
  </head>

  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">Sobre</h4>
              <p class="text-muted">
                Aplicação para auxiliar na tarefa de gerenciar quais séries estão sendo assistidas,bem como qual estágio em cada série/temporada.
              </p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Ações</h4>
              <ul class="list-unstyled">
                <li><a href="<?= BASE_URL; ?>/genero/genero.php" class="text-white">Gênero</a></li>
                <li><a href="<?= BASE_URL; ?>/serie/serie.php" class="text-white">Séries</a></li>
                <li><a href="<?= BASE_URL; ?>/epsodio/epsodio.php" class="text-white">Epsódio</a></li>
                <li><a href="<?= BASE_URL; ?>/login.php?acao=sair" class="text-white">Sair</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="<?php echo BASE_URL; ?>" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Minhas Séries</strong>
          </a>
          <span style="color:white;">
            <?php echo "Usuário logado: "  . $_SESSION['logado']['nome']; ?>
          </span>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">
