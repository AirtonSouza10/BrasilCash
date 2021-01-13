<?php
require_once '../dto/situacaoDTO.php';
require_once '../dao/situacaoDAO.php'; 

// recuperei os dados do formulario
$status = $_POST["stattus"];
$id = $_POST["id"];

$situacaoDTO = new SituacaoDTO();
$situacaoDTO->setStattus($status);
$situacaoDTO->setId($id);

$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM situacao WHERE stattus = '$status' ";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0 or mysqli_num_rows($retorno) == 1){ 
$situacaoDAO = new SituacaoDAO();
$situacaoDAO->updateSituacaoById($situacaoDTO);

   echo	"<script>alert('Cadastro alterado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/situacao.php';</script>";

}else{
	echo	"<script>alert('Esse cadastro jรก existe na base dados');</script>";
	echo	"<script>window.location.href = '../view/situacao.php';</script>";	
}

?>
