<?php
require_once '../dto/lojaDTO.php';
require_once '../dao/lojaDAO.php'; 

// recuperei os dados do formulario
$razao = $_POST["razao"];
$cnpj = $_POST["cnpj"];
$id = $_POST["id"];

$lojaDTO = new LojaDTO();
$lojaDTO->setRazao($razao);
$lojaDTO->setCnpj($cnpj);
$lojaDTO->setId($id);

$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM loja WHERE cnpj = '$cnpj' ";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0 or mysqli_num_rows($retorno) == 1){ 
$lojaDAO = new LojaDAO();
$lojaDAO->updateLojaById($lojaDTO);

   echo	"<script>alert('Cadastro alterado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/loja.php';</script>";

}else{
	echo	"<script>alert('Esse cadastro já existe na base dados');</script>";
	echo	"<script>window.location.href = '../view/loja.php';</script>";	
}

?>
