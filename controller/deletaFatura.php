<?php 

require_once '../dao/faturaDAO.php';

$id = $_GET["id"];


$faturaDAO = new FaturaDAO();
$faturaDAO->excluirFatura($id);
echo "</script>";
echo "<script>";
echo "alert('Excluido com sucesso');";
echo "window.location.href = '../view/lancamentos.php';";
echo "</script> ";

?>

