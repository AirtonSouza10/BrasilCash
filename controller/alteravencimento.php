<?php
require_once '../dto/faturaDTO.php';
require_once '../dao/faturaDAO.php'; 
require_once '../jscp/funcaoData.php'; 

// recuperei os dados do formulario
$datavencimento =dateBRtoDateUS($_POST["datavencimento"]);
$situacao =$_POST["situacao"];
$obs =$_POST["obs"];
$id = $_POST["id2"];

//buscando numero do título para realizar a baixa
$faturaDAO = new FaturaDAO();
$fatura = $faturaDAO->buscaTituloPorId($id); 
$titulo = $fatura['duplicata'];
$fornecedor = $fatura['fornecedor'];
$loja = $fatura['loja'];


$faturaDTO = new FaturaDTO();
$faturaDTO->setDatavencimento($datavencimento);
$faturaDTO->setSituacao_id($situacao);
$faturaDTO->setObs($obs);
$faturaDTO->setDuplicata($titulo);
$faturaDTO->setFornecedor_id($fornecedor);
$faturaDTO->setLoja_id($loja);



$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM fatura WHERE datapgto = '1654455' ";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) >= 0){ 
$faturaDAO = new FaturaDAO();
$faturaDAO->updateAlteraTituloVencimento($faturaDTO);

   echo	"<script>alert('Cadastro alterado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/lancamentos.php';</script>";

}else{
	echo	"<script>alert('Esse cadastro jรก existe na base dados');</script>";
	echo	"<script>window.location.href = '../view/lancamentos.php';</script>";	
}



?>
