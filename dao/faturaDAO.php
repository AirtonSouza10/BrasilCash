<?php

require_once 'conexao.php'; 


class FaturaDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

    public function getAllFaturas() {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS 	notafiscal,f.duplicata AS duplicata,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,round(f.total,2) AS total,round(f.valorpr,2) AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id
					ORDER BY f.id DESC LIMIT 100";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }


    public function getFaturasBxPorTitulo() {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS 	notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,round(f.total,2) AS total,round(f.valorpr,2) AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id
					GROUP BY duplicata,f.loja_id,f.fornecedor_id
					ORDER BY f.id DESC LIMIT 100";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function salvarFatura(FaturaDTO $faturaDTO) {
        try {
            $sql = "INSERT INTO fatura (loja_id,operador_id,fornecedor_id,prazo_id,situacao_id,notafiscal,datacompra,datavencimento,total,valorpr,obs,numpr,tipo) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $faturaDTO->getLoja_id());
            $stmt->bindValue(2, $faturaDTO->getOperador_id());
            $stmt->bindValue(3, $faturaDTO->getFornecedor_id());
            $stmt->bindValue(4, $faturaDTO->getPrazo_id());
            $stmt->bindValue(5, $faturaDTO->getSituacao_id());
            $stmt->bindValue(6, $faturaDTO->getNotafiscal());	
            $stmt->bindValue(7, $faturaDTO->getDatacompra());
			$stmt->bindValue(8, $faturaDTO->getDatavencimento());
            $stmt->bindValue(9, $faturaDTO->getTotal());
            $stmt->bindValue(10, $faturaDTO->getValorpr());
            $stmt->bindValue(11, $faturaDTO->getObs());
            $stmt->bindValue(12, $faturaDTO->getNumpr());
            $stmt->bindValue(13, $faturaDTO->getTipo());			
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function excluirFatura($idfatura) {
        try {
            $sql = "DELETE FROM fatura
                   WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idfatura);
            $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
	    public function excluirFaturaPorNotaFiscal($notaCancelar,$fornecedorCancelar,$lojaCancelar) {
        try {
            $sql = "DELETE FROM fatura
                   WHERE notafiscal = ? AND fornecedor_id=? AND loja_id=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $notaCancelar);
            $stmt->bindValue(2, $fornecedorCancelar);	
            $stmt->bindValue(3, $lojaCancelar);				
            $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
	
    public function getProtocoloNota($loja,$dtinicio,$dtfim) {
        try {
            $sql = "SELECT f.notafiscal AS notafiscal,f.id as id,f.duplicata AS duplicata,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total, 2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.loja_id=? AND f.datacompra BETWEEN ? and ? AND f.tipo<>'Imposto' AND f.tipo<>'Diversos'  
					GROUP BY f.notafiscal
					ORDER BY fd.razao,f.datacompra ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $loja);			
            $stmt->bindValue(2, $dtinicio);
            $stmt->bindValue(3, $dtfim);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function getProtocoloTitulo($loja,$dtinicio,$dtfim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datapgto,'%d/%m/%Y') AS datapgto,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.loja_id=? AND f.datapgto BETWEEN ? and ? AND f.tipo='Título'
					GROUP BY duplicata
					ORDER BY fd.razao,f.datapgto ASC";
					
            $stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(1, $loja);
            $stmt->bindValue(2, $dtinicio);
            $stmt->bindValue(3, $dtfim);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getProtocoloImposto($loja,$dtinicio,$dtfim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS duplicata,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,DATE_FORMAT(f.datapgto,'%d/%m/%Y') AS datapgto,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.loja_id=? AND f.datapgto BETWEEN ? and ? AND f.tipo='Imposto'
					ORDER BY f.datapgto ASC";
            $stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(1, $loja);
            $stmt->bindValue(2, $dtinicio);
            $stmt->bindValue(3, $dtfim);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getProtocoloDiversos($loja,$dtinicio,$dtfim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS duplicata,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,DATE_FORMAT(f.datapgto,'%d/%m/%Y') AS datapgto,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.loja_id=? AND f.datapgto BETWEEN ? and ? AND f.tipo='Diversos'
					ORDER BY f.datapgto ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $loja);			
            $stmt->bindValue(2, $dtinicio);
            $stmt->bindValue(3, $dtfim);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getFaturaByHj() {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.datavencimento = curdate() AND f.situacao_id=1 OR f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND situacao_id=4 AND f.loja_id=lj.id AND  f.datavencimento = curdate() OR f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND situacao_id=7 AND f.loja_id=lj.id AND f.datavencimento = curdate()
					GROUP BY duplicata,f.loja_id,f.notafiscal
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getFaturaByHjVencido() {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') AS duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.datavencimento < curdate() AND f.situacao_id=1 OR f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND situacao_id=4 AND f.datavencimento < curdate() OR f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND situacao_id=7 AND f.datavencimento < curdate()
					GROUP BY duplicata,f.loja_id,f.notafiscal
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
	
    public function getFaturaByIdDel($id) {
        try {
            $sql = "SELECT f.id as id,lj.cnpj as cnpj,format(f.juro,2,'de_DE') AS juro,f.notafiscal AS notafiscal,f.duplicata AS duplicata,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja,op.nome As operador,DATE_FORMAT(f.datapgto,'%d/%m/%Y') AS datapgto,DATE_FORMAT(f.dtbaixa,'%d/%m/%Y') AS databaixa,f.obs
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.id = ? AND f.loja_id=lj.id AND f.fornecedor_id=fd.id AND f.operador_id=op.id AND f.situacao_id=st.id AND f.prazo_id=pz.id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $loja = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loja;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function getFaturaById($id) {
        try {
            $sql = "SELECT f.id as id,round(f.juro,2) AS juro,f.prazo_id as prazo_id,f.duplicata AS duplicata,f.tipo,f.loja_id AS loja_id,f.fornecedor_id AS fornecedor_id,f.situacao_id AS situacao_id,f.notafiscal AS notafiscal,f.datacompra AS datacompra,f.datavencimento AS datavencimento,f.datapgto AS datapgto,round(f.total,2) AS total,round(f.valorpr,2) AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja,op.nome,f.datapgto AS datapgto,f.dtbaixa AS databaixa,f.obs
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.id = ? AND f.loja_id=lj.id AND f.fornecedor_id=fd.id AND f.operador_id=op.id AND f.situacao_id=st.id AND f.prazo_id=pz.id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $loja = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loja;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function buscaTituloPorId($id) {
        try {
            $sql = "SELECT f.duplicata AS duplicata,f.fornecedor_id AS fornecedor,f.loja_id AS loja,pz.qtdepr 
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.id = ? AND f.loja_id=lj.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.operador_id=op.id AND f.situacao_id=st.id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $loja = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loja;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
	
    public function updateFaturaById(FaturaDTO $faturaDTO) {
        try {
            $sql = "UPDATE fatura SET  loja_id=?,
									   operador_id=?,
									   fornecedor_id=?,
									   situacao_id=?,
									   notafiscal=?,
									   datacompra=?,
									   datavencimento=?,
									   total=?,
									   valorpr=?,
									   obs=?,
									   duplicata=?,
									   tipo=?,
									   juro=?
                    WHERE id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $faturaDTO->getLoja_id());
			$stmt->bindValue(2, $faturaDTO->getOperador_id());
			$stmt->bindValue(3, $faturaDTO->getFornecedor_id());  
			$stmt->bindValue(4, $faturaDTO->getSituacao_id());
			$stmt->bindValue(5, $faturaDTO->getNotafiscal());
			$stmt->bindValue(6, $faturaDTO->getDatacompra());  
			$stmt->bindValue(7, $faturaDTO->getDatavencimento());
			$stmt->bindValue(8, $faturaDTO->getTotal());  
			$stmt->bindValue(9, $faturaDTO->getValorpr());
            $stmt->bindValue(10, $faturaDTO->getObs());
            $stmt->bindValue(11, $faturaDTO->getDuplicata());	
            $stmt->bindValue(12, $faturaDTO->getTipo());
            $stmt->bindValue(13, $faturaDTO->getJuro());			
            $stmt->bindValue(14, $faturaDTO->getId()); 			
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	

    public function updateFaturaByIdResetPgto(FaturaDTO $faturaDTO) {
        try {
            $sql = "UPDATE fatura SET  loja_id=?,
									   operador_id=?,
									   fornecedor_id=?,
									   situacao_id=?,
									   notafiscal=?,
									   datacompra=?,
									   datavencimento=?,
									   total=?,
									   valorpr=?,
									   obs=?,
									   duplicata=?,
									   tipo=?,
									   datapgto=?,
									   dtbaixa=?,
									   juro=?
                    WHERE id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $faturaDTO->getLoja_id());
			$stmt->bindValue(2, $faturaDTO->getOperador_id());
			$stmt->bindValue(3, $faturaDTO->getFornecedor_id());  
			$stmt->bindValue(4, $faturaDTO->getSituacao_id());
			$stmt->bindValue(5, $faturaDTO->getNotafiscal());
			$stmt->bindValue(6, $faturaDTO->getDatacompra());  
			$stmt->bindValue(7, $faturaDTO->getDatavencimento());
			$stmt->bindValue(8, $faturaDTO->getTotal());  
			$stmt->bindValue(9, $faturaDTO->getValorpr());
            $stmt->bindValue(10, $faturaDTO->getObs());
            $stmt->bindValue(11, $faturaDTO->getDuplicata());	
            $stmt->bindValue(12, $faturaDTO->getTipo());
            $stmt->bindValue(13, $faturaDTO->getDatapgto());
            $stmt->bindValue(14, $faturaDTO->getDtbaixa());	
            $stmt->bindValue(15, $faturaDTO->getJuro());			
            $stmt->bindValue(16, $faturaDTO->getId()); 			
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }


    public function updateBaixa(FaturaDTO $faturaDTO) {
        try {
            $sql = "UPDATE fatura SET  datapgto=?,
									   dtbaixa=?,
									   situacao_id=?,
									   juro=?
                    WHERE id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $faturaDTO->getDatapgto());
			$stmt->bindValue(2, $faturaDTO->getDtbaixa());	
			$stmt->bindValue(3, $faturaDTO->getSituacao_id());	
			$stmt->bindValue(4, $faturaDTO->getJuro());				
            $stmt->bindValue(5, $faturaDTO->getId()); 			
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }


    public function updateBaixaPorTitulo(FaturaDTO $faturaDTO) {
        try {
            $sql = "UPDATE fatura SET  datapgto=?,
									   dtbaixa=?,
									   situacao_id=?,
									   juro=?
                    WHERE duplicata= ? AND fornecedor_id= ? AND loja_id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $faturaDTO->getDatapgto());
			$stmt->bindValue(2, $faturaDTO->getDtbaixa());	
			$stmt->bindValue(3, $faturaDTO->getSituacao_id());	
			$stmt->bindValue(4, $faturaDTO->getJuro());				
            $stmt->bindValue(5, $faturaDTO->getDuplicata()); 	
            $stmt->bindValue(6, $faturaDTO->getFornecedor_id()); 
            $stmt->bindValue(7, $faturaDTO->getLoja_id()); 			
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function updateBaixaFatura(FaturaDTO $faturaDTO) {
        try {
            $sql = "UPDATE fatura SET  datapgto=?,
									   dtbaixa=?,
									   situacao_id=?,
									   juro=?
                    WHERE duplicata= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $faturaDTO->getDatapgto());
			$stmt->bindValue(2, $faturaDTO->getDtbaixa());	
			$stmt->bindValue(3, $faturaDTO->getSituacao_id());	
			$stmt->bindValue(4, $faturaDTO->getJuro());				
            $stmt->bindValue(5, $faturaDTO->getDuplicata()); 			
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
	
	
	    public function updateAlteraTituloVencimento(FaturaDTO $faturaDTO) {
        try {
            $sql = "UPDATE fatura SET  datavencimento=?,
									   situacao_id=?,
									   obs=?
                    WHERE duplicata= ? AND fornecedor_id= ? AND loja_id= ?";
            $stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(1, $faturaDTO->getDatavencimento());	
			$stmt->bindValue(2, $faturaDTO->getSituacao_id());
			$stmt->bindValue(3, $faturaDTO->getObs());			
            $stmt->bindValue(4, $faturaDTO->getDuplicata()); 	
            $stmt->bindValue(5, $faturaDTO->getFornecedor_id()); 
            $stmt->bindValue(6, $faturaDTO->getLoja_id()); 			
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
	//contas a pagar para marilene
	//------------------------------------------------------------------
	//--------------------------------------------------------------------
	//--------------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
    public function getContasAPagar($mescp,$anocp) {
        try {
            $sql = "SELECT distinct fornecedor,soma as soma,month,year
					FROM contasapagar
					WHERE month=? AND year=?
					GROUP BY MesAno,fornecedor 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getContasAPagarAlm($mescp,$anocp) {
        try {
            $sql = "SELECT distinct fornecedor,soma as soma,month,year
					FROM alm
					WHERE month=? AND year=?
					GROUP BY MesAno,fornecedor 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getContasAPagarAlmirio($mescp,$anocp) {
        try {
            $sql = "SELECT distinct fornecedor,soma as soma,month,year
					FROM almirio
					WHERE month=? AND year=?
					GROUP BY MesAno,fornecedor 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getContasAPagarBrasil03antigo($mescp,$anocp) {
        try {
            $sql = "SELECT distinct fornecedor,soma as soma,month,year
					FROM brasil03antigo
					WHERE month=? AND year=?
					GROUP BY MesAno,fornecedor 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getContasAPagarBrasileiras($mescp,$anocp) {
        try {
            $sql = "SELECT distinct fornecedor,soma as soma,month,year
					FROM brasileiras
					WHERE month=? AND year=?
					GROUP BY MesAno,fornecedor 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getContasAPagarConjunto($mescp,$anocp) {
        try {
            $sql = "SELECT distinct fornecedor,soma as soma,month,year
					FROM conjunto
					WHERE month=? AND year=?
					GROUP BY MesAno,fornecedor 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getContasAPagarFazenda($mescp,$anocp) {
        try {
            $sql = "SELECT distinct fornecedor,soma as soma,month,year
					FROM fazenda
					WHERE month=? AND year=?
					GROUP BY MesAno,fornecedor 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getContasAPagarMln($mescp,$anocp) {
        try {
            $sql = "SELECT distinct fornecedor,soma as soma,month,year
					FROM mln
					WHERE month=? AND year=?
					GROUP BY MesAno,fornecedor 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
//--------------------------------------------------	
    public function getContasAPagarMeses() {
        try {
            $sql = "SELECT distinct fornecedor,soma,month,year
					FROM contasapagar
					GROUP BY MesAno 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getContasAPagarMesesAlm() {
        try {
            $sql = "SELECT distinct fornecedor,soma,month,year
					FROM alm
					GROUP BY MesAno 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getContasAPagarMesesAlmirio() {
        try {
            $sql = "SELECT distinct fornecedor,soma,month,year
					FROM almirio
					GROUP BY MesAno 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
    public function getContasAPagarMesesBrasil03antigo() {
        try {
            $sql = "SELECT distinct fornecedor,soma,month,year
					FROM brasil03antigo
					GROUP BY MesAno 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getContasAPagarMesesBrasileiras() {
        try {
            $sql = "SELECT distinct fornecedor,soma,month,year
					FROM brasileiras
					GROUP BY MesAno 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function getContasAPagarMesesConjunto() {
        try {
            $sql = "SELECT distinct fornecedor,soma,month,year
					FROM conjunto
					GROUP BY MesAno 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getContasAPagarMesesFazenda() {
        try {
            $sql = "SELECT distinct fornecedor,soma,month,year
					FROM fazenda
					GROUP BY MesAno 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getContasAPagarMesesMln() {
        try {
            $sql = "SELECT distinct fornecedor,soma,month,year
					FROM mln
					GROUP BY MesAno 
					ORDER BY MesAno ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
//-------------------------------------------------------------------------------------


    public function getContasAPagarTotal($mescp,$anocp) {
        try {
            $sql = "SELECT fornecedor,format(sum(soma),2,'de_DE') as total,month,year
					FROM contaspg
					WHERE month=? AND year=?
					GROUP BY month,year";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getContasAPagarTotalAlm($mescp,$anocp) {
        try {
            $sql = "SELECT fornecedor,format(sum(soma),2,'de_DE') as total,month,year
					FROM almponto
					WHERE month=? AND year=?
					GROUP BY month,year";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getContasAPagarTotalAlmirio($mescp,$anocp) {
        try {
            $sql = "SELECT fornecedor,format(sum(soma),2,'de_DE') as total,month,year
					FROM almirioponto
					WHERE month=? AND year=?
					GROUP BY month,year";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getContasAPagarTotalBrasil03antigo($mescp,$anocp) {
        try {
            $sql = "SELECT fornecedor,format(sum(soma),2,'de_DE') as total,month,year
					FROM brasil03antigoponto
					WHERE month=? AND year=?
					GROUP BY month,year";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getContasAPagarTotalBrasileiras($mescp,$anocp) {
        try {
            $sql = "SELECT fornecedor,format(sum(soma),2,'de_DE') as total,month,year
					FROM brasileirasponto
					WHERE month=? AND year=?
					GROUP BY month,year";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getContasAPagarTotalConjunto($mescp,$anocp) {
        try {
            $sql = "SELECT fornecedor,format(sum(soma),2,'de_DE') as total,month,year
					FROM conjuntoponto
					WHERE month=? AND year=?
					GROUP BY month,year";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getContasAPagarTotalFazenda($mescp,$anocp) {
        try {
            $sql = "SELECT fornecedor,format(sum(soma),2,'de_DE') as total,month,year
					FROM fazendaponto
					WHERE month=? AND year=?
					GROUP BY month,year";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function getContasAPagarTotalMln($mescp,$anocp) {
        try {
            $sql = "SELECT fornecedor,format(sum(soma),2,'de_DE') as total,month,year
					FROM mlnponto
					WHERE month=? AND year=?
					GROUP BY month,year";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $mescp);
            $stmt->bindValue(2, $anocp);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
//---------------------------------------------------------------------------------
	
    public function getContasAPagarTotalGeral() {
        try {
            $sql = "SELECT format(sum(soma),2,'de_DE') as totalgeral
					FROM contaspg";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
    public function getContasAPagarTotalGeralAlm() {
        try {
            $sql = "SELECT format(sum(soma),2,'de_DE') as totalgeral
					FROM almponto";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }		
	
    public function getContasAPagarTotalGeralAlmirio() {
        try {
            $sql = "SELECT format(sum(soma),2,'de_DE') as totalgeral
					FROM almirioponto";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }		
    public function getContasAPagarTotalGeralBrasil03antigo() {
        try {
            $sql = "SELECT format(sum(soma),2,'de_DE') as totalgeral
					FROM brasil03antigoponto";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getContasAPagarTotalGeralBrasileiras() {
        try {
            $sql = "SELECT format(sum(soma),2,'de_DE') as totalgeral
					FROM brasileirasponto";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function getContasAPagarTotalGeralConjunto() {
        try {
            $sql = "SELECT format(sum(soma),2,'de_DE') as totalgeral
					FROM conjuntoponto";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getContasAPagarTotalGeralFazenda() {
        try {
            $sql = "SELECT format(sum(soma),2,'de_DE') as totalgeral
					FROM fazendaponto";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getContasAPagarTotalGeralMln() {
        try {
            $sql = "SELECT format(sum(soma),2,'de_DE') as totalgeral
					FROM mlnponto";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
//------------------------------------------------------------------------------------------	
	

//a partir daqui começam os relatorios personalizados respectivamente

    public function getLojaPeriodo($loja,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.loja_id=? AND f.datavencimento BETWEEN ? and ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $loja);
            $stmt->bindValue(2, $datainicio);
            $stmt->bindValue(3, $datafim);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getLojaPeriodoSituacao($loja,$situacao,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.loja_id=? AND f.situacao_id=? AND f.datavencimento BETWEEN ? and ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $loja);
            $stmt->bindValue(2, $situacao);				
            $stmt->bindValue(3, $datainicio);
            $stmt->bindValue(4, $datafim);	
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getLojaPeriodoSituacaoFornecedor($loja,$situacao,$fornecedor,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.loja_id=? AND f.situacao_id=? AND f.fornecedor_id=? AND f.datavencimento BETWEEN ? and ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $loja);
            $stmt->bindValue(2, $situacao);	
            $stmt->bindValue(3, $fornecedor);				
            $stmt->bindValue(4, $datainicio);
            $stmt->bindValue(5, $datafim);	
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getPeriodo($datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.datavencimento BETWEEN ? and ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $datainicio);
            $stmt->bindValue(2, $datafim);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
	
	
    public function getPeriodoSituacao($situacao,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.situacao_id=? AND f.datavencimento BETWEEN ? and ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $situacao);			
            $stmt->bindValue(2, $datainicio);
            $stmt->bindValue(3, $datafim);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getPeriodoSituacaoFornecedor($situacao,$fornecedor,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.situacao_id=? AND f.fornecedor_id=? AND f.datavencimento BETWEEN ? and ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $situacao);	
            $stmt->bindValue(2, $fornecedor);				
            $stmt->bindValue(3, $datainicio);
            $stmt->bindValue(4, $datafim);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }


    public function getPeriodoFornecedor($fornecedor,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.fornecedor_id=? AND f.datavencimento BETWEEN ? and ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $fornecedor);				
            $stmt->bindValue(2, $datainicio);
            $stmt->bindValue(3, $datafim);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	


    public function getSituacaoPeriodo($situacao,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.situacao_id=? AND f.datavencimento BETWEEN ? and ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $situacao);				
            $stmt->bindValue(2, $datainicio);
            $stmt->bindValue(3, $datafim);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function getAllLoja($loja) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.loja_id=? 
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $loja);						
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getAllFornecedor($fornecedor) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.fornecedor_id=? 
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $fornecedor);						
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getAllSituacao($situacao) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.situacao_id=? 
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $situacao);						
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getAllTipo($tipo) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? 
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);						
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function getAllTipoLoja($tipo,$loja) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.loja_id=?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $loja);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getAllTipoLojaFornecedor($tipo,$loja,$fornecedor,$situacao) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.loja_id=? AND f.fornecedor_id=? AND f.situacao_id=?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $loja);	
            $stmt->bindValue(3, $fornecedor);	
            $stmt->bindValue(4, $situacao);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
	
    public function getAllTipoLojaFornecedorSituacao($tipo,$loja,$fornecedor,$situacao) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.loja_id=? AND f.fornecedor_id=? AND f.situacao_id=?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $loja);	
            $stmt->bindValue(3, $fornecedor);	
            $stmt->bindValue(4, $situacao);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
    public function getAllTipoLojaFornecedorSituacaoPeriodo($tipo,$loja,$fornecedor,$situacao,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.loja_id=? AND f.fornecedor_id=? AND f.situacao_id=? AND f.datavencimento BETWEEN ? and ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $loja);	
            $stmt->bindValue(3, $fornecedor);	
            $stmt->bindValue(4, $situacao);	
            $stmt->bindValue(5, $datainicio);	
            $stmt->bindValue(6, $datafim);				
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getAllTipoFornecedor($tipo,$fornecedor) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.fornecedor_id=?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $fornecedor);	
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getAllTipoFornecedorSituacao($tipo,$fornecedor,$situacao) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.fornecedor_id=? AND f.situacao_id=?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $fornecedor);
            $stmt->bindValue(3, $situacao);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getAllTipoFornecedorSituacaoPeriodo($tipo,$fornecedor,$situacao,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.fornecedor_id=? AND f.situacao_id=? AND f.datavencimento BETWEEN ? AND ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $fornecedor);
            $stmt->bindValue(3, $situacao);		
            $stmt->bindValue(4, $datainicio);	
            $stmt->bindValue(5, $datafim);				
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getAllTipoSituacao($tipo,$situacao) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.situacao_id=?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $situacao);		
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getAllTipoSituacaoLoja($tipo,$situacao,$loja) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.situacao_id=? AND f.loja_id=?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $situacao);
            $stmt->bindValue(3, $loja);			
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
    public function getAllTipoSituacaoLojaPeriodo($tipo,$situacao,$loja,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.situacao_id=? AND f.loja_id=? AND f.datavencimento BETWEEN ? AND ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $situacao);
            $stmt->bindValue(3, $loja);	
            $stmt->bindValue(4, $datainicio);	
            $stmt->bindValue(5, $datafim);				
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function getAllTipoPeriodo($tipo,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.datavencimento BETWEEN ? AND ?
					GROUP BY duplicata,f.loja_id
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $datainicio);	
            $stmt->bindValue(3, $datafim);				
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
    public function getAllTipoPeriodoSituacao($tipo,$situacao,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.situacao_id=? AND f.datavencimento BETWEEN ? AND ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $situacao);			
            $stmt->bindValue(3, $datainicio);	
            $stmt->bindValue(4, $datafim);				
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getAllTipoPeriodoFornecedor($tipo,$fornecedor,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.fornecedor_id=? AND f.datavencimento BETWEEN ? AND ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $fornecedor);			
            $stmt->bindValue(3, $datainicio);	
            $stmt->bindValue(4, $datafim);				
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
    public function getAllTipoPeriodoLoja($tipo,$loja,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.loja_id=? AND f.datavencimento BETWEEN ? AND ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $loja);			
            $stmt->bindValue(3, $datainicio);	
            $stmt->bindValue(4, $datafim);				
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function getAllTipoPeriodoLojaFornecedor($tipo,$loja,$fornecedor,$datainicio,$datafim) {
        try {
            $sql = "SELECT f.id as id,f.notafiscal AS notafiscal,f.duplicata AS dd,CONCAT(f.duplicata, '(',count(f.id),')') as duplicata,format(sum(f.valorpr),2,'de_DE') as soma,f.tipo,DATE_FORMAT(f.datacompra,'%d/%m/%Y') AS datacompra,DATE_FORMAT(f.datavencimento,'%d/%m/%Y') AS datavencimento,format(f.total,2,'de_DE') AS total,format(f.valorpr,2,'de_DE') AS valorpr ,f.numpr AS numpr,fd.razao AS fornecedor,st.stattus AS stattus,pz.descricao AS prazo,pz.qtdepr as qtdepr,lj.razao as loja
					FROM  fatura AS f, loja AS lj, fornecedor AS fd,prazo As pz, operador AS op,situacao as st 
					WHERE f.operador_id=op.id AND f.fornecedor_id=fd.id AND f.prazo_id=pz.id AND f.situacao_id = st.id AND f.loja_id=lj.id AND f.tipo=? AND f.loja_id=? AND f.fornecedor_id=? AND f.datavencimento BETWEEN ? AND ?
					GROUP BY duplicata
					ORDER BY f.datavencimento,f.duplicata ASC";
            $stmt = $this->pdo->prepare($sql);	
            $stmt->bindValue(1, $tipo);
            $stmt->bindValue(2, $loja);	
            $stmt->bindValue(3, $fornecedor);				
            $stmt->bindValue(4, $datainicio);	
            $stmt->bindValue(5, $datafim);				
            $stmt->execute();
            $fatura = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fatura;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
	
	

}




?>

