<?php
require_once '../dto/operadorDTO.php';
require_once '../dao/operadorDAO.php'; 

// recuperei os dados do formulario
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$senha = md5($_POST["senha"]);


$operadorDTO = new OperadorDTO();
$operadorDTO->setNome($nome);
$operadorDTO->setCpf($cpf);
$operadorDTO->setSenha($senha);

$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM operador WHERE cpf = '$cpf' ";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0){ 
$operadorDAO = new operadorDAO();
$sucesso = $operadorDAO->salvarOperador($operadorDTO);

if ($sucesso){

   echo	"<script>alert('Cadastro realizado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/operador.php';</script>";	
}
	}else{
	echo	"<script>alert('Esse cadastro já existe na base de dados');</script>";
	echo	"<script>window.location.href = '../view/operador.php';</script>";	
}
?>

