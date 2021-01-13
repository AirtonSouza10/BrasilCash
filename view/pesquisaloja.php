<?php
    session_start();
    include 'validaLogin.php';
    include '../dao/conexao.php';

    $busca = $_POST['busca'];

$conn = mysqli_connect("localhost","root","","brasilcash");
$search = "SELECT id,razao,cnpj FROM loja  WHERE razao like '%$busca%' or cnpj LIKE '%$busca%' limit 50";

$retorno = mysqli_query($conn, $search);
$row_cnt = mysqli_num_rows($retorno);
                      echo "<table class='table table-bordered table-hover table-striped'>";
                      echo "<thead class='thead-dark'>";
                      echo "<tr>";

                      echo  "<th>ID</th>";
                      echo  "<th>RAZAO</th>";                       
                      echo  "<th>CNPJ</th>";  
                      echo  "<th class='actions'>AÇÃO</th>";

                      echo  "</tr>";
                      echo "</thead>";



    if($row_cnt >= 1){ 
        foreach ($retorno as $r) {

                      echo "<tbody>";
                      echo "<tr>";
                      echo "<td>{$r['id']}</td>";
                      echo "<td>{$r['razao']}</td>";
                      echo "<td>{$r['cnpj']}</td>";      
                      echo "  <td class='actions'>";
                      echo "  <a href='../controller/deletaLoja.php?id={$r["id"]}'> <img src='../imagem/lixeira.png' width='35px' height='35px'title='Exclur'> </a>"; 
                      echo "  <a href='alteraLoja.php?id={$r["id"]}'> <img src='../imagem/editar.png' width='35px' height='35px'title='Editar'> </a>";                      
                      
                      echo "       </td>";
                      echo " </tr>";
                      echo "</tbody>";
  

                    }

                      echo "</table>";
        
    }
    elseif ($busca = "") {
      echo "conte-nos o que procura";
    }

    else{
        echo "nenhum registro encontrado";
    }
   
?> 