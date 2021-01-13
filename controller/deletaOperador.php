<?php 

require_once '../dao/operadorDAO.php';

$id = $_GET["id"];


$operadorDAO = new OperadorDAO();
$operadorDAO->excluirOperador($id);
echo "</script>";
echo "<script>";
echo "alert('Excluido com sucesso');";
echo "window.location.href = '../view/operador.php';";
echo "</script> ";

?>

