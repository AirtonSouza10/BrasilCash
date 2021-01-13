
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>BrasilCash Software</title>
		<!-- icone -->
		<link rel="icon" href="imagem/logo.png" type="image/x-icon" />
		<link rel="shortcut icon" href="imagem/logo.png" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component2.css" />
		<script src="js/modernizr-2.6.2.min.js"></script>

<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-7243260-2']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>


	</head>
	<body>
		<!--Validacao de usuario logado-->
        <?php
        session_start();
        include 'view/validaLogin.php';
        include 'dao/conexao.php';
        ?> 	
		<div class="container">
			<header>
				<img src="imagem/logo.png" width="100px" height="100px">
				<h1>BrasilCash Software <span>Suas faturas sob controle</span></h1>	

			</header>
			<div class="component">
				<h2>BrasilCash</h2>
				<!-- Start Nav Structure -->
				<button class="cn-button" id="cn-button">Menu</button>
				<div class="cn-wrapper" id="cn-wrapper">
					<ul>
						<li><a href="view/contasapagar.php"><span>Contas PG</span></a></li>
						<li><a href="view/relhj.php"><span>Diário</span></a></li>
						<li><a href="view/relpersonalizado.php"><span>R. Custom</span></a></li>
						<li><a href="view/lancamentos.php"><span>R. Todos</span></a></li>
						<li><a href="view/mensal.php"><span>R. mensal</span></a></li>
						<li><a href="db_bkp/ScriptBKPOticasBrasil.php"><span>Backup</span></a></li>
						<li><a href="controller/logout.php"><span>Sair</span></a></li>
					 </ul>
				</div>
				<!-- End of Nav Structure -->
			</div>
			<section>
				<p><span>ºTodos os direitos reservados N&A Tecnologiaº</span> - <span></span> <span>Contato: (61) 9 9245-8970 - Brasília - DF</span></p>
			</section>
		</div><!-- /container -->
		<script src="js/polyfills.js"></script>
		<script src="js/demo2.js"></script>
		<!-- For the demo ad only -->   
<script src="http://tympanus.net/codrops/adpacks/demoad.js"></script>
	</body>
</html>