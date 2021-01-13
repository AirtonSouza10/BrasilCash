
<?php
    session_start();
    include '../dao/conexao.php';

    $busca = $_POST['busca'];

$conn = mysqli_connect("localhost","root","","brasilcash");
$conn->set_charset("utf8");
$search = "SELECT f.id as id,f.duplicata AS duplicata,f.notafiscal AS notafiscal,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
		   FROM fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st
		   WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.notafiscal like '%$busca%' OR f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND fd.razao LIKE '%$busca%' OR f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.duplicata LIKE '%$busca%'OR f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND lj.razao LIKE '%$busca%' OR f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND st.stattus LIKE '%$busca%' 
		   ORDER BY f.fornecedor_id,f.duplicata,f.datavencimento ASC
		   LIMIT 50";
$retorno = mysqli_query($conn, $search);
$row_cnt = mysqli_num_rows($retorno);
                      echo "<table class='table table-bordered table-hover table-striped table-responsive-sm list'>";
                      echo "<thead class='thead-dark'>";
                      echo "<tr>";

                      echo  "<th>ID</th>";
                      echo  "<th>LOJA</th>";
                      echo  "<th>FORNECEDOR</th>";                       
                      echo  "<th>NF</th>";
					  echo  "<th>TÍTULO</th>";
                      echo  "<th>VALOR</th>";
                      echo  "<th>Nº PR</th>";
                      echo  "<th>PR</th>";
                      echo  "<th>VALOR PR</th>";
                      echo  "<th>EMISSÃO</th>";
                      echo  "<th>DT VENC.</th>";
                      echo  "<th>STATUS</th>";
                      echo  "<th>DEL</th>";						  
                      echo  "<th class='actions'>AÇÃO</th>";

                      echo  "</tr>";
                      echo "</thead>";



    if($row_cnt >= 1){ 
        foreach ($retorno as $r) {

                      echo "<tbody>";
                      echo "<tr>";
                      echo "<td>{$r['id']}</td>";
                      echo "<td>{$r['loja']}</td>";
                      echo "<td>{$r['fornecedor']}</td>";
                      echo "<td>{$r['notafiscal']}</td>";  
					  echo "<td>{$r['duplicata']}</td>"; 
                      echo "<td>{$r['total']}</td>";
                      echo "<td>{$r['numpr']}</td>";
                      echo "<td>{$r['qtdepr']}</td>";   
                      echo "<td>{$r['valorpr']}</td>";  
                      echo "<td>{$r['datacompra']}</td>";
                      echo "<td>{$r['datavencimento']}</td>";   
                      echo "<td>{$r['stattus']}</td>";
                      echo "  <td class='actions'>"; 					  
                      echo "  <a href='alteraFatura.php?id={$r["id"]}'> <img src='../imagem/editar.png' width='20px' height='20px' title='Editar'> </a>";                      
                      echo "  <a href='detalhe.php?id={$r["id"]}'> <img src='../imagem/detalhe.png' width='20px' height='20px' title='Detalhar'> </a>"; 
					  echo "  <a data-toggle='modal' data-target='#modal' onclick='setaDadosModal({$r["id"]})'> <img src='../imagem/baixar.png' width='20px' height='20px' title='Baixar'></a>";				  
					  echo "  <a data-toggle='modal' data-target='#modal2' onclick='setaDadosModal2({$r["id"]})'> <img src='../imagem/calendar.png' width='20px' height='20px' title='Alterar data'></a>";					  			  
					  echo "  </td>"; 
					  echo "  <td>";
                      echo "  <a href='../controller/deletaFatura.php?id={$r["id"]}'> <img src='../imagem/lixeira.png' width='20px' height='20px' title='Excluir'> </a>"; 
					  echo "  </td>";					  
                      echo "</tr>";
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