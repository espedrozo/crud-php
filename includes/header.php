<?php

use \App\Session\Login;

//DADOS DO USUÁRIO LOGADO
$usuarioLogado = Login::getUsuarioLogado();

//DETALHES DO USUÁRIO
$usuario = $usuarioLogado ?
           $usuarioLogado['nome'].' <a href="logout.php" class="text-light font-weight-bold ml-2">Sair</a>' :
           'Visitante <a href="login.php" class="text-light font-weight-bold ml-2">Entrar</a>';

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Vagas!</title>
  </head>
  <body class="bg-dark text-light">
    <div class="container">
        <div class="jumbotron bg-danger">
            <h1>Vagas</h1>
            <p>Exemplo de CRUD com PHP orientado a objetos</p>

            <hr class="border-light">
            <div class="d-flex justify-content-start">
              <?=$usuario?>
            </div>
            
        </div>