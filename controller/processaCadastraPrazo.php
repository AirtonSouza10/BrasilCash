<?php
require_once '../dto/prazosDTO.php';
require_once '../dao/prazosDAO.php'; 

// recuperei os dados do formulario
$descricao = $_POST["descricao"];
$diasdif = $_POST["diasdif"];
$qtdepr = $_POST["qtdepr"];

$prazosDTO = new PrazosDTO();
$prazosDTO->setDescricao($descricao);
$prazosDTO->setDiasdif($diasdif);
$prazosDTO->setQtdepr($qtdepr);



$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM prazo WHERE descricao = '$descricao'";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0){ 
$prazosDAO = new prazosDAO();
$sucesso = $prazosDAO->salvarPrazo($prazosDTO);

if ($sucesso){

   echo	"<script>alert('Cadastro realizado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/prazos.php';</script>";	
}
	}else{
	echo	"<script>alert('Item jรก existe na base de dados');</script>";
	echo	"<script>window.location.href = '../view/prazos.php';</script>";	
}
?>

