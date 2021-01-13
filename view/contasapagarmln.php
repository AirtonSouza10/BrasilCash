<!DOCTYPE html>
<html>
<head>
  <title>BrasilCash Software</title>
  <!-- icone -->
  <link rel="icon" href="../imagem/logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="imagem/logo.png" type="image/x-icon" />
  <!-- folha css -->
  <link rel="stylesheet" type="text/css" href="../css/contasapagar.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  

</head>
<body>
        <!--Validacao de usuario logado-->
        <?php
        session_start();
        include 'validaLogin.php';
        include '../dao/conexao.php';
        ?> 
        <!--barra de menu-->
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="../index2.php">BrasilCash Software</a>
			</div>
			<ul class="nav navbar-nav">
			  <li class="active"><a href="../index2.php">Home</a></li>
			  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastros <span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="loja.php">Loja</a></li>
				  <li><a href="operador.php">Operador</a></li>
				  <li><a href="fornecedor.php">Fornecedor</a></li>
				  <li><a href="situacao.php">Situação</a></li>
				  <li><a href="prazos.php">Prazos</a></li>
				  <li><a href="fatura.php">Nota Fiscal - Recebimento</a></li>	
				  <li><a href="faturaimposto.php">Faturas (impostos/Diversos)</a></li>					  
				</ul>
			  </li>
			  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Relatórios <span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="relhj.php">Títulos de hj</a></li>
				  <li><a href="relpersonalizado.php">Relatórios personalizados</a></li>
				  <li><a href="mensal.php">Mensal-Protocolo</a></li>
				  <li><a href="contasapagar.php">Contas a Pagar</a></li>
				  <li><a href="contasapagaralm.php">Contas a Pagar - ALM</a></li>
				  <li><a href="contasapagaralmirio.php">Contas a Pagar - ALMIRIO</a></li>
				  <li><a href="contasapagarbrasilantigo.php">Contas a Pagar - BRASIL -ANTIGO</a></li>
				  <li><a href="contasapagarbrasileiras.php">Contas a Pagar - BRASILEIRAS</a></li>
				  <li><a href="contasapagarconjunto.php">Contas a Pagar - CONJUNTO</a></li>
				  <li><a href="contasapagarfazenda.php">Contas a Pagar - FAZENDA</a></li>
				  <li><a href="contasapagarmln.php">Contas a Pagar - MLN</a></li>					  
				</ul>
			  </li>	
			  <li><a href="lancamentos.php">Lançamentos</a></li>
			  <li><a href="bxportitulo.php">Baixa  por título</a></li>
			  <li><a href="../db_bkp/ScriptBKPOticasBrasil.php">Backup</a></li>			  
			  <li><a href="../controller/logout.php">Sair</a></li>
			</ul>
		  </div>
		</nav>
	
		
		<div class="containner">
			<?php
				$mes = date('M');
				$mes_extenso = array(
					'Jan' => 'JANEIRO',
					'Feb' => 'FEVEREIROO',
					'Mar' => 'MARÇO',
					'Apr' => 'ABRIL',
					'May' => 'MAIO',
					'Jun' => 'JUNHO',
					'Jul' => 'JULHO',
					'Aug' => 'AGOSTO',
					'Nov' => 'NOVEMBRO',
					'Sep' => 'SETEMBRO',
					'Oct' => 'OUTUBRO',
					'Dec' => 'DEZEMBRO'
				);				
				$ano = date("Y");
			?>
			
			
            <?php
            require_once '../dao/faturaDAO.php';
			$faturaDAO = new FaturaDAO();
            $meses = $faturaDAO->getContasAPagarMesesMln();
	
            ?>			
			<!--valores por mês e fornecedor-->
            <center><h4>  CONTAS A PAGAR - FORNECEDORES - ÓTICAS MLN EIRELI - <?php echo $mes_extenso["$mes"]."/".$ano ?> </h4></center>
			<center>
			<table id="pagar">
			  <tbody>
                <!--Busca no banco de dados-->
                <?php
				//foreach  para mostrar meses
                 foreach ($meses as $m) {
				$mes = date('M');
				$mes_extenso = array(
					'January' => 'JANEIRO',
					'February' => 'FEVEREIRO',
					'March' => 'MARÇO',
					'April' => 'ABRIL',
					'May' => 'MAIO',
					'June' => 'JUNHO',
					'July' => 'JULHO',
					'August' => 'AGOSTO',
					'November' => 'NOVEMBRO',
					'September' => 'SETEMBRO',
					'October' => 'OUTUBRO',
					'December' => 'DEZEMBRO'
				);				
					  
						$mescp = $m['month'];
						$anocp = $m['year'];
						$mesext = $mes_extenso["$mescp"];					
	 	
                      echo "<th id='date' colspan='2'>";	
						echo "$mesext / $anocp";
                      echo "</th>";
	            $faturaDAO = new FaturaDAO();
				$faturas = $faturaDAO->getContasAPagarMln($mescp,$anocp);
				
				//foreach para mostrar fornecedores
					 foreach ($faturas as $f) {
							
						  echo "<tr>";	
						  echo "  <td id='fornecedor'>{$f['fornecedor']}</td>";
						  echo "  <td id='soma'>{$f['soma']}</td>";				  
						  echo "</tr>";
						}
				
				//mostrar totais
	            $faturaDAO = new FaturaDAO();
				$total = $faturaDAO->getContasAPagarTotalMln($mescp,$anocp);
					
						foreach ($total as $t){
						  echo "<tr id='tt'>";	
						  echo "  <td id='total'>TOTAL:</td><td id='totalvlr'>{$t['total']}</td>";					  
						  echo "</tr>";	

						}
					  	  
                    }
					
				//mostrar total geral
	            $faturaDAO = new FaturaDAO();
				$totalgeral = $faturaDAO->getContasAPagarTotalGeralMln();
					foreach($totalgeral as $tg){
						  echo "<tr id='tt'>";	
						  echo "	<td id='totalgeral'>TOTAL  GERAL	:</td><td id='valorgeral'>{$tg['totalgeral']}</td>";					  
						  echo "</tr>";		
					}
                  ?>		  				
			  </tbody>
			  
			</table>
			</center>

 
		</div>		

</body>
</html>