<?php 
class FornecedorDTO{

    private $id;
    private $razao;
    private $telefone;
    private $cnpj;

    //gets

    public function getId() {
        return $this->id;
    }

    public function getRazao(){
    	return $this->razao;
    }

    public function getTelefone(){
    	return $this->telefone;
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

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    } 


}

?>