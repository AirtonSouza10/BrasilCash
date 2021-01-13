<?php 
class OperadorDTO{

    private $id;
    private $nome;
    private $cpf;
    private $senha;

    //gets

    public function getId() {
        return $this->id;
    }

    public function getNome(){
    	return $this->nome;
    }

    public function getCpf(){
    	return $this->cpf;
    }

    public function getSenha(){
    	return $this->senha;
    }

    //sets

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    } 


}

?>