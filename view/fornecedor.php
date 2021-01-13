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
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>   

</head>

        <script type="text/javascript">
        $(document).ready(function(){

                $("#busca").keyup(function(){
                    var busca = $("#busca").val();
                    $.post('pesquisafornecedor.php',{busca: busca},function(data){

                            $("#result").html(data);
                         });

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
        <!--barra de menus-->
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

        <!--formulário de cadastro-->		  
		<div class="container">
		  <center><h3>Cadastro - Fornecedor</h3></center>

			<form method="POST" action="../controller/processaCadastraFornecedor.php">
			<ul class="form-style-1">
				<li>
					<label>Razão Social <span class="required">*</span></label>
					<input type="text" name="razao" class="field-long"/> 
				</li>
				
				<li>
					<label>Telefone</label>
					<input type="text" name="telefone" class="field-long" />
				</li>

				<li>
					<label>CNPJ <span class="required">*</span></label>
					<input type="text" name="cnpj" class="field-long" />
				</li>
				
				<li>
					<input type="submit" value="Cadastrar" />
				</li>
			</ul>
			</form>
		  
		  
		</div>
		

			<!--campo de busca-->
                <section class="corpo">
                <center><h2 class="novo">Busca<span></span></h2></center>

                    <div class="form-group">
                        <input class="form-control" type="text" name="busca" id="busca" placeholder="O que procura?">
                    </div>

                </section>
				
				
		
		<div class="container" id="result">
			<!--Lista de Fornecedores cadastrados-->
            <h2>Fornecedores</h2>
            <!--importacao page fornecedorDAO-->
            <?php
            require_once '../dao/fornecedorDAO.php';


            $fornecedorDAO = new FornecedorDAO();
            $fornecedores = $fornecedorDAO->getAllFornecedores();
            ?>
                  <!--FORNECEDORES-->
                  <table class="table table-striped table-hover table-responsive{xl}" cellspacing="0" cellpadding="0">
                    <thead class="thead-dark">
                        <tr>
                          <th>ID</th>
                          <th>RAZÃO SOCIAL</th>
						  <th>TELEFONE</th>
                          <th>CNPJ</th>  
                          <th>AÇÃO</th>
                        </tr>
                  </thead>
                  <tbody>
                <!--Busca no banco de dados-->
                <?php
                 foreach ($fornecedores as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['razao']}</td>";
					  echo "  <td>{$f['telefone']}</td>";
                      echo "  <td>{$f['cnpj']}</td>";
                      echo "  <td class='actions'>";
                      echo "  <a href='../controller/deletaFornecedor.php?id={$f["id"]}'> <img src='../imagem/lixeira.png' width='35px' height='35px'title='Exclur'> </a>"; 
                      echo "  <a href='alteraFornecedor.php?id={$f["id"]}'> <img src='../imagem/editar.png' width='35px' height='35px'title='Editar'> </a>";                      
                      
                      echo "       </td>";
                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";
                  ?>
		</div>		
		

</body>
</html>