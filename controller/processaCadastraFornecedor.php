<?php
require_once '../dto/fornecedorDTO.php';
require_once '../dao/fornecedorDAO.php'; 

// recuperei os dados do formulario
$razao = $_POST["razao"];
$telefone = $_POST["telefone"];
$cnpj = $_POST["cnpj"];

$fornecedorDTO = new FornecedorDTO();
$fornecedorDTO->setRazao($razao);
$fornecedorDTO->setTelefone($telefone);
$fornecedorDTO->setCnpj($cnpj);


$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM fornecedor WHERE cnpj = '$cnpj'";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0){ 
$fornecedorDAO = new fornecedorDAO();
$sucesso = $fornecedorDAO->salvarFornecedor($fornecedorDTO);

if ($sucesso){

   echo	"<script>alert('Cadastro realizado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/fornecedor.php';</script>";	
}
	}else{
	echo	"<script>alert('Item jรก existe na base de dados');</script>";
	echo	"<script>window.location.href = '../view/fornecedor.php';</script>";	
}
?>

