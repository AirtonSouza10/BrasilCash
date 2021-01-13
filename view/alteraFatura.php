<!DOCTYPE html>
<html>
<head>
  <title>BrasilCash Software</title>
  <!-- icone -->
  <link rel="icon" href="../imagem/logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="imagem/logo.png" type="image/x-icon" />
  <!-- folha css -->
  <link rel="stylesheet" type="text/css" href="../css/formFatura.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.mask.min.js"></script>  

    <script>
        $(document).ready(function(){

            $("#total").mask("000000.00", {
                reverse: true
            })

            $("#valorpr").mask("000000.00", {
                reverse: true
            })
            $("#juro").mask("000000.00", {
                reverse: true
            })				

        })

    </script>


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
            <?php 
                require_once '../dao/faturaDAO.php';
               
                $id = $_GET["id"];
                $faturaDAO = new FaturaDAO();
                $fatura = $faturaDAO->getFaturaById($id);   
            ?>	
		
		<div class="container">
		 <center> <h3>Alteração - Faturas</h3> </center>
			<form method="POST" action="../controller/alteraFatura.php">
			<ul class="form-style-1">

				<li>
				<input type="text" name="id" value="<?php echo $fatura['id']?>"readonly="readonly">
				</li>			
			
				<li>
					<label>Loja<span class="required">*</span></label>
					<select class="field-select" name="loja">
                       <?php
						echo "<option value='{$fatura["loja_id"]}' selected>{$fatura["loja"]}(atual)</option>";
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

				</li>
				
				<!--pegar nome do usuario logado-->
				<?php
					require_once '../dao/operadorDAO.php';			
					$cpf = $_SESSION["cpf"];    
                $operadorDAO = new OperadorDAO();
                $operador = $operadorDAO->getOperadorByCpf($cpf); 
				$operadore=$operador['id'];
				?>				
				
				<li>
				<input type="hidden" name="operador" value="<?php echo $operadore; ?>">
				</li>
				
				<li>
					
					<label>Fornecedor<span class="required">*</span></label>
					<select class="field-select" name="fornecedor">
                       <?php
					    echo "<option value='{$fatura["fornecedor_id"]}' selected>{$fatura["fornecedor"]}(atual)</option>";
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
					
					
					
				</li>		
			
				<li>
					<label>Nota Fiscal <span class="required">*</span></label>
					<input type="text" name="notafiscal" class="field-long" value="<?php echo $fatura['notafiscal']?>"/>
				</li>	

				<li>
					<label>Título <span class="required">*</span></label>
					<input type="text" name="duplicata" class="field-long" value="<?php echo $fatura['duplicata']?>"/>
				</li>
				
				<li>
					<label>Emissão <span class="required">*</span></label>
					<input type="date" name="datacompra" class="field-divided"value="<?php echo $fatura['datacompra']?>" />
					
				</li>				
				<li>
					<label>Data Vencimento <span class="required">*</span></label>
					<input type="date" name="datavencimento" class="field-divided"value="<?php echo $fatura['datavencimento']?>" />
					
				</li>
			
				<li>
					<label>Valor Total <span class="required">*</span></label>
					<input type="text" name="total" id="total" class="field-divided"value="<?php echo $fatura['total']?>"  />
				</li>
				<li>
					
					<label>Prazo<span class="required">*</span></label>
					<select class="field-select" name="prazo">
                       <?php
					    echo "<option value='{$fatura["prazo_id"]}' selected> {$fatura["prazo"]} (atual)</option>";
                        require_once '../dao/prazosDAO.php';
                              
							$prazosDAO = new PrazosDAO();
							$prazos = $prazosDAO->getAllPrazos();
                       ?>
                       <?php                         
                       foreach ($prazos as $pz) {
							echo "<option value='{$pz["id"]}'>{$pz["descricao"]} </option>";
                             }
                        ?>
                    </select>					
				</li>				
				<li>
					<label>Valor Parcela <span class="required">*</span></label>
					<input type="text" name="valorpr" id="valorpr" class="field-divided"value="<?php echo $fatura['valorpr']?>"  />
				</li>
				<li>
					<label>Juros <span class="required">*</span></label>
					<input type="text" name="juro" id="juro" class="field-divided"value="<?php echo $fatura['juro']?>"  />
				</li>				

				<li>
					
					<label>Situação<span class="required">*</span></label>
					<select class="field-select" name="situacao">
                       <?php
					    echo "<option value='{$fatura["situacao_id"]}' selected>{$fatura["stattus"]} (atual)</option>";
                        require_once '../dao/situacaoDAO.php';
                              
							$situacaoDAO = new SituacaoDAO();
							$st = $situacaoDAO->getSituacaoSemPago();
                       ?>
                       <?php                         
                       foreach ($st as $st) {
							echo "<option value='{$st["id"]}'>{$st["stattus"]} </option>";
                             }
                        ?>
                    </select>					
					
				</li>

				<li>
					
					<label>Tipo<span class="required">*</span></label>
					<select class="field-select" name="tipo">
                       <?php
					    echo "<option value='{$fatura["tipo"]}' selected>{$fatura["tipo"]} (atual)</option>";
                       ?>   
						<option value="Titulo">Título</option>
						<option value="Imposto">Imposto</option>
						<option value="Diversos">Diversos</option>
						<option value="Gratuito">Gratuito/Garantias</option>
                    </select>					
					
				</li>				
	
				<li>
					<label>Observações <span class="required">*</span></label>
					<textarea name="obs" id="obs" class="field-long field-textarea"><?php echo $fatura['obs']; ?></textarea>
				</li>
				
				<li>
					<input type="submit" value="Confirmar Alteração" />
				</li>
			</ul>
			</form>		 

		</div>
		
		
		

</body>
</html>