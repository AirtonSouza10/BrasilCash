<?php
require_once '../dto/operadorDTO.php';
require_once '../dao/operadorDAO.php'; 

// recuperei os dados do formulario
$senha = md5("padraobrasilcash");
$id = $_GET["id"];

$operadorDTO = new OperadorDTO();
$operadorDTO->setSenha($senha);
$operadorDTO->setId($id);

$conn = mysqli_connect("localhost","root","","bancotemporario");
$search = "SELECT * FROM operador WHERE id = '$senha' ";
$retorno = mysqli_query($conn, $search);

if(mysqli_num_rows($retorno) == 0 or mysqli_num_rows($retorno) == 1){ 
$operadorDAO = new OperadorDAO();
$operadorDAO->updateResetById($operadorDTO);

   echo	"<script>alert('Senha resetada com sucesso - entre em contato com o Adm do sistema');</script>";
   echo	"<script>window.location.href = '../view/operador.php';</script>";

}else{
	echo	"<script>alert('Esse cadastro jรก existe na base dados');</script>";
	echo	"<script>window.location.href = '../view/operador.php';</script>";	
}

?>
