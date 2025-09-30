
    <?php require_once 'layout/menu.php'; ?>   
    <?php if ($cargo): ?>
        <div class="container-flex">
            <div class="container">
                <h1>Cargo - <?=$cargo['id']?></h1>
        
                <form method="post" action="/assim_saude/cargo/update/<?=$cargo['id']?>" class="form-principal" >
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                    <div class="form-group">
                        <label for="formNome">Nome</label>
                        <input type="text" id="formNome" name="nome" maxlength="200" required value="<?= $cargo['nome'] ?>">
                    </div>
        
                    <div class="form-group">
                        <label for="formSalario">Salário</label>
                        <input type="text" id="formSalario" name="salario" required value="<?= number_format($cargo['salario'],2,',','.') ?>">
                    </div>
                    <button type="submit" class="btn">Salvar</button>
                </form>
            </div>
        </div>
        <script>
            $('#formSalario').mask('000.000,00', {reverse: true});
        </script>
    <?php else: ?>
        <div class="container-flex">
            <div class="container">
                <h1>Cargo não encontrado!</h1>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
