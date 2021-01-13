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

<body>
<?php
        
        session_start();
        include 'validaLogin.php';
        include '../dao/conexao.php';
        
// recuperei os dados do formulario
$loja = $_POST["loja"];
$fornecedor = $_POST["fornecedor"];
$situacao = $_POST["situacao"];
$tipo = $_POST["tipo"];

$datainicio = $_POST["datainicio"];
$datafim = $_POST["datafim"];

//dados dos checkbox
$chkloja = $_POST["chkloja"];
$chkfornecedor = $_POST["chkfornecedor"];
$chksituacao = $_POST["chksituacao"];
$chktipo = $_POST["chktipo"];
$chkperiodo = $_POST["chkperiodo"];
//teste de recebimento de checkers
//if para busca por loja
if($chkloja=="yes" && $chkfornecedor=="no" && $chksituacao=="no" && $chkperiodo=="yes" && $chktipo=="no"){
		//tabela após busca LOJA PERIODO
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getLojaPeriodo($loja,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";	

}
else if($chkloja=="yes" && $chkfornecedor=="no" && $chksituacao=="yes" && $chkperiodo=="yes" && $chktipo=="no"){
	
	//tabela após busca LOJA PERIODO SITUACAO
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getLojaPeriodoSituacao($loja,$situacao,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";
	
}
else if($chkloja=="yes" && $chkfornecedor=="yes" && $chksituacao=="yes" && $chkperiodo=="yes" && $chktipo=="no"){

	//tabela após busca LOJA PERIODO SITUACAO FORNECEDOR
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getLojaPeriodoSituacaoFornecedor($loja,$situacao,$fornecedor,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
//busca sem loja especifica
else if($chkloja=="no" && $chkfornecedor=="no" && $chksituacao=="no" && $chkperiodo=="yes" && $chktipo=="no"){

	//tabela após busca PERIODO
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getPeriodo($datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";

}
else if($chkloja=="no" && $chkfornecedor=="no" && $chksituacao=="yes" && $chkperiodo=="yes" && $chktipo=="no"){

	//tabela após busca PERIODO SITUACAO
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getPeriodoSituacao($situacao,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";

}
else if($chkloja=="no" && $chkfornecedor=="yes" && $chksituacao=="yes" && $chkperiodo=="yes" && $chktipo=="no"){

	//tabela após busca PERIODO SITUACAO FORNECEDOR
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getPeriodoSituacaoFornecedor($situacao,$fornecedor,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
else if($chkloja=="no" && $chkfornecedor=="yes" && $chksituacao=="no" && $chkperiodo=="yes" && $chktipo=="no"){

	//tabela após busca PERIODO  FORNECEDOR
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getPeriodoFornecedor($fornecedor,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";



}
//titulos de uma situacao
else if($chkloja=="no" && $chkfornecedor=="no" && $chksituacao=="yes" && $chkperiodo=="yes" && $chktipo=="no"){

	//tabela após busca SITUACAO PERIODO
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getSituacaoPeriodo($situacao,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
else if($chkloja=="no" && $chkfornecedor=="no" && $chksituacao=="no" && $chkperiodo=="no" && $chktipo=="no"){

	//tabela após busca TODOS TODOS
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllFaturas();
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
//titulos de uma loja
else if($chkloja=="yes" && $chkfornecedor=="no" && $chksituacao=="no" && $chkperiodo=="no" && $chktipo=="no"){

	//tabela após busca SITUACAO PERIODO
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllLoja($loja);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}

//titulos de um fornecedor
else if($chkloja=="no" && $chkfornecedor=="yes" && $chksituacao=="no" && $chkperiodo=="no" && $chktipo=="no"){

	//tabela após busca SITUACAO PERIODO
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllFornecedor($fornecedor);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}

//titulos de um fornecedor
else if($chkloja=="no" && $chkfornecedor=="no" && $chksituacao=="yes" && $chkperiodo=="no" && $chktipo=="no"){

	//tabela após busca SITUACAO PERIODO
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllSituacao($situacao);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}

//titulos de um tipo especifico
else if($chkloja=="no" && $chkfornecedor=="no" && $chksituacao=="no" && $chkperiodo=="no" && $chktipo=="yes"){

	//tabela após busca de um tipo especifico
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipo($tipo);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['total']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}

//titulos de um tipo especifico de uma loja
else if($chkloja=="yes" && $chkfornecedor=="no" && $chksituacao=="no" && $chkperiodo=="no" && $chktipo=="yes"){

	//tabela após busca tipo especifico de uma loja
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoLoja($tipo,$loja);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}

//titulos de um tipo especifico de uma loja e fornecedor
else if($chkloja=="yes" && $chkfornecedor=="yes" && $chksituacao=="no" && $chkperiodo=="no" && $chktipo=="yes"){

	//tabela após busca tipo especifico de uma loja e fornecedor
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoLojaFornecedor($tipo,$loja,$fornecedor);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}

//titulos de um tipo especifico de uma loja e fornecedor e situacao
else if($chkloja=="yes" && $chkfornecedor=="yes" && $chksituacao=="yes" && $chkperiodo=="no" && $chktipo=="yes"){

	//tabela após busca tipo especifico de uma loja e fornecedor e situacao
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoLojaFornecedorSituacao($tipo,$loja,$fornecedor,$situacao);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}

//titulos de um tipo especifico de uma loja e fornecedor e situacao e periodo
else if($chkloja=="yes" && $chkfornecedor=="yes" && $chksituacao=="yes" && $chkperiodo=="yes" && $chktipo=="yes"){

	//tabela após busca tipo especifico de uma loja e fornecedor e situacao e periodo
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoLojaFornecedorSituacaoPeriodo($tipo,$loja,$fornecedor,$situacao,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}

//titulos de um tipo especifico e fornecedor
else if($chkloja=="no" && $chkfornecedor=="yes" && $chksituacao=="no" && $chkperiodo=="no" && $chktipo=="yes"){

	//tabela após busca tipo especifico e fornecedor
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoFornecedor($tipo,$fornecedor);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
//titulos de um tipo especifico e fornecedor e situacao
else if($chkloja=="no" && $chkfornecedor=="yes" && $chksituacao=="yes" && $chkperiodo=="no" && $chktipo=="yes"){

	//tabela após busca tipo especifico e fornecedor
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoFornecedorSituacao($tipo,$fornecedor,$situacao);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
//titulos de um tipo especifico e fornecedor e situacao periodo
else if($chkloja=="no" && $chkfornecedor=="yes" && $chksituacao=="yes" && $chkperiodo=="yes" && $chktipo=="yes"){

	//tabela após busca tipo especifico e fornecedor situacao periodo
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoFornecedorSituacaoPeriodo($tipo,$fornecedor,$situacao,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
//titulos de um tipo especifico e situacao
else if($chkloja=="no" && $chkfornecedor=="no" && $chksituacao=="yes" && $chkperiodo=="no" && $chktipo=="yes"){

	//tabela após busca tipo especifico e situacao
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoSituacao($tipo,$situacao);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
//titulos de um tipo especifico e situacao loja
else if($chkloja=="yes" && $chkfornecedor=="no" && $chksituacao=="yes" && $chkperiodo=="no" && $chktipo=="yes"){

	//tabela após busca tipo especifico e situacao loja
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoSituacaoLoja($tipo,$situacao,$loja);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
//titulos de um tipo especifico e situacao loja periodo
else if($chkloja=="yes" && $chkfornecedor=="no" && $chksituacao=="yes" && $chkperiodo=="yes" && $chktipo=="yes"){

	//tabela após busca tipo especifico e situacao loja periodo
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoSituacaoLojaPeriodo($tipo,$situacao,$loja,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}

//titulos de um tipo especifico e periodo
else if($chkloja=="no" && $chkfornecedor=="no" && $chksituacao=="no" && $chkperiodo=="yes" && $chktipo=="yes"){

	//tabela após busca tipo especifico e periodo
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoPeriodo($tipo,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
//titulos de um tipo especifico e periodo SITUACAO
else if($chkloja=="no" && $chkfornecedor=="no" && $chksituacao=="yes" && $chkperiodo=="yes" && $chktipo=="yes"){

	//tabela após busca tipo especifico e periodo situacao
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoPeriodoSituacao($tipo,$situacao,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
//titulos de um tipo especifico e periodo fornecedor
else if($chkloja=="no" && $chkfornecedor=="yes" && $chksituacao=="no" && $chkperiodo=="yes" && $chktipo=="yes"){

	//tabela após busca tipo especifico e periodo fornecedor
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoPeriodoFornecedor($tipo,$fornecedor,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}
//titulos de um tipo especifico e periodo LOJA
else if($chkloja=="yes" && $chkfornecedor=="no" && $chksituacao=="no" && $chkperiodo=="yes" && $chktipo=="yes"){

	//tabela após busca tipo especifico e periodo loja
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoPeriodoLoja($tipo,$loja,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}

//titulos de um tipo especifico e periodo LOJA fornecedor
else if($chkloja=="yes" && $chkfornecedor=="yes" && $chksituacao=="no" && $chkperiodo=="yes" && $chktipo=="yes"){

	//tabela após busca tipo especifico e periodo loja fornecedor
		echo "<div class='containner' id='result'>";
            require_once '../dao/faturaDAO.php';
			
            $faturaDAO = new FaturaDAO();
            $faturas = $faturaDAO->getAllTipoPeriodoLojaFornecedor($tipo,$loja,$fornecedor,$datainicio,$datafim);
			
        echo "        <table class='table table-striped table-hover table-responsive{xl}' cellspacing='0' cellpadding='0'>";
        echo "        <thead class='thead-dark'>";
        echo "            <tr>";
        echo "            <th>ID</th>";
		echo " 			  <th>LOJA</th>";
        echo "            <th>FORNECEDOR</th>";
        echo "            <th>NF</th>"; 
		echo " 			  <th>TÍTULO</th>";
		echo " 			  <th>PRAZO</th>"; 
		echo " 			  <th>Nº PR</th>";
		echo " 			  <th>PR</th>";
        echo "            <th>VLR PR</th>";
        echo "            <th>DT. EMISSÃO</th>"; 
		echo " 			  <th>DT. VENC.</th>"; 
		echo " 			  <th>STATUS</th>"; 
        echo "            </tr>";
        echo "           </thead>";
        echo "           <tbody>";

                 foreach ($faturas as $f) {
                      echo "<tr>";
                      echo "  <td>{$f['id']}</td>";
                      echo "  <td>{$f['loja']}</td>";
                      echo "  <td>{$f['fornecedor']}</td>";
					  echo "  <td>{$f['notafiscal']}</td>";
					  echo "  <td>{$f['duplicata']}</td>";
					  echo "  <td>{$f['prazo']}</td>";
					  echo "  <td>{$f['numpr']}</td>";
					  echo "  <td>{$f['qtdepr']}</td>";
					  echo "  <td>{$f['soma']}</td>";
					  echo "  <td>{$f['datacompra']}</td>"; 
					  echo "  <td>{$f['datavencimento']}</td>"; 
					  echo "  <td>{$f['stattus']}</td>";					  

                      echo " </tr>";
                 
                      echo "</tbody>";
                    }
                      echo "</table>";

		echo "</div>";


}






else{
	echo	"<script>alert('Relatório inexistente!! Prestenção Rapá!! Favor entrar em contato com o administrador do sistema');</script>";
	echo	"<script>window.location.href = '../view/relpersonalizado.php';</script>";
}

?>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>