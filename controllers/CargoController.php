<?php
require_once 'models/Cargo.php';
require_once 'models/Funcionario.php';
require_once 'config/utils.php';

class CargoController {

    // /cargo/create
    public function create() {
        $csrfToken = Csrf::generateToken();
        require 'views/cargo_form.php';
    }

    // /cargo/store
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            
            if (!Csrf::validateToken($token)) {
                addMensagem("error", "CSRF Token inválido!");
            }
            else{

                $nome = $_POST['nome'];
                $salario = floatPost($_POST['salario']);
    
                $cargoModel = new Cargo();
                
                try {
                    $cargoModel->insert($nome, $salario);
                    addMensagem('success', 'Cargo inserido com sucesso!');
                } catch (Exception $e) {
                    addMensagem('error', 'Erro ao inserir cargo: ' . $e->getMessage());
                }
                
            }

            header("Location: /assim_saude/cargo/list");
            exit;
        }
    }

    // /cargo/list
    public function list() {
        $csrfToken = Csrf::generateToken();
        $cargoModel = new Cargo();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            
            if (!Csrf::validateToken($token)) {
                addMensagem("error", "CSRF Token inválido!");
                $cargos = $cargoModel->getAll();
            }
            else{
                $nome = $_POST['nome'];
                $cargos = $cargoModel->getByName($nome);
            }
            require 'views/cargo_list.php';
        }
        else{
            $cargos = $cargoModel->getAll();
            require 'views/cargo_list.php';
        }
    }

    // /cargo/show/{id}
    public function show($id) {
        $csrfToken = Csrf::generateToken();
        $cargoModel = new Cargo();
        $cargo = $cargoModel->getById($id);
        require 'views/cargo_detail.php';
    }

    // /cargo/update/{id}
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            
            if (!Csrf::validateToken($token)) {
                addMensagem("error", "CSRF Token inválido!");
            }
            else{
                $nome = $_POST['nome'];
                $salario = floatPost($_POST['salario']);
    
                $cargoModel = new Cargo();
                try {
                    $cargoModel->update($nome, $salario, $id);
                    addMensagem('success', 'Cargo atualizado com sucesso!');
                } catch (Exception $e) {
                    addMensagem('error', 'Erro ao atualizar cargo: ' . $e->getMessage());
                }

            }
            // Se passou na validação, processa

            header("Location: /assim_saude/cargo/list");
            exit;
        }
    }

    // /cargo/delete/{id}
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            
            if (!Csrf::validateToken($token)) {
                addMensagem("error", "CSRF Token inválido!");
            }
            else{
                $cargoModel = new Cargo();
                $funcionarioModel = new funcionario();
                $funcionario = $funcionarioModel->getByCargo($id);
                if($funcionario){
                    addMensagem("error", "Erro ao deletar cargo: Existe um funcionário ativo associado a esse cargo");
                }
                else{
                    try {
                        $cargoModel->delete($id);
                        addMensagem('success', 'Cargo deletado com sucesso!');
                    } catch (Exception $e) {
                        addMensagem('error', 'Erro ao deletar cargo: ' . $e->getMessage());
                    }
                }
            }

            header("Location: /assim_saude/cargo/list");
            exit;
        }
    }
}
