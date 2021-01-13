<?php 
class FaturaDTO{

    private $id;
    private $loja_id;
    private $operador_id;
    private $fornecedor_id;
	private $prazo_id;
	private $situacao_id;
	private $notafiscal;
	private $datacompra;
	private $datavencimento;
	private $datapgto;
	private $total;
	private $valorpr;
	private $dtbaixa;
	private $numpr;
	private $obs;
	private $duplicata;
	private $tipo;
	private $juro;



    public function getJuro() {
        return $this->juro;
    }	
    public function getTipo() {
        return $this->tipo;
    }	
    public function getDuplicata() {
        return $this->duplicata;
    }		
    public function getObs() {
        return $this->obs;
    }	
    //gets
    public function getNumpr() {
        return $this->numpr;
    }

    public function getId() {
        return $this->id;
    }

    public function getLoja_id(){
    	return $this->loja_id;
    }

    public function getOperador_id(){
    	return $this->operador_id;
    }
    public function getFornecedor_id(){
    	return $this->fornecedor_id;
    }

    public function getPrazo_id(){
    	return $this->prazo_id;
    }
    public function getSituacao_id() {
        return $this->situacao_id;
    }

    public function getNotafiscal(){
    	return $this->notafiscal;
    }

    public function getDatacompra(){
    	return $this->datacompra;
    }

    public function getDatavencimento(){
    	return $this->datavencimento;
    }
    public function getDatapgto(){
    	return $this->datapgto;
    }
    public function getTotal() {
        return $this->total;
    }

    public function getValorpr(){
    	return $this->valorpr;
    }

    public function getDtbaixa(){
    	return $this->dtbaixa;
    }


    //sets
	public function setJuro($juro) {
        $this->juro = $juro;
    }
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    public function setDuplicata($duplicata) {
        $this->duplicata = $duplicata;
    }	
    public function setObs($obs) {
        $this->obs = $obs;
    }	
    public function setNumpr($numpr) {
        $this->numpr = $numpr;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function setLoja_id($loja_id) {
        $this->loja_id = $loja_id;
    }

    public function setOperador_id($operador_id) {
        $this->operador_id = $operador_id;
    }

    public function setFornecedor_id($fornecedor_id) {
        $this->fornecedor_id = $fornecedor_id;
    }
    public function setPrazo_id($prazo_id) {
        $this->prazo_id = $prazo_id;
    }

    public function setSituacao_id($situacao_id) {
        $this->situacao_id = $situacao_id;
    }

    public function setNotafiscal($notafiscal) {
        $this->notafiscal = $notafiscal;
    }

    public function setDatacompra($datacompra) {
        $this->datacompra = $datacompra;
    }	

    public function setDatavencimento($datavencimento) {
        $this->datavencimento = $datavencimento;
    }
    public function setDatapgto($datapgto) {
        $this->datapgto = $datapgto;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setValorpr($valorpr) {
        $this->valorpr = $valorpr;
    }

    public function setDtbaixa($dtbaixa) {
        $this->dtbaixa = $dtbaixa;
    }

}

?>