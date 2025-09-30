    <?php require_once 'layout/menu.php'; ?> 
    <div class="container-flex">
        <form action="/assim_saude/cargo/create" method="get">
            <button type="submit" class="button">Cadastrar Novo Cargo</button>
        </form>
    </div>
    <div class="container-flex">
        <section class="container">
        <h1>Pesquisa de cargos</h1>
    
        <div class="filter-wrap" role="region" aria-label="Filtro de pesquisa">
            <label for="nome">Nome:</label>
    
            <form class="search" action="/assim_saude/cargo/list" method="post">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                <input id="nome" name="nome" type="text" maxlength="200"/>
                <button type="submit">Buscar</button>
            </form>
        </div>
        </section>
    </div>
    <?php if ($cargos): ?>
        <div class="container-flex">
            <div class="container">
                <h1>Cargos</h1>
        
                <div class="form-principal" >
                    <div class="form-group">
                        <table class="minimal" align="center">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Salário</th>
                                    <th>Editar</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cargos as $cargo): ?>
                                    <tr>
                                        <td><?=$cargo["nome"]?></td>
                                        <td>R$ <?=number_format($cargo["salario"],2,",",".")?></td>
                                        <td>
                                            <form action="/assim_saude/cargo/show/<?=$cargo["id"]?>" method="post">
                                                <button class="invisible-button" type="submit">✏️</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="/assim_saude/cargo/delete/<?=$cargo["id"]?>" method="post">
                                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                                                <button class="invisible-button" type="submit">🗑️</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container-flex">
            <div class="container">
                <h1>Nenhum cargo encontrado!</h1>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
