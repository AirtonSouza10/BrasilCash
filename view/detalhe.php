<!DOCTYPE html>
<html>
<head>
  <title>BrasilCash Software</title>
  <!-- icone -->
  <link rel="icon" href="../imagem/logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="imagem/logo.png" type="image/x-icon" />
  <!-- folha css -->
  <link rel="stylesheet" type="text/css" href="../css/detalhe.css">
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
                require_once '../dao/faturaDAO.php';
               
                $id = $_GET["id"];
                $faturaDAO = new FaturaDAO();
                $fatura = $faturaDAO->getFaturaByIdDel($id); 			
				$id = $_GET["id"];
			?>
			<!--detalhamento do registro-->
            <center><h2>Detalhe do Registro: <?php echo $id ?> </h2></center>
			<center>
			<table>
			  <tbody>
				<tr>
				  <td>OPERADOR:</td>
				  <td><?php echo $fatura['operador']?></td>
				</tr>		  
				<tr>
				  <td>LOJA:</td>
				  <td><?php echo $fatura['loja']?></td>
				</tr>
				<tr>
				  <td>CNPJ:</td>
				  <td><?php echo $fatura['cnpj']?></td>
				</tr>
				<tr>
				  <td>FORNECEDOR:</td>
				  <td><?php echo $fatura['fornecedor']?></td>
				</tr>
				<tr>
				  <td>NOTA FISCAL:</td>
				  <td><?php echo $fatura['notafiscal']?></td>
				</tr>				
				<tr>
				  <td>TIPO:</td>
				  <td><?php echo $fatura['tipo']?></td>
				</tr>
				
				<tr>
				  <td>TÍTULO:</td>
				  <td><?php echo $fatura['duplicata']?></td>
				</tr>				
				<tr>
				  <td>TOTAL:</td>
				  <td><?php echo $fatura['total']?></td>
				</tr>
				<tr>
				  <td>PRAZO:</td>
				  <td><?php echo $fatura['prazo']?></td>
				</tr>
				<tr>
				  <td>PARCELA:</td>
				  <td><span><?php echo $fatura['numpr']?> de <?php echo $fatura['qtdepr']?></span> <span></td>
				</tr>
				<tr>
				  <td>VLR PARCELA:</td>
				  <td><?php echo $fatura['valorpr']?></td>
				</tr>
				<tr>
				  <td>JUROS:</td>
				  <td><?php echo $fatura['juro']?></td>
				</tr>
				<tr>
				  <td>EMISSÂO:</td>
				  <td><?php echo $fatura['datacompra']?></td>
				</tr>
				<tr>
				  <td>VENCIMENTO:</td>
				  <td><?php echo $fatura['datavencimento']?></td>
				</tr>
				<tr>
				  <td>PAGAMENTO:</td>
				  <td><?php echo $fatura['datapgto']?></td>
				</tr>
				<tr>
				  <td>BAIXA:</td>
				  <td><?php echo $fatura['databaixa']?></td>
				</tr>
				<tr>
				  <td>SITUAÇÃO:</td>
				  <td><?php echo $fatura['stattus']?></td>
				</tr>					
				<tr>
				  <td>OBSERVAÇÔES:</td>
				  <td><?php echo $fatura['obs']?></td>
				</tr>				
			  </tbody>
			</table>
			</center>
 
		</div>		

</body>
</html>