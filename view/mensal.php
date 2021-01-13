<!DOCTYPE html>
<html>
<head>
  <title>BrasilCash Software</title>
  <!-- icone -->
  <link rel="icon" href="../imagem/logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="imagem/logo.png" type="image/x-icon" />
  <!-- folha css -->
  <link rel="stylesheet" type="text/css" href="../css/rels.css">
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



        <!--formulário-->		  
		<div class="containner">
		 <h1>Protocolos de envio para contabilidade</h1>
		 <h3>Notas Fiscais de Recebimento</h3>		 
			<form method="POST" action="notaentrada.php">
				<table>
					<tr>
						<td>
						<select name="loja" class="div-select">
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
						<td><input type="date" name="datainicio"></td>
						<td><input type="date" name="datafim"></td>
						<td><button type="submit" class="btn-md btn-info">Gerar</button></td>
					</tr>
				</table>
			</form>	

			<h3>Títulos</h3>		 
			<form method="POST" action="titulo.php">
				<table>
					<tr>
						<td>
						<select name="loja" class="div-select">
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
						<td><input type="date" name="datainicio"></td>
						<td><input type="date" name="datafim"></td>
						<td><button type="submit" class="btn-md btn-info">Gerar</button></td>
					</tr>
				</table>
			</form>	

			<h3>Impostos</h3>	
			<form method="POST" action="imposto.php">
				<table>
					<tr>
						<td>
						<select name="loja" class="div-select">
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
						<td><input type="date" name="datainicio"></td>
						<td><input type="date" name="datafim"></td>
						<td><button type="submit" class="btn-md btn-info">Gerar</button></td>
					</tr>
				</table>
			</form>	
			
			<h3>Diversos</h3> 	
			<form method="POST" action="diverso.php">
				<table>
					<tr>
						<td>
						<select name="loja" class="div-select">
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
						<td><input type="date" name="datainicio"></td>
						<td><input type="date" name="datafim"></td>
						<td><button type="submit" class="btn-md btn-info">Gerar</button></td>
					</tr>
				</table>
			</form>				
			
		</div>
		
			
			

</body>
</html>