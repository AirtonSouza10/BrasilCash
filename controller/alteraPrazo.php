<?php
require_once '../dto/prazosDTO.php';
require_once '../dao/prazosDAO.php'; 

// recuperei os dados do formulario
$descricao = $_POST["descricao"];
$diasdif = $_POST["diasdif"];
$qtdepr = $_POST["qtdepr"];
$id = $_POST["id"];

$prazosDTO = new PrazosDTO();
$prazosDTO->setDescricao($descricao);
$prazosDTO->setDiasdif($diasdif);
$prazosDTO->setQtdepr($qtdepr);
$prazosDTO->setId($id);

$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM prazo WHERE descricao = '$descricao' ";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0 or mysqli_num_rows($retorno) == 1){ 
$prazosDAO = new PrazosDAO();
$prazosDAO->updatePrazoById($prazosDTO);

   echo	"<script>alert('Cadastro alterado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/prazos.php';</script>";

}else{
	echo	"<script>alert('Esse cadastro jรก existe na base dados');</script>";
	echo	"<script>window.location.href = '../view/prazos.php';</script>";	
}

?>
