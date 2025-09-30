    <?php require_once 'layout/menu.php'; ?> 
    <div class="container-flex">
        <form action="/assim_saude/funcionario/create" method="get">
            <button type="submit" class="button">Cadastrar Novo Funcionario</button>
        </form>
    </div>
    <div class="container-flex">
        <section class="container2">
        <h1>Pesquisa de funcionarios</h1>
    
        <div class="filter-wrap" role="region" aria-label="Filtro de pesquisa">
            
            <form class="search" action="/assim_saude/funcionario/relatorio" method="post">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                <label for="nome">Nome:</label>
                <input id="nome" name="nome" type="text" maxlength="200"/>
                <label for="cargo">Cargos:</label>
                <select name="cargo" id="cargo">
                    <option value="">Selecione um cargo</option>
                    <?php if($cargos): ?>
                        <?php foreach($cargos as $cargo): ?>
                            <option value='<?=$cargo["id"]?>'><?=$cargo["nome"]?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <button type="submit">Buscar</button>
            </form>
        </div>
        </section>
    </div>
    <?php if ($funcionarios): ?>
        <div class="container-flex">
            <div class="container2">
                <h1>Funcionários</h1>
        
                <div class="form-principal" >
                    <div class="form-group">
                        <table class="minimal" align="center">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Cargo</th>
                                    <th>Salário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($funcionarios as $funcionario): ?>
                                    <tr>
                                        <td><?=$funcionario["nome"]?></td>
                                        <td><?=formatTelefone($funcionario["telefone"])?></td>
                                        <td><?=$funcionario["cargo"]?></td>
                                        <td>R$ <?=number_format($funcionario["salario"],2,",",".")?></td>
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
            <div class="container2">
                <h1>Nenhum funcionário encontrado!</h1>
            </div>
        </div>
    <?php endif; ?>
    <script>
         $('#cpf').mask('000.000.000-00');
    </script>
</body>
</html>
