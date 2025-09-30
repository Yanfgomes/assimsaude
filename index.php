<?php
require_once "config/csrf.php"; 
// Front Controller com rotas amigáveis
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Quebra a rota em partes
$parts = explode('/', trim($route, '/'));

// Primeiro segmento = controller
$controllerName = ucfirst($parts[0]) . 'Controller';
$action = isset($parts[1]) ? $parts[1] : 'home';
$param = isset($parts[2]) ? $parts[2] : null;

// Carregar controller
require_once "controllers/$controllerName.php";
$controller = new $controllerName();

// Chamar método com ou sem parâmetro
if ($param) {
    $controller->$action($param);
} else {
    $controller->$action();
}
