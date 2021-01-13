<?php
require_once '../dto/lojaDTO.php';
require_once '../dao/lojaDAO.php'; 

// recuperei os dados do formulario
$razao = $_POST["razao"];
$cnpj = $_POST["cnpj"];

$lojaDTO = new LojaDTO();
$lojaDTO->setRazao($razao);
$lojaDTO->setCnpj($cnpj);


$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM loja WHERE cnpj = '$cnpj'";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0){ 
$lojaDAO = new lojaDAO();
$sucesso = $lojaDAO->salvarLoja($lojaDTO);

if ($sucesso){

   echo	"<script>alert('Cadastro realizado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/loja.php';</script>";	
}
	}else{
	echo	"<script>alert('Item já existe na base de dados');</script>";
	echo	"<script>window.location.href = '../view/loja.php';</script>";	
}
?>

