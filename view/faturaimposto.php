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
		
		<!--janela modal Fornecedores-->
			<div id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-body">
							<div class="panel-body">
								<form id="modalExemplo" method="post" action="">
                    <h4 class="modal-title">Fornecedores</h4>
                  </div>
                  <div class="modal-body">
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("input[name=busca]").bind('input', function(){
                                var busca = $(this).val();
                                var conta = $(this).val().length;

                                if (conta>=1){
                                    $.post('buscaforn.php',{s_post:busca},function(retorna){
                                        $("#results").html(retorna);
                                    });
                                }else{
                                    $("results").text('Pesquise algo');
                                }
                            });

                            $("#busca").submit(function(){

                            });

                        });
                    </script>

                    <input class="form-control" type="text" name="busca" id="busca">

                    <fieldset>
                        <table class="table"  id="results" name="results">
 
                        </table> 
                    </fieldset>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Confirmar</button>
                  </div>
								
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>	

		<!--janela modal Lojas-->
			<div id="modalL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-body">
							<div class="panel-body">
								<form id="modalExemplo" method="post" action="">
                    <h4 class="modal-title">Lojas</h4>
                  </div>
                  <div class="modal-body">
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("input[name=busca1]").bind('input', function(){
                                var busca = $(this).val();
                                var conta = $(this).val().length;

                                if (conta>=1){
                                    $.post('buscaloja.php',{s_post:busca},function(retorna){
                                        $("#results1").html(retorna);
                                    });
                                }else{
                                    $("results1").text('Pesquise algo');
                                }
                            });

                            $("#busca1").submit(function(){

                            });

                        });
                    </script>

                    <input class="form-control" type="text" name="busca1" id="busca1">

                    <fieldset>
                        <table class="table"  id="results1" name="results1">
 
                        </table> 
                    </fieldset>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="modal-save1">Confirmar</button>
                  </div>
								
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>		
		
        <!--formulário-->		  
		<div class="container">
		 <center> <h3>Cadastro - Faturas (impostos/Diversos)</h3> </center>
			<form method="POST" action="../controller/processaCadastraFatura.php">
			<ul class="form-style-1">
				<li>

					<label>Loja<span class="required">*</span></label>
					<input type="text" name="loja" id="loja" class="field-divided2" readonly >					
					<input type="text" name="loj" id="loj" class="field-long2" readonly >
					<span><img data-toggle="modal" data-target="#modalL" src="../imagem/lupa.png" widht="35px" height="35px" name="loja"></span>

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
					<input type="text" name="fornecedor" id="fornecedor" class="field-divided2" readonly >					
					<input type="text" name="forn" id="forn" class="field-long2" readonly >
					<span><img data-toggle="modal" data-target="#modal" src="../imagem/lupa.png" widht="35px" height="35px" name="loja"></span>

				</li>	
			
				<li>
					<label>Nota Fiscal <span class="required">*</span></label>
					<input type="text" name="notafiscal" class="field-long"/>
				</li>	
				
				<li>
					<label>Emissão <span class="required">*</span></label>
					<input type="date" name="datacompra" class="field-divided"/>
					
				</li>				

				<li>
					<label>Valor Total <span class="required">*</span></label>
					<input type="text" name="total" id="total" class="field-divided"/>
				</li>

				<li>
					
					<label>Prazo<span class="required">*</span></label>
					<select class="field-select" name="prazo">
                       <?php
                        require_once '../dao/prazosDAO.php';
                              
							$prazosDAO = new PrazosDAO();
							$prazo = $prazosDAO->getAllPrazos();
                       ?>
                       <?php                         
                       foreach ($prazo as $p) {
							echo "<option value='{$p["id"]}'>{$p["descricao"]} </option>";
                             }
                        ?>
                    </select>					
					
				</li>				

				<li>
					
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
					
				</li>
				<li>
					
					<label>Tipo<span class="required">*</span></label>
					<select class="field-select" name="tipo">
						<option value="Imposto">Imposto</option>
						<option value="Diversos">Diversos</option>
                    </select>					
					
				</li>				
				
	
				<li>
					<label>Observações <span class="required">*</span></label>
					<textarea name="obs" id="obs" class="field-long field-textarea"></textarea>
				</li>
				<li>
					<input type="submit" value="Cadastrar" />
				</li>
			</ul>
			</form>		 

		</div>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>		
        
		<!--scrip de pesquisa do cliente-->
        <script type="text/javascript">
            $(() => {
              $("#modal-save").on("click", (event) => {
                event.preventDefault();
                const value = $("input[name=my_fornecedor]:checked").val();
                const value2 = $("input[name=my_forn]:checked").val();				
                $('#modal').modal('hide');
                $("input[name=fornecedor]").val(value);
				$("input[name=forn]").val(value2);

              });


            });			
        </script>	
		<!--scrip de pesquisa loja-->
        <script type="text/javascript">
            $(() => {
              $("#modal-save1").on("click", (event) => {
                event.preventDefault();
                const value = $("input[name=my_loja]:checked").val();
                const value2 = $("input[name=my_loj]:checked").val();				
                $('#modalL').modal('hide');
                $("input[name=loja]").val(value);
				$("input[name=loj]").val(value2);

              });


            });			
        </script>		
		
		

</body>
</html>