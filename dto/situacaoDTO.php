<?php 
class SituacaoDTO{

    private $id;
    private $stattus;

    //gets

    public function getId() {
        return $this->id;
    }

    public function getStattus(){
    	return $this->stattus;
    }


    //sets

    public function setId($id) {
        $this->id = $id;
    }

    public function setStattus($stattus) {
        $this->stattus = $stattus;
    }


}

?>