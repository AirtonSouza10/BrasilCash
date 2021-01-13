<?php 
class PrazosDTO{

    private $id;
    private $descricao;
    private $diasdif;
    private $qtdepr;

    //gets

    public function getId() {
        return $this->id;
    }

    public function getDescricao(){
    	return $this->descricao;
    }

    public function getDiasdif(){
    	return $this->diasdif;
    }

    public function getQtdepr(){
    	return $this->qtdepr;
    }

    //sets

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setDiasdif($diasdif) {
        $this->diasdif = $diasdif;
    }

    public function setQtdepr($qtdepr) {
        $this->qtdepr = $qtdepr;
    } 


}

?>