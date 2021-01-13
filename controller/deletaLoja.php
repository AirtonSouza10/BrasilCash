<?php 

require_once '../dao/lojaDAO.php';

$id = $_GET["id"];


$lojaDAO = new LojaDAO();
$lojaDAO->excluirLoja($id);
echo "</script>";
echo "<script>";
echo "alert('Excluido com sucesso');";
echo "window.location.href = '../view/loja.php';";
echo "</script> ";

?>

