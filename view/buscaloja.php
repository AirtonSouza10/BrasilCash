<!--importacao page clienteDAO-->
<?php
 	require_once '../dao/lojaDAO.php';

 	$word = $_POST['s_post'];
    $lojaDAO = new LojaDAO();
    $loja = $lojaDAO->getLojaPesq($word);

      foreach ($loja as $n) {
           echo "<tr>";
           echo "  <td>{$n['id']}</td>";
           echo "  <td>{$n['razao']}</td>";
           echo "  <td>{$n['cnpj']}</td>";                       
           echo "  <td><input type='radio' name='my_loja' value='{$n['id']} ' /> </td>";
           echo "  <td><input type='radio' name='my_loj' value='{$n['razao']} ' /> </td>";
           echo "</tr>"; 
     
    }


?>