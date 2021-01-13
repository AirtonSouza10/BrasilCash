<?php

require_once 'conexao.php'; 


class FornecedorDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

    public function getAllFornecedores() {
        try {
            $sql = "SELECT id, razao,telefone, cnpj 
            FROM fornecedor ORDER BY razao ASC LIMIT 200";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fornecedor = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fornecedor;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function salvarFornecedor(fornecedorDTO $fornecedorDTO) {
        try {
            $sql = "INSERT INTO fornecedor (razao,telefone,cnpj) 
                    VALUES (?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $fornecedorDTO->getRazao());
            $stmt->bindValue(2, $fornecedorDTO->getTelefone());			
            $stmt->bindValue(3, $fornecedorDTO->getCnpj());
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirFornecedor($idfornecedor) {
        try {
            $sql = "DELETE FROM fornecedor 
                   WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idfornecedor);
            $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getFornecedorById($idfornecedor) {
        try {
            $sql = "SELECT id, razao,telefone, cnpj FROM fornecedor WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idfornecedor);
            $stmt->execute();
            $fornecedor = $stmt->fetch(PDO::FETCH_ASSOC);
            return $fornecedor;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function updateFornecedorById(FornecedorDTO $fornecedorDTO) {
        try {
            $sql = "UPDATE fornecedor SET razao=?,
									   telefone=?,
                                       cnpj=?
                    WHERE id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $fornecedorDTO->getRazao());
            $stmt->bindValue(2, $fornecedorDTO->getTelefone());			
            $stmt->bindValue(3, $fornecedorDTO->getCnpj());
            $stmt->bindValue(4, $fornecedorDTO->getId());        
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function getFornecedorPesq($pesq) {
        try {
            $sql = "SELECT id, razao, cnpj FROM fornecedor WHERE razao LIKE '%$pesq%' OR cnpj LIKE '%$pesq%' ORDER BY razao asc LIMIT 20 ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $fornecedor = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fornecedor;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	

}

?>

