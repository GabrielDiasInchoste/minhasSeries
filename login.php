<?php
    session_start(); //DEVE SER A PRIMEIRA LINHA

    //Finaliza a sessão logado da Aplicação
    if(isset($_GET['acao']) && $_GET['acao']=="sair"){
        unset($_SESSION['logado']);
    }

    if(isset($_POST)){
        require_once './config/conexao.php';
        $sql   = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
        $query = $con->prepare($sql);
        $query->bindParam('email', $_POST['email']);

        //Colocar a senha como md5 utilizando a função md5()
        if(isset($_POST['email']) && isset($_POST['senha'])){
          $senha = md5($_POST['senha']);

          $query->bindParam('senha', $senha);
          $query->execute();
          if($query->rowCount()==1){
              $usuario = $query->fetch();
              $_SESSION['logado'] = array("nome"=>$usuario['nome'], 'id'=>$usuario['id']);
              header('Location: index.php');
          }else{
              $msg = "Usuário ou senha não conferem";
          }
        }
    }
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Login da Aplicação</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="./template/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form action="login.php" method="post" class="form-signin">
      <?php if (isset($msg)) { ?>
        <div class="alert alert-danger" role="alert">
          <?= $msg; ?>
        </div>
      <?php } ?>
      <img class="mb-4" src="https://www.upf.br/Assets/img/logo.png">
      <h1 class="h3 mb-3 font-weight-normal">Informe seus dados</h1>
      <label for="inputEmail" class="sr-only">Email</label>
      <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
      <label for="inputPassword" class="sr-only">Senha</label>
      <input name="senha" type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>
  </body>
</html>
