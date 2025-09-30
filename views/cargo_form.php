    <?php
    require_once 'layout/menu.php';
    ?>
    <div class="container-flex">
        <div class="container">
            <h1>Cadastro de Cargo</h1>
    
            <form method="post" action="/assim_saude/cargo/store" class="form-principal" >
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                <div class="form-group">
                    <label for="formNome">Nome</label>
                    <input type="text" id="formNome" name="nome" maxlength="200" required>
                </div>
    
                <div class="form-group">
                    <label for="formSalario">Salário</label>
                    <input type="text" id="formSalario" name="salario" required>
                </div>
                
                <button type="submit" class="btn">Salvar</button>
            </form>
        </div>
    </div>
    <script>
         $('#formSalario').mask('000.000,00', {reverse: true});
    </script>
</body>
</html>

