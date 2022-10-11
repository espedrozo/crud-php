<?php

namespace App\Entity;

class Vaga{

    //Identificador único da vaga
    public $id;

    //Título da vaga
    public $titulo;

    //Descrição da vaga (pode conter html)
    public $descrição;

    //Define se a vaga ativa
    public $ativo;

    //Data de publicação da vaga
    public $data;

    //MÉTODO QUE CADASTRA NOVA VAGA
    public function cadastrar(){
        //DEFINIR A DATA
        $this -> data = date('Y-m-d H:i:s');

        //INSERIR A VAGA NO BANCO 

        //ATRIBUIR O ID DA VAGA NA INSTANCIA

        //RETORNAR SUCESSO
    }
}