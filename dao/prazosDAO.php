<?php

require_once 'conexao.php'; 


class PrazosDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

    public function getAllPrazos() {
        try {
            $sql = "SELECT id, descricao,diasdif,qtdepr 
            FROM prazo ORDER BY id ASC LIMIT 50";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $prazos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $prazos;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function salvarPrazo(PrazosDTO $prazosDTO) {
        try {
            $sql = "INSERT INTO prazo (descricao,diasdif,qtdepr) 
                    VALUES (?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $prazosDTO->getDescricao());
            $stmt->bindValue(2, $prazosDTO->getDiasdif());
			$stmt->bindValue(3, $prazosDTO->getQtdepr());
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirPrazo($idprazo) {
        try {
            $sql = "DELETE FROM prazo 
                   WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idprazo);
            $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getPrazoById($idprazo) {
        try {
            $sql = "SELECT id,descricao, diasdif,qtdepr FROM prazo WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idprazo);
            $stmt->execute();
            $prazos = $stmt->fetch(PDO::FETCH_ASSOC);
            return $prazos;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function updatePrazoById(PrazosDTO $prazosDTO) {
        try {
            $sql = "UPDATE prazo SET descricao=?,
                                     diasdif=?,
									 qtdepr=?
                    WHERE id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $prazosDTO->getDescricao());
            $stmt->bindValue(2, $prazosDTO->getDiasdif());
            $stmt->bindValue(3, $prazosDTO->getQtdepr());			
            $stmt->bindValue(4, $prazosDTO->getId());        
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}

?>

