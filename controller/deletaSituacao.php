<?php 

require_once '../dao/situacaoDAO.php';

$id = $_GET["id"];


$situacaoDAO = new SituacaoDAO();
$situacaoDAO->excluirSituacao($id);
echo "</script>";
echo "<script>";
echo "alert('Excluido com sucesso');";
echo "window.location.href = '../view/situacao.php';";
echo "</script> ";

?>
