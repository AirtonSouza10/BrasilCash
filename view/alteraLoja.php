<!DOCTYPE html>
<html>
<head>
  <title>BrasilCash Software</title>
  <!-- icone -->
  <link rel="icon" href="../imagem/logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="imagem/logo.png" type="image/x-icon" />
  <!-- folha css -->
  <link rel="stylesheet" type="text/css" href="../css/forms.css">
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
        <!--barra de menus superior-->		
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
            <?php 
                require_once '../dao/lojaDAO.php';
               
                $id = $_GET["id"];
                $lojaDAO = new LojaDAO();
                $loja = $lojaDAO->getLojaById($id);   
            ?>		
		  
		<div class="container">
		  <center><h2>Alteração - Loja</h2></center>
			<form method="POST" action="../controller/alteraLoja.php">
			<ul class="form-style-1">
				<li>
				    <input type="text" class="field-long" name="id" value="<?php echo $loja['id']?>" readonly="readonly" />
				</li>
				
				<li>
					<label>Razão Social <span class="required">*</span></label>
					<input type="text" name="razao" class="field-long" value="<?php echo $loja['razao']?>" />
				</li>
				
				<li>
					<label>CNPJ <span class="required">*</span></label>
					<input type="text" name="cnpj" class="field-long" value="<?php echo $loja['cnpj']?>" />
				</li>
				
				<li>
					<input type="submit" value="Confirmar Alteração" />
				</li>
			</ul>
			</form>		  
		  
		</div>
		

</body>
</html>