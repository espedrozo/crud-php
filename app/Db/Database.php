<?php

namespace App\Db;

use \PDO;
use \PDOException;

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
            $this -> connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    //MÉTODO QUE EXECUTA QUERIES DENTRO DO BANCO DE DADOS
    public function execute($query, $params = []){
        try{
            $statement = $this -> connection -> prepare($query);
            $statement -> execute($params);
            return $statement;
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    //MÉTODO QUE INSERE DADOS NO BANCO
    public function insert($values){

        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        
        //MONTA A QUERY
        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

        //EXECUTA O INSERT
        $this -> execute($query, array_values($values));

        //RETORNA O ID INSERIDO
        return $this -> connection -> lastInsertId();
    }

    //MÉTODO QUE EXECUTA UMA CONSULTA NO BANCO
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        //MONTA A QUERY
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        //EXECUTA A QUERY
        return $this->execute($query);
    }

    //MÉTODO QUE EXECUTA ATUALIZAÇÃO NO BANCO DE DADOS
    public function update($where, $values){
       
        //DADOS DA QUERY
        $fields = array_keys($values);
        
        //MONTA A QUERY
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
       
        //EXECUTAR A QUERY
        $this->execute($query, array_values($values));

        //RETORNA SUCESSO
        return true;
    }

    //MÉTODO QUE EXCLUI DADOS DO BANCO
    public function delete($where){
        //MONTA A QUERY
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        //EXECUTA A QUERY
        $this->execute($query);

        //RETORNA SUCESSO
        return true;
    }
}