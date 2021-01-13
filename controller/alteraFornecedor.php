<?php
require_once '../dto/fornecedorDTO.php';
require_once '../dao/fornecedorDAO.php'; 

// recuperei os dados do formulario
$razao = $_POST["razao"];
$telefone = $_POST["telefone"];
$cnpj = $_POST["cnpj"];
$id = $_POST["id"];

$fornecedorDTO = new FornecedorDTO();
$fornecedorDTO->setRazao($razao);
$fornecedorDTO->setTelefone($telefone);
$fornecedorDTO->setCnpj($cnpj);
$fornecedorDTO->setId($id);

$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM fornecedor WHERE cnpj = '$cnpj' ";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0 or mysqli_num_rows($retorno) == 1){ 
$fornecedorDAO = new FornecedorDAO();
$fornecedorDAO->updateFornecedorById($fornecedorDTO);

   echo	"<script>alert('Cadastro alterado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/fornecedor.php';</script>";

}else{
	echo	"<script>alert('Esse cadastro jรก existe na base dados');</script>";
	echo	"<script>window.location.href = '../view/fornecedor.php';</script>";	
}

?>
