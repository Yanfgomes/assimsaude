<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Assim Saúde</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 0;
            background: #f9f9f9;
            align-items: flex-start;
        }

        /* Container do menu */
        .navbar {
            display: flex;
            justify-content: center;
            background: #fff;
            padding: 12px 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
            align-items: center;
        }

        /* Links do menu */
        .navbar a, .dropdown button {
            font-size: 15px;
            color: #333;
            padding: 10px 10px;
            text-decoration: none;
            border: none;
            background: none;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .navbar a:hover, .dropdown:hover button {
            color: #0077cc;
        }

        /* Dropdown */
        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #fff;
            min-width: 150px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 6px;
            overflow: hidden;
        }

        .dropdown-content a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .dropdown-content a:hover {
            background: #f2f2f2;
        }

        /* Mostrar dropdown ao passar o mouse */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        .container-flex {
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 500px;
        }

        .container2 {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 700px;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.6rem;
            color: #333;
        }

        .form-principal .form-group {
            margin-bottom: 20px;
        }

        .form-principal label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #444;
            font-size: 0.95rem;
        }

        .form-principal input[type="text"],
        .form-principal input[type="number"],
        .form-principal input[type="date"],
        .form-principal input[type="email"],
        .form-principal input[type="file"],
        .form-principal select,
        .form-principal select option,
        .form-principal textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d0d7de;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: border 0.2s, box-shadow 0.2s;
            background: #fafafa;
        }

        .form-principal input:focus,
        .form-principal textarea:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74,144,226,0.2);
            background: #fff;
        }
        
        table.minimal {
            border-collapse: collapse;
            width: 80%;
            max-width: 700px;
            text-align: center;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        table.minimal th, table.minimal td {
            padding: 12px 15px;
        }

        table.minimal th {
            background-color: #f5f5f5;
            color: #333;
            font-weight: bold;
        }

        table.minimal tr:nth-child(even) {
            background-color: #fafafa;
        }

        table.minimal tr:hover {
            background-color: #f0f0f0;
        }

        .invisible-button {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
            font: inherit;
            color: inherit;
            cursor: pointer;
            outline: none;
        }

        button {
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        button:active {
            transform: scale(0.98); /* leve efeito de clique */
        }

        button:focus {
            outline: none; /* remove contorno padrão ao focar */
        }
        

        /* Área do filtro com leve bloco interno */
        .filter-wrap {
        background: #f7fafc; /* leve tom */
        border-radius: 8px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        border: 1px solid rgba(15,25,35,0.03);
        }

        /* Label alinhado e discreto */
        .filter-wrap label {
        min-width: 56px;
        font-size: 14px;
        color: #4b5563;
        display: inline-block;
        }

        /* Formulário que contém input + botão */
        form.search {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 12px;
        }

        /* Input principal (bordas arredondadas e sombra sutil) */
        .search input[type="text"],
        .search select
        {
        flex: 1;
        height: 40px;
        padding: 0 14px;
        border-radius: 8px;
        border: 1px solid rgba(15,25,35,0.08);
        background: #fff;
        font-size: 14px;
        outline: none;
        transition: box-shadow .12s, border-color .12s;
        box-shadow: inset 0 -1px 0 rgba(15,25,35,0.02);
        }
        .search input[type="text"]:focus {
        border-color: rgba(59,130,246,0.9);
        box-shadow: 0 2px 8px rgba(59,130,246,0.08);
        }

        .messages {
            margin-bottom: 20px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }

        .alert.success {
            background: #e6ffed;
            color: #256029;
            border: 1px solid #a3f3b8;
        }

        .alert.error {
            background: #ffe6e6;
            color: #8b1d1d;
            border: 1px solid #f5a3a3;
        }
        
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
</head>
<body>
    <div class="navbar">
        <a href="/assim_saude/home">Início</a>
        <div class="dropdown">
            <button>Cadastro</button>
            <div class="dropdown-content">
                <a href="/assim_saude/cargo/list">Cargo</a>
                <a href="/assim_saude/funcionario/list">Funcionário</a>
            </div>
        </div>
        <a href="/assim_saude/funcionario/relatorio">Relatorio</a>
    </div>
    <br><br>
    <?php
    $mensagens = $_SESSION['mensagens'] ?? [];
    unset($_SESSION['mensagens']); 
    ?>
    <?php if($mensagens): ?>
        <div class="messages">
            <?php foreach($mensagens as $mensagem):?>
                <div class="alert <?=$mensagem['tipo']?>"><?=$mensagem["mensagem"]?></div>
            <?php endforeach ?>
        </div>

    <?php endif ?>
