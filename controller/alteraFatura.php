<?php
require_once '../dto/faturaDTO.php';
require_once '../dao/faturaDAO.php'; 
require_once '../jscp/funcaoData.php'; 
require_once '../dao/prazosDAO.php'; 

// recuperei os dados do formulario
$loja = $_POST["loja"];
$operador = $_POST["operador"];
$fornecedor = $_POST["fornecedor"];


$situacao = $_POST["situacao"];
$notafiscal = $_POST["notafiscal"];
$datacompra =dateBRtoDateUS($_POST["datacompra"]);
$datavencimento =dateBRtoDateUS($_POST["datavencimento"]);
//$datapgto =dateBRtoDateUS($_POST["datapgto"]);
$total = $_POST["total"];
$prazo = $_POST["prazo"];


$valorpr = $_POST["valorpr"];
$juro = $_POST["juro"];
//$dtbaixa =dateBRtoDateUS($_POST["databaixa"]);
$obs = $_POST["obs"];
$duplicata = $_POST["duplicata"];
$tipo = $_POST["tipo"];


$id = $_POST["id"];

//buscar prazo atual do registro
        $faturaDAO = new FaturaDAO();
        $ft = $faturaDAO->getFaturaById($id);
		$prazoCadastrado = $ft['prazo_id'];
		$notaCancelar = $ft['notafiscal'];
		$fornecedorCancelar =$ft['fornecedor_id'];
		$lojaCancelar = $ft['loja_id'];
		
		
if($prazoCadastrado<>$prazo){
	
$prazosDAO = new PrazosDAO();
$prazos = $prazosDAO->getPrazoById($prazo);
$diasdif=$prazos['diasdif'];//dias diferença
$qtdepr=$prazos['qtdepr'];//total de parcelas	
	
//descobrir valor da parcelas
$valorpr = $total/$qtdepr;
//numero inicial da parcelas
$numpr=1;

//calcular vencimento	
$datavencimento = date('Y-m-d', strtotime('+'.$diasdif.'days', strtotime($datacompra)));	
	
	$faturaDAO = new FaturaDAO();
	$faturaDAO->excluirFaturaPorNotaFiscal($notaCancelar,$fornecedorCancelar,$lojaCancelar);
	//código para alterar parcelamento
	//vou excluir pela nota fiscal

//cadastro de novas faturas

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

	
	
	
}

else{
	

$faturaDTO = new FaturaDTO();
$faturaDTO->setLoja_id($loja);
$faturaDTO->setOperador_id($operador);
$faturaDTO->setFornecedor_id($fornecedor);
$faturaDTO->setSituacao_id($situacao);
$faturaDTO->setNotafiscal($notafiscal);
$faturaDTO->setDatacompra($datacompra);
$faturaDTO->setDatavencimento($datavencimento);
//$faturaDTO->setDatapgto($datapgto);
$faturaDTO->setTotal($total);
$faturaDTO->setValorpr($valorpr);
$faturaDTO->setJuro($juro);
//$faturaDTO->setDtbaixa($dtbaixa);
$faturaDTO->setObs($obs);
$faturaDTO->setDuplicata($duplicata);
$faturaDTO->setTipo($tipo);

$faturaDTO->setId($id);
	
	
	
$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM fatura WHERE datacompra = '$notafiscal' ";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0 or mysqli_num_rows($retorno) == 1){ 
$faturaDAO = new FaturaDAO();
$faturaDAO->updateFaturaById($faturaDTO);

   echo	"<script>alert('Cadastro alterado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/lancamentos.php';</script>";

}else{
	echo	"<script>alert('Esse cadastro jรก existe na base dados');</script>";
	echo	"<script>window.location.href = '../view/lancamentos.php';</script>";	
}

//fim orimeiro else
}

?>
