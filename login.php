<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Usuario;
use \App\Session\Login;

//OBRIGA O USUÁRIO A NÃO ESTAR LOGADO
Login::requireLogout();

//MENSAGENS DE ALERTA DOS FORMULÁRIOS
$alertaLogin = '';
$alertaCadastro = '';

//VALIDAÇÃO DO POST
if(isset($_POST['acao'])){

    switch($_POST['acao']){
        case 'logar' :

            //BUSCA USUÁRIO POR EMAIL
            $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);

            //VALIDA A INSTANCIA E A SENHA
            if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'], $obUsuario->senha)){
                $alertaLogin = 'E-mail ou senha inválidos';
                break;
            }

            //LOGA O USUÁRIO
            Login::login($obUsuario);
            break;

        case 'cadastrar' :
            //VALIDAÇÃO DOS CAMPOS OBRIGATÓRIOS
            if(isset($_POST['nome'], $_POST['email'], $_POST['senha'])){

            //BUSCA USUÁRIO POR EMAIL
            $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
            if($obUsuario instanceof Usuario){
                $alertaCadastro = 'O e-mail digitado já está em uso';
                break;
            }

            //NOVO USUÁRIO
            $obUsuario = new Usuario;
            $obUsuario->nome = $_POST['nome'];
            $obUsuario->email = $_POST['email'];
            $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $obUsuario->cadastrar();

            //LOGA O USUÁRIO
            Login::login($obUsuario);

            }
            break;
    }

}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario-login.php';
include __DIR__.'/includes/footer.php';

// echo "<pre>";
// print_r($obVaga);
// echo "</pre>";
// exit;