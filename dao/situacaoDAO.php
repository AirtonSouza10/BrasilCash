<?php

require_once 'conexao.php'; 


class SituacaoDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

    public function getAllSituacoes() {
        try {
            $sql = "SELECT id, stattus 
            FROM situacao ORDER BY id ASC LIMIT 50";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $situacao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $situacao;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getSituacaoPago() {
        try {
            $sql = "SELECT id, stattus 
            FROM situacao
			WHERE id=2";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $situacao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $situacao;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function getSituacaoSemPago() {
        try {
            $sql = "SELECT id, stattus 
            FROM situacao
			WHERE id<>2";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $situacao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $situacao;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

    public function salvarSituacao(SituacaoDTO $situacaoDTO) {
        try {
            $sql = "INSERT INTO situacao (stattus) 
                    VALUES (?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $situacaoDTO->getStattus());
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirSituacao($idsituacao) {
        try {
            $sql = "DELETE FROM situacao 
                   WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idsituacao);
            $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getSituacaoById($idsituacao) {
        try {
            $sql = "SELECT id, stattus FROM situacao WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idsituacao);
            $stmt->execute();
            $situacao = $stmt->fetch(PDO::FETCH_ASSOC);
            return $situacao;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function updateSituacaoById(SituacaoDTO $situacaoDTO) {
        try {
            $sql = "UPDATE situacao SET stattus=?
                    WHERE id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $situacaoDTO->getStattus());
            $stmt->bindValue(2, $situacaoDTO->getId());        
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}

?>

