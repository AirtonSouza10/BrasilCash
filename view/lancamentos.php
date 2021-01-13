<!DOCTYPE html>
<html>
<head>
  <title>BrasilCash Software</title>
  <!-- icone -->
  <link rel="icon" href="../imagem/logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="imagem/logo.png" type="image/x-icon" />
  <!-- folha css -->
  <link rel="stylesheet" type="text/css" href="../css/table.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.mask.min.js"></script>

</head>

        <script type="text/javascript">
        $(document).ready(function(){

                $("#busca").keyup(function(){
                    var busca = $("#busca").val();
                    $.post('busca.php',{busca: busca},function(data){

                            $("#result").html(data);
                         });

                    })           
        })

        </script>

		<script>
		function setaDadosModal(valor) {
			document.getElementById('id').value = valor;
		}
		function setaDadosModal2(valor) {
			document.getElementById('id2').value = valor;
		}		
		</script>
		
		

    <script>
        $(document).ready(function(){

            $("#juro").mask("000000.00", {
                reverse: true
            })				

        })

    </script>		

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
				  <li><a href="contasapagar.php">Contas a Pagar - geral</a></li>	
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
		
		<!--janela modal baixar fatura-->
			<div id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-body">
							<div class="panel-body">
								<form id="modalExemplo" method="post" action="../controller/baixarFatura.php">
								<table>
								<tr>
									<td>
									<label>ID</label>
									<input type="text" name="id" id="id" readonly="readonly">
									</td>
								</tr>
								<tr>
									<td>
									<label>DATA PGTO</label>
									<input type="date" name="datapgto" id="id">
									</td>
								</tr>								
								<tr>
									<td>
									<label>DATA BAIXA</label>
									<input type="date" name="databaixa" id="id" value="<?php echo date('Y-m-d');?>">
									</td>
								</tr>
								<tr>
									<td>
									<label>JUROS</label>
									<input type="text" name="juro" id="juro" value="0.00">
									</td>
								</tr>								
								
								<tr>
									<td>									
									<label>Situação<span class="required">*</span></label>
									<select class="field-select" name="situacao">
									   <?php
										require_once '../dao/situacaoDAO.php';
											  
											$situacaoDAO = new SituacaoDAO();
											$st = $situacaoDAO->getSituacaoPago();
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
										<button type="submit" class="btn-info">Baixar Duplicata</button>
									</td>
								</tr>
								</table>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>



		<!--janela modal alterar fatura-->
			<div id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-body">
							<div class="panel-body">
								<form id="modalExemplo" method="post" action="../controller/alteravencimento.php">
								<table>
								<tr>
									<td>
									<label>ID</label>
									<input type="text" name="id2" id="id2" readonly="readonly">
									</td>
								</tr>
								<tr>
									<td>
									<label>DATA VENCIMENTO</label>
									<input type="date" name="datavencimento" id="id">
									</td>
								</tr>								
								
								<tr>
									<td>									
									<label>Situação<span class="required">*</span></label>
									<select class="field-select" name="situacao">
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
									<textarea name="obs" id="obs" class="field-long field-textarea"></textarea></td>
								</tr>
								
								<tr>
									<td>
										<button type="submit" class="btn-info">Finalizar Alteração</button>
									</td>
								</tr>
								</table>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>



	
			<!--campo de busca-->
                <section class="corpo">
                <h2 class="novo">Busca <a href="index.php"><span><a href="../view/fatura.php"><img src="../imagem/adicionar.png" width="30px" height="30px" title="Adicionar novo registro"></a></span></h2>

                    <div class="form-group">
                        <input class="form-control" type="text" name="busca" id="busca" placeholder="O que procura?">
                    </div>

                </section>
		
		
		
		<div class="containner" id="result">
			<!--Lista de lançamentos cadastradas-->
            <h2>Faturas</h2>
            <!--importacao page lancamentoDAO-->
            <?php
            require_once '../dao/faturaDAO.php';


            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllFaturas();
            ?>
                  <!--lojas-->
                  <table class="table table-striped table-hover table-responsive{xl}" cellspacing="0" cellpadding="0">
                    <thead class="thead-dark">
                        <tr>
                          <th>ID</th>
						  <th>LOJA</th>
                          <th>FORNECEDOR</th>
                          <th>NF</th> 
						  <th>TÍTULO</th> 
						  <th>VALOR</th> 
						  <th>Nº PR</th>
						  <th>PR</th>
                          <th>VLR PR</th>
                          <th>EMISSÃO</th> 
						  <th>DT. VENC.</th> 
						  <th>STATUS</th> 
                          <th>AÇÃO</th>
						  <th>DEL</th>
                        </tr>
                  </thead>
                  <tbody>
                <!--Busca no banco de dados-->
                <?php
                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['total']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['valorpr']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  
                      echo "  <td class='actions'>";
                      echo "  <a href='alteraFatura.php?id={$f["id"]}'> <img src='../imagem/editar.png' width='20px' height='20px' title='Editar'> </a>";                      
                      echo "  <a href='detalhe.php?id={$f["id"]}'> <img src='../imagem/detalhe.png' width='20px' height='20px' title='Detalhar'> </a>"; 
					  echo "  <a data-toggle='modal' data-target='#modal' onclick='setaDadosModal({$f["id"]})'> <img src='../imagem/baixar.png' width='20px' height='20px' title='Baixar'></a>";
					  echo "  <a data-toggle='modal' data-target='#modal2' onclick='setaDadosModal2({$f["id"]})'> <img src='../imagem/calendar.png' width='20px' height='20px' title='Alterar data'></a>";					  
                      echo "  </td>";
					  echo "  <td>";
                      echo "  <a href='../controller/deletaFatura.php?id={$f["id"]}'> <img src='../imagem/lixeira.png' width='20px' height='20px' title='Excluir'> </a>"; 
					  echo "  </td>";
                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";
                  ?>
		</div>		


    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>