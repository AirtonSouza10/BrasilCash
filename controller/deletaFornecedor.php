<?php 

require_once '../dao/fornecedorDAO.php';

$id = $_GET["id"];


$fornecedorDAO = new FornecedorDAO();
$fornecedorDAO->excluirFornecedor($id);
echo "</script>";
echo "<script>";
echo "alert('Excluido com sucesso');";
echo "window.location.href = '../view/fornecedor.php';";
echo "</script> ";

?>

