<?php

namespace App\Session;

class Login{
    //MÉTODO QUE INICIA A SESSÃO
    private static function init(){
        //VERIFICA O STATUS DA SESSÃO
        if(session_status() !== PHP_SESSION_ACTIVE){
            //INICIA A SESSÃO
            session_start();
        }
    }
    

    //MÉTODO QUE RETORNA OS DADOS DO USUÁRIO LOGADO
    public static function getUsuarioLogado(){
        self::init();

        //RETORNA DADOSDO USUÁRIO
        return self::isLogged() ? $_SESSION['usuario'] : null;
    }

    //MÉTODO QUE LOGA O USUÁRIO
    public static function login($obUsuario){
        //INICIA A SESSÃO
        self::init();

        //SESSÃO DE USUÁRIO
        $_SESSION['usuario'] = [
            'id' => $obUsuario->id,
            'nome' => $obUsuario->nome,
            'email' => $obUsuario->email
        ];

        //REDIRECIONA USUÁRIO PARA INDEX
        header('location: index.php');
        exit;
    }

    //MÉTODO QUE DESLOGA O USUÁRIO
    public static function logout(){
        //INICIA A SESSÃO
        self::init();

        //REMOVE A SESSÃO DE USUÁRIO
        unset($_SESSION['usuario']);

        //REDIRECIONA USUÁRIO PARA LOGIN
        header('location: login.php');
        exit;
    }
    
    //MÉTODO QUE VERIFICA SE O USUÁRIO ESTÁ LOGADO
    public static function isLogged(){
        //INICIA A SESSÃO
        self::init();

        //VALIDAÇÃO DA SESSÃO
        return isset($_SESSION['usuario']['id']);
    }

    //MÉTODO QUE OBRIGA O USUÁRIO LOGAR PARA ACESSAR
    public static function requireLogin(){
        if(!self::isLogged()){
            header('location: login.php');
            exit;
        }
    }

    //MÉTODO QUE OBRIGA O USUÁRIO A ESTAR DESLOGADO PARA ACESSAR
    public static function requireLogout(){
        if(self::isLogged()){
            header('location: index.php');
            exit;
        }
    }
}