<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga{

    //Identificador único da vaga
    public $id;

    //Título da vaga
    public $titulo;

    //Descrição da vaga (pode conter html)
    public $descricao;

    //Define se a vaga ativa
    public $ativo;

    //Data de publicação da vaga
    public $data;

    //MÉTODO QUE CADASTRA NOVA VAGA
    public function cadastrar(){
        //DEFINIR A DATA
        $this -> data = date('Y-m-d H:i:s');

        //INSERIR A VAGA NO BANCO
        $obDatabase = new Database('vagas');
        $this -> id = $obDatabase -> insert([
            'titulo' => $this -> titulo,
            'descricao' => $this -> descricao,
            'ativo' => $this -> ativo,
            'data' => $this -> data
        ]);

        //RETORNAR SUCESSO
        return true;
    }

    //MÉTODO QUE OBTÉM AS VAGAS DO BANCO DE DADOS
    public static function getVagas($where = null, $order = null, $limit = null){
        return(new Database('vagas')) -> select($where, $order, $limit)
                                      ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    //MÉTODO QUE BUSCA VAGA COM BASE NO ID
    public static function getVaga($id){
        return (new Database('vagas')) -> select('id = '.$id)
                                       ->fetchObject(self::class);
    }

}