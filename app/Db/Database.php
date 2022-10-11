<?php

namespace App\Db;

use \PDO;

class Database{
    //HOST DE CONEXÃO COM O BANCO DE DADOS
    const HOST = 'localhost';

    //NOME DO BANCO DE DADOS
    const NAME = 'wdev_vagas';

    //USUÁRIO DO BANCO
    const USER = 'root';

    //SENHA DE ACESSO AO BANCO DE DADOS
    const PASS = 'root';

    //NOME DA TABELA A SER MANIPULADA
    private $table;

    //INSTANCIA DE CONEXÃO COM O BANCO DE DADOS - PDO
    private $connection;

    //DEFINE A TABELA E INSTANCIA E CONEXÃO
    public function __construct($table = null){
        $this -> table = $table;
        $this -> setConnection();
    }

    //MÉTODO QUE CRIA CONEXÃO COM O BANCO DE DADOS
    private function setConnection(){

        try{
            $this -> connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }
}