<?php 
class LojaDTO{

    private $id;
    private $razao;
    private $cnpj;

    //gets

    public function getId() {
        return $this->id;
    }

    public function getRazao(){
    	return $this->razao;
    }

    public function getCnpj(){
    	return $this->cnpj;
    }


    //sets

    public function setId($id) {
        $this->id = $id;
    }

    public function setRazao($razao) {
        $this->razao = $razao;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }


}

?>