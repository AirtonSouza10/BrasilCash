<?php
require_once '../dto/faturaDTO.php';
require_once '../dao/faturaDAO.php'; 
require_once '../jscp/funcaoData.php'; 

// recuperei os dados do formulario
$datapgto =dateBRtoDateUS($_POST["datapgto"]);
$databaixa =dateBRtoDateUS($_POST["databaixa"]);
$situacao =$_POST["situacao"];
$juro =$_POST["juro"];
$id = $_POST["id"];

//buscando numero do título para realizar a baixa
$faturaDAO = new FaturaDAO();
$fatura = $faturaDAO->buscaTituloPorId($id); 
$titulo = $fatura['duplicata'];
$fornecedor = $fatura['fornecedor'];
$loja = $fatura['loja'];
$qtdepr = $fatura['qtdepr'];
$jurocalc = $juro/$qtdepr;


$faturaDTO = new FaturaDTO();
$faturaDTO->setDatapgto($datapgto);
$faturaDTO->setDtbaixa($databaixa);
$faturaDTO->setSituacao_id($situacao);
$faturaDTO->setJuro($jurocalc);
$faturaDTO->setDuplicata($titulo);
$faturaDTO->setFornecedor_id($fornecedor);
$faturaDTO->setLoja_id($loja);



$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM fatura WHERE datapgto = '1654455' ";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) >= 0){ 
$faturaDAO = new FaturaDAO();
$faturaDAO->updateBaixaPorTitulo($faturaDTO);

   echo	"<script>alert('Cadastro alterado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/lancamentos.php';</script>";

}else{
	echo	"<script>alert('Esse cadastro jรก existe na base dados');</script>";
	echo	"<script>window.location.href = '../view/relhj.php';</script>";	
}



?>
