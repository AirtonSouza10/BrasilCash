<?php
require_once '../dto/operadorDTO.php';
require_once '../dao/operadorDAO.php'; 

// recuperei os dados do formulario
$nome = $_POST["nome"];
$senha = md5($_POST["senha"]);
$id = $_POST["id"];

$operadorDTO = new OperadorDTO();
$operadorDTO->setNome($nome);
$operadorDTO->setSenha($senha);
$operadorDTO->setId($id);

$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT * FROM operador WHERE cpf = '$nome' ";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0 or mysqli_num_rows($retorno) == 1){ 
$operadorDAO = new OperadorDAO();
$operadorDAO->updateOperadorByIdSenha($operadorDTO);

   echo	"<script>alert('Cadastro alterado com sucesso');</script>";
   echo	"<script>window.location.href = '../view/operador.php';</script>";

}else{
	echo	"<script>alert('Esse cadastro jรก existe na base dados');</script>";
	echo	"<script>window.location.href = '../view/operador.php';</script>";	
}

?>
