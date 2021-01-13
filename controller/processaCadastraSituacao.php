<?php
require_once '../dto/situacaoDTO.php';
require_once '../dao/situacaoDAO.php'; 

// recuperei os dados do formulario
$status = $_POST["stattus"];

$situacaoDTO = new SituacaoDTO();
$situacaoDTO->setStattus($status);



$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM situacao WHERE stattus = '$status'";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0){ 
$situacaoDAO = new situacaoDAO();
$sucesso = $situacaoDAO->salvarSituacao($situacaoDTO);

if ($sucesso){

   echo	"<script>alert('Cadastro realizado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/situacao.php';</script>";	
}
	}else{
	echo	"<script>alert('Item jรก existe na base de dados');</script>";
	echo	"<script>window.location.href = '../view/situacao.php';</script>";	
}
?>

