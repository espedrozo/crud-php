<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Cadastrar Vaga');

use \App\Entity\Vaga;
use \App\Session\Login;

//OBRIGA O USUÁRIO A ESTAR LOGADO
Login::requireLogin();

//INSTANCIA DE VAGA
$obVaga = new Vaga;

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;

//VALIDAÇÃO DO POST
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){
    //$obVaga = new Vaga;
    $obVaga -> titulo       = $_POST['titulo'];
    $obVaga -> descricao    = $_POST['descricao'];
    $obVaga -> ativo        = $_POST['ativo'];
    $obVaga -> cadastrar();

    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';
