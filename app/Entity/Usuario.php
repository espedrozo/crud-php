<?php

namespace App\Entity;

use\App\Db\Database;
use \PDO;

class Usuario{

    //IDENTIFICADOR ÚNICO DO USUÁRIO
    public $id;

    //NOME DO USUÁRIO
    public $nome;

    //EMAIL DO USUÁRIO
    public $email;

    //HASH DA SENHA DO USUÁRIO
    public $senha;


    //MÉTODO QUE CADASTRA NOVO USUÁRIO NO BANCO 
    public function cadastrar(){
        //DATABASE
        $obDatabase = new Database('usuarios');

        //INSERE UM NOVO USUÁRIO
        $this->id = $obDatabase->insert([
            'nome'  => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);
        //SUCESSO
        return true;
    }

    //MÉTODO QUE RETORNA UMA INSTACIA DE USUÁRIO PELO EMAIL
    public static function getUsuarioPorEmail($email){
        return (new Database('usuarios')) -> select('email = "'.$email.'"')->fetchObject(self::class);
    }
}