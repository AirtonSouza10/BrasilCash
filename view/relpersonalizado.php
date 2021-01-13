<!DOCTYPE html>
<html>
<head>
  <title>BrasilCash Software</title>
  <!-- icone -->
  <link rel="icon" href="../imagem/logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="imagem/logo.png" type="image/x-icon" />
  <!-- folha css -->
  
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
 <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
   <link rel="stylesheet" type="text/css" href="../css/relsp.css">
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
		 <legend>Defina os Parâmetros da busca</legend>
		 <form method="post" action="relsp.php">
		 <table>
		 <tr>
			 <td>
				<input type="hidden" name="chkloja" value="no" />
				<input type="checkbox" name="chkloja"value="yes" >
			 </td>
			 <td>
				<label>LOJA</label>
			 </td>
			 <td>
						<select name="loja" >
						<option value="">selecione a loja</option>
						   <?php
							require_once '../dao/lojaDAO.php';
								  
								$lojaDAO = new LojaDAO();
								$loja = $lojaDAO->getAllLojas();
						   ?>
						   <?php                         
						   foreach ($loja as $l) {
								echo "<option value='{$l["id"]}'>{$l["razao"]} {$l["cnpj"]} </option>";
								 }
							?>
						</select>
			 </td>
		 </tr>
		 
		 
		 <tr>
			 <td>
			 <input type="hidden" name="chkfornecedor" value="no" />
			 <input type="checkbox" name="chkfornecedor"  value="yes">
			 </td>

			 <td>
				<label>FORNECEDOR</label>
			 </td>
			 
			 <td>
						<select name="fornecedor">
						<option value="">selecione o fornecedor</option>
						   <?php
							require_once '../dao/fornecedorDAO.php';
								  
								$fornecedorDAO = new FornecedorDAO();
								$fornecedor = $fornecedorDAO->getAllFornecedores();
						   ?>
						   <?php                         
						   foreach ($fornecedor as $f) {
								echo "<option value='{$f["id"]}'>{$f["razao"]} {$f["cnpj"]} </option>";
								 }
							?>
						</select>
			 </td>
		 </tr>
		 
		 
		 <tr>
			 <td>
			 <input type="hidden" name="chksituacao" value="no" />
			 <input type="checkbox" name="chksituacao" value="yes">
			 </td>
			 <td>
				<label>SITUAÇÃO</label>
			 </td>			 
			 
			 <td>
						<select name="situacao">
						<option value="">selecione a situação do titulo</option>
						   <?php
							require_once '../dao/situacaoDAO.php';
								  
								$situacaoDAO = new SituacaoDAO();
								$st = $situacaoDAO->getAllSituacoes();
						   ?>
						   <?php                         
						   foreach ($st as $st) {
								echo "<option value='{$st["id"]}'>{$st["stattus"]} </option>";
								 }
							?>
						</select>
			 </td>
		 </tr>	



		 <tr>
			 <td>
			 <input type="hidden" name="chktipo" value="no" />
			 <input type="checkbox" name="chktipo" value="yes">
			 </td>
			 <td>
				<label>TIPO</label>
			 </td>			 
			 
			 <td>
						<select name="tipo">
						<option value="">Selecione o tipo de fatura</option>
						<option value="Titulo">Título</option>
						<option value="Gratuito">Gratuito/Garantias</option>
						<option value="Imposto">Imposto</option>
						<option value="Diversos">Diversos</option>						
						</select>
			 </td>
		 </tr>	
		 
		 
			 <tr>
				 <td>
					<input type="hidden" name="chkperiodo" value="no" />
					<input type="checkbox" name="chkperiodo"  value="yes">
				</td>
				
				 <td>
					<label>PERÍODO</label>
				 </td>				
				
				<td>
						 <input type="date" name="datainicio" />
						 <input type="date" name="datafim"/>
				 </td>
			 </tr>
			 
			 <tr>
				 <td>
						<input type=image src="../imagem/pesquisa.png" width="50" height="50">
				 </td>
			 </tr>
			 			 
		 
 		 </table>
		 </form>
		 </div>
		 
		 
		 

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>