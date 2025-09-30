<?php
require_once 'config/database.php';

class funcionario {
    private $conn;
    private $table = "funcionarios";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Inserir um funcionario
    public function insert($nome, $nascimento, $cep, $uf, $cidade, $bairro, $logradouro, $numero, $complemento, $cpf, $email, $telefone, $cargo) {
        $query = "INSERT INTO $this->table (nome, nascimento, cep, uf, cidade, bairro, logradouro, numero, complemento, cpf, email, telefone, cargo) VALUES (:nome, :nascimento, :cep, :uf, :cidade, :bairro, :logradouro, :numero, :complemento, :cpf, :email, :telefone, :cargo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindValue(':nascimento', $nascimento, $nascimento === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':cep', $cep, $cep === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':uf', $uf, $uf === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $cidade, $cidade === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':bairro', $bairro, $bairro === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':logradouro', $logradouro, $logradouro === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':numero', $numero, $numero === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':complemento', $complemento, $complemento === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindValue(':email', $email, $email === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':telefone', $telefone, $telefone === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(":cargo", $cargo);
        return $stmt->execute();
    }
    
    // Atualizar um funcionario
    public function update($id, $nome, $nascimento, $cep, $uf, $cidade, $bairro, $logradouro, $numero, $complemento, $cpf, $email, $telefone, $cargo) {
        $query = "UPDATE $this->table SET nome = :nome, nascimento = :nascimento, cep = :cep, uf = :uf, cidade = :cidade, bairro = :bairro, logradouro = :logradouro, numero = :numero, complemento = :complemento, cpf = :cpf, email = :email, telefone = :telefone, cargo = :cargo WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind dos valores
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindValue(':nascimento', $nascimento, $nascimento === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':cep', $cep, $cep === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':uf', $uf, $uf === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $cidade, $cidade === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':bairro', $bairro, $bairro === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':logradouro', $logradouro, $logradouro === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':numero', $numero, $numero === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':complemento', $complemento, $complemento === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindValue(':email', $email, $email === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':telefone', $telefone, $telefone === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(":cargo", $cargo);

        return $stmt->execute();
    }

    // Deletar um funcionario
    public function delete($id){
        $query = "delete from $this->table where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Buscar todos os funcionarios
    public function getAll() {
        $query = "SELECT id, nome, cpf FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar um funcionarios pelo ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar um funcionario pelo Cargo
    public function getByCargo($cargo) {
        $query = "SELECT id FROM " . $this->table . " WHERE cargo = :cargo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cargo", $cargo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar um funcionarios pelo Nome
    public function getByParams($nome, $cpf) {
        $query = "SELECT id, nome, cpf FROM " . $this->table . " WHERE nome like :nome and cpf like :cpf";
        $nome="%$nome%";
        $cpf="%$cpf%";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Buscar um relatório
    public function getRelatorio($nome, $cargo) {
        if($cargo==="" or isset($cargo)){
            $query = "SELECT f.nome, f.telefone, c.nome as cargo, c.salario FROM " . $this->table . " f inner join cargos c on f.cargo=c.id WHERE f.nome like :nome";
            $nome="%$nome%";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nome", $nome);
            
        }
        else{
            $query = "SELECT f.nome, f.telefone, c.nome as cargo, c.salario FROM " . $this->table . " f inner join cargos c on f.cargo=c.id WHERE f.nome like :nome and c.id = :cargo";
            $nome="%$nome%";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":cargo", $cargo);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
