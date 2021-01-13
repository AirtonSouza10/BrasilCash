<?php 

require_once '../dao/prazosDAO.php';

$id = $_GET["id"];


$prazosDAO = new PrazosDAO();
$prazosDAO->excluirPrazo($id);
echo "</script>";
echo "<script>";
echo "alert('Excluido com sucesso');";
echo "window.location.href = '../view/prazos.php';";
echo "</script> ";

?>

