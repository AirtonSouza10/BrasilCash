<!--importacao page clienteDAO-->
<?php
 	require_once '../dao/fornecedorDAO.php';

 	$word = $_POST['s_post'];
    $fornecedorDAO = new FornecedorDAO();
    $fornecedor = $fornecedorDAO->getFornecedorPesq($word);

      foreach ($fornecedor as $n) {
           echo "<tr>";
           echo "  <td>{$n['id']}</td>";
           echo "  <td>{$n['razao']}</td>";
           echo "  <td>{$n['cnpj']}</td>";                       
           echo "  <td><input type='radio' name='my_fornecedor' value='{$n['id']} ' /> </td>";
           echo "  <td><input type='radio' name='my_forn' value='{$n['razao']} ' /> </td>";
           echo "</tr>"; 
     
    }


?>