<?php

require_once 'conexao.php'; 


class LojaDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

    public function getAllLojas() {
        try {
            $sql = "SELECT id, razao, cnpj 
            FROM loja ORDER BY id ASC LIMIT 20";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $loja = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $loja;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function salvarLoja(lojaDTO $lojaDTO) {
        try {
            $sql = "INSERT INTO loja (razao, cnpj) 
                    VALUES (?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $lojaDTO->getRazao());
            $stmt->bindValue(2, $lojaDTO->getCnpj());
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirLoja($idloja) {
        try {
            $sql = "DELETE FROM loja 
                   WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idloja);
            $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getLojaById($idloja) {
        try {
            $sql = "SELECT id, razao, cnpj FROM loja WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idloja);
            $stmt->execute();
            $loja = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loja;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function updateLojaById(LojaDTO $lojaDTO) {
        try {
            $sql = "UPDATE loja SET razao=?,
                                       cnpj=?
                    WHERE id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $lojaDTO->getRazao());
            $stmt->bindValue(2, $lojaDTO->getCnpj());
            $stmt->bindValue(3, $lojaDTO->getId());        
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getLojaPesq($pesq) {
        try {
            $sql = "SELECT id, razao, cnpj FROM loja WHERE razao LIKE '%$pesq%' OR cnpj LIKE '%$pesq%' ORDER BY razao asc LIMIT 20 ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $loja = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $loja;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

}

?>

