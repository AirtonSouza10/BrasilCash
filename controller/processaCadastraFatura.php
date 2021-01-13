<?php

require_once '../dao/faturaDAO.php'; 
require_once '../dao/prazosDAO.php';
require_once '../jscp/funcaoData.php';
require_once '../dto/faturaDTO.php';
 
// recuperei os dados do formulario
$loja = $_POST["loja"];
$operador = $_POST["operador"];
$fornecedor = $_POST["fornecedor"];

//pegar dados do prazo
$prazo = $_POST["prazo"];
$prazosDAO = new PrazosDAO();
$prazos = $prazosDAO->getPrazoById($prazo);
$diasdif=$prazos['diasdif'];//dias diferença
$qtdepr=$prazos['qtdepr'];//total de parcelas

//situacao
$situacao = $_POST["situacao"];
$notafiscal = $_POST["notafiscal"];
$datacompra = $_POST["datacompra"];
$total = $_POST["total"];
$obs = $_POST["obs"];
$tipo = $_POST["tipo"];

//descobrir valor da parcelas
$valorpr = $total/$qtdepr;
//numero inicial da parcelas
$numpr=1;

//calcular vencimento	
$datavencimento = date('Y-m-d', strtotime('+'.$diasdif.'days', strtotime($datacompra)));


//condicionais para iserção de dados
While($numpr <=$qtdepr){


	$faturaDTO = new FaturaDTO();
	$faturaDTO->setLoja_id($loja);
	$faturaDTO->setOperador_id($operador);
	$faturaDTO->setFornecedor_id($fornecedor);
	$faturaDTO->setPrazo_id($prazo);
	$faturaDTO->setSituacao_id($situacao);
	$faturaDTO->setNotafiscal($notafiscal);
	$faturaDTO->setDatacompra($datacompra);
	$faturaDTO->setDatavencimento($datavencimento);	
	$faturaDTO->setTotal($total);
	$faturaDTO->setValorpr($valorpr);
	$faturaDTO->setObs($obs);
	$faturaDTO->setNumpr($numpr);
	$faturaDTO->setTipo($tipo);	


	$conn = mysqli_connect("localhost","root","","brasilcash");
	$search = "SELECT * FROM fatura WHERE datacompra = '$total' ";
	$retorno = mysqli_query($conn, $search);

	if(mysqli_num_rows($retorno) == 0){ 
	$faturaDAO = new faturaDAO();
	$sucesso = $faturaDAO->salvarFatura($faturaDTO);

	}

	$numpr++;
	$datavencimento = date('Y-m-d', strtotime('+'.$diasdif.'days', strtotime($datavencimento)));

}	  
	   echo	"<script>alert('Lançamento finalizado com sucesso');</script>";
	   echo	"<script>window.location.href = '../view/fatura.php';</script>";

?>

