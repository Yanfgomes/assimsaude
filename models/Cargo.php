<?php
require_once 'config/database.php';

class Cargo {
    private $conn;
    private $table = "cargos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Inserir um cargo
    public function insert($nome, $salario) {
        $query = "INSERT INTO $this->table (nome, salario) VALUES (:nome, :salario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":salario", $salario);
        return $stmt->execute();
    }

    // Atualizar um cargo
    public function update($nome, $salario, $id) {
        $query = "update $this->table set nome = :nome, salario = :salario where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":salario", $salario);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Deletar um cargo
    public function delete($id){
        $query = "delete from $this->table where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Buscar todos os cargos
    public function getAll() {
        $query = "SELECT id, nome, salario FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar um cargos pelo ID
    public function getById($id) {
        $query = "SELECT id, nome, salario FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar um cargos pelo Nome
    public function getByName($nome) {
        $query = "SELECT id, nome, salario FROM " . $this->table . " WHERE nome like :nome";
        $nome="%$nome%";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
