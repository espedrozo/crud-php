<?php

namespace App\Db;

class Pagination{

    //NÚMERO MÁXIMO DE REGISTROS POR PÁGINA
    private $limit;

    // QUANTIDADE TOTAL DE RESULTADOS DO BANCO
    private $results;

    //QUANTIDADE DE PÁGINAS
    private $pages;

    //PÁGINA ATUAL
    private $currentPage;

    //CONSTRUTOR DA CLASSE
    public function __construct($results, $currentPage = 1, $limit = 10){
        $this->results = $results;
        $this->limit = $limit;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
        $this->calculate();
    }

    //MÉTODO QUE CALCULA A PAGINAÇÃO
    private function calculate(){
        //CALCULA O TOTAL DE PÁGINAS
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        //VERIFICA SE A PÁGINA ATUAL NÃO EXCEDE O NÚMERO DE PÁGINAS
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }

    //MÉTODO QUE RETORNA A CLÁUSULA LIMIT DA SQL
    public function getLimit(){
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset.','.$this->limit;
    }

    //MÉTODO QUE RETORNA AS OPÇÕES DE PÁGINAS DISPONÍVEIS
    public function getPages(){
        //NÃO RETORNA PÁGINAS
        if($this->pages == 1) return [];

        //PÁGINAS
        $paginas = [];
        for($i = 1; $i <= $this->pages; $i++){
            $paginas[] = [
                'pagina' => $i,
                'atual'  => $i == $this->currentPage
            ];
        }
        return $paginas;
    }
}