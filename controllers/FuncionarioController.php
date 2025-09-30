<?php
require_once 'models/Funcionario.php';
require_once 'models/Cargo.php';
require_once 'config/utils.php';

class FuncionarioController {

    // /funcionario/create
    public function create() {
        $csrfToken = Csrf::generateToken();
        $cargoModel = new Cargo();
        $cargos = $cargoModel->getAll();
        require 'views/funcionario_form.php';
    }

    // /funcionario/store
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            
            if (!Csrf::validateToken($token)) {
                addMensagem("error", "CSRF Token inválido!");
            }
            else{
                $nome = $_POST['nome'];
                $nascimento = nullIfEmpty($_POST['nascimento']);
                $cep = nullIfEmpty($_POST['cep']);
                $uf = nullIfEmpty($_POST['uf']);
                $cidade = nullIfEmpty($_POST['cidade']);
                $bairro = nullIfEmpty($_POST['bairro']);
                $logradouro = nullIfEmpty($_POST['logradouro']);
                $numero = nullIfEmpty($_POST['numero']);
                $complemento = nullIfEmpty($_POST['complemento']);
                $cpf = limparPontuacao($_POST['cpf']);
                $email = nullIfEmpty($_POST['email']);
                $telefone = nullIfEmpty(limparPontuacao($_POST['telefone']));
                $cargo = $_POST['cargo'];
                if(validaCPF($cpf)){
                    $funcionarioModel = new Funcionario();
                    try {
                        $funcionarioModel->insert($nome, $nascimento, $cep, $uf, $cidade, $bairro, $logradouro, $numero, $complemento, $cpf, $email, $telefone, $cargo);
                        addMensagem('success', 'Funcionário inserido com sucesso!');
                    } catch (Exception $e) {
                        addMensagem('error', 'Erro ao inserir funcionário: ' . $e->getMessage());
                    }
                }
                else{
                    addMensagem('error', 'CPF inválido');
                }
            }

            header("Location: /assim_saude/funcionario/list");
            exit;
        }
    }

    // /funcionario/list
    public function list() {
        $csrfToken = Csrf::generateToken();
        $funcionarioModel = new Funcionario();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            
            if (!Csrf::validateToken($token)) {
                addMensagem("error", "CSRF Token inválido!");
                $funcionarios = $funcionarioModel->getAll();
            }
            else{
                $nome = $_POST['nome'];
                $cpf = limparPontuacao($_POST['cpf']);
    
                $funcionarios = $funcionarioModel->getByParams($nome, $cpf);
            }
            require 'views/funcionario_list.php';
        }
        else{
            $funcionarios = $funcionarioModel->getAll();
            require 'views/funcionario_list.php';
        }
    }

    // /funcionario/show/{id}
    public function show($id) {
        $csrfToken = Csrf::generateToken();
        $funcionarioModel = new Funcionario();
        $funcionario = $funcionarioModel->getById($id);
        $cargoModel = new Cargo();
        $cargos = $cargoModel->getAll();
        require 'views/funcionario_detail.php';
    }

    // /funcionario/update/{id}
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            
            $nome = $_POST['nome'];
            $nascimento = nullIfEmpty($_POST['nascimento']);
            $cep = nullIfEmpty($_POST['cep']);
            $uf = nullIfEmpty($_POST['uf']);
            $cidade = nullIfEmpty($_POST['cidade']);
            $bairro = nullIfEmpty($_POST['bairro']);
            $logradouro = nullIfEmpty($_POST['logradouro']);
            $numero = nullIfEmpty($_POST['numero']);
            $complemento = nullIfEmpty($_POST['complemento']);
            $cpf = limparPontuacao($_POST['cpf']);
            $email = nullIfEmpty($_POST['email']);
            $telefone = nullIfEmpty(limparPontuacao($_POST['telefone']));
            $cargo = $_POST['cargo'];
            if(validaCPF($cpf)){
                $funcionarioModel = new Funcionario();
                try {
                    $funcionarioModel->update($id, $nome, $nascimento, $cep, $uf, $cidade, $bairro, $logradouro, $numero, $complemento, $cpf, $email, $telefone, $cargo);
                    addMensagem('success', 'Funcionário alterado com sucesso!');
                } catch (Exception $e) {
                    addMensagem('error', 'Erro ao alterar funcionário: ' . $e->getMessage());
                }
            }
            else{
                addMensagem('error', 'CPF inválido');
            }

            header("Location: /assim_saude/funcionario/list");
            exit;
        }
    }

    // /funcionario/delete/{id}
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            
            if (!Csrf::validateToken($token)) {
                die("CSRF Token inválido!");
            }

            // Se passou na validação, processa

            $funcionarioModel = new Funcionario();
            try{
                $funcionarioModel->delete($id);
                addMensagem('success', 'Funcionário deletado com sucesso!');
            } catch (Exception $e) {
                addMensagem('error', 'Erro ao deletar funcionário: ' . $e->getMessage());
            }

            header("Location: /assim_saude/funcionario/list");
            exit;
        }
    }

    // /funcionario/relatorio
    public function relatorio() {
        $csrfToken = Csrf::generateToken();
        $funcionarioModel = new Funcionario();
        $cargoModel = new Cargo();
        $cargos = $cargoModel->getAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            
            if (!Csrf::validateToken($token)) {
                addMensagem("error", "CSRF Token inválido!");
                $funcionarios = "";
            }
            else{
                $nome = $_POST['nome'];
                $cargo = $_POST['cargo'];
    
                $funcionarios = $funcionarioModel->getRelatorio($nome, $cargo);
            }
            require 'views/funcionario_relatorio.php';
        }
        else{
            $funcionarios = "";
            require 'views/funcionario_relatorio.php';
        }
    }

}
