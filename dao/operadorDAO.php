<?php

require_once 'conexao.php'; 


class OperadorDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

    public function getAllOperadores() {
        try {
            $sql = "SELECT id, nome, cpf 
            FROM operador ORDER BY id ASC LIMIT 20";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $operador = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $operador;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function salvarOperador(OperadorDTO $operadorDTO) {
        try {
            $sql = "INSERT INTO operador (nome, cpf, senha) 
                    VALUES (?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $operadorDTO->getNome());
            $stmt->bindValue(2, $operadorDTO->getCpf());
			$stmt->bindValue(3, $operadorDTO->getSenha());
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluirOperador($idoperador) {
        try {
            $sql = "DELETE FROM operador 
                   WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idoperador);
            $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getOperadorById($idoperador) {
        try {
            $sql = "SELECT id, nome, cpf FROM operador WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $idoperador);
            $stmt->execute();
            $operador = $stmt->fetch(PDO::FETCH_ASSOC);
            return $operador;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }




    public function getOperadorByCpf($cpf) {
        try {
            $sql = "SELECT id, nome, cpf FROM operador WHERE cpf = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $cpf);
            $stmt->execute();
            $operador = $stmt->fetch(PDO::FETCH_ASSOC);
            return $operador;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function updateOperadorById(OperadorDTO $operadorDTO) {
        try {
            $sql = "UPDATE operador SET nome=?,
                                       cpf=?
                    WHERE id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $operadorDTO->getNome());
            $stmt->bindValue(2, $operadorDTO->getCpf());
            $stmt->bindValue(3, $operadorDTO->getId());        
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
    public function updateOperadorByIdSenha(OperadorDTO $operadorDTO) {
        try {
            $sql = "UPDATE operador SET nome=?,
                                       senha=?
                    WHERE id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $operadorDTO->getNome());
            $stmt->bindValue(2, $operadorDTO->getSenha());
            $stmt->bindValue(3, $operadorDTO->getId());        
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }	
	
    public function updateResetById(OperadorDTO $operadorDTO) {
        try {
            $sql = "UPDATE operador SET senha=?
                    WHERE id= ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $operadorDTO->getSenha());
            $stmt->bindValue(2, $operadorDTO->getId());        
            $stmt->execute();
            
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	

}

?>

