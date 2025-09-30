    <?php
    require_once 'layout/menu.php';
    ?>
    <?php if ($funcionario): ?>
        <div class="container-flex">
            <div class="container">
                <h1>Funcionário - <?=$funcionario['id']?></h1>
        
                <form method="post" action="/assim_saude/funcionario/update/<?=$funcionario['id']?>" class="form-principal" >
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                    <div class="form-group">
                        <label for="formNome">Nome</label>
                        <input type="text" id="formNome" name="nome" maxlength="200" value="<?=$funcionario['nome']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="formCpf">CPF</label>
                        <input type="text" id="formCpf" name="cpf" maxlength="14" value="<?=$funcionario['cpf']?>" required>
                    </div>
        
                    <div class="form-group">
                        <label for="formNascimento">Nascimento</label>
                        <input type="date" id="formNascimento" name="nascimento" value="<?=$funcionario['nascimento']?>">
                    </div>

                    <div class="form-group">
                        <label for="formCep">CEP</label>
                        <input type="text" id="formCep" name="cep" maxlength="8" onblur="pesquisacep(this.value);" value="<?=$funcionario['cep']?>">
                    </div>

                    <div class="form-group">
                        <label for="formUf">UF</label>
                        <input type="text" id="formUf" name="uf" maxlength="2" value="<?=$funcionario['uf']?>">
                    </div>

                    <div class="form-group">
                        <label for="formCidade">Cidade</label>
                        <input type="text" id="formCidade" name="cidade" maxlength="150" value="<?=$funcionario['cidade']?>">
                    </div>

                    <div class="form-group">
                        <label for="formBairro">Bairro</label>
                        <input type="text" id="formBairro" name="bairro" maxlength="150" value="<?=$funcionario['bairro']?>">
                    </div>

                    <div class="form-group">
                        <label for="formLogradouro">Logradouro</label>
                        <input type="text" id="formLogradouro" name="logradouro" maxlength="200" value="<?=$funcionario['logradouro']?>">
                    </div>

                    <div class="form-group">
                        <label for="formNumero">Número</label>
                        <input type="text" id="formNumero" name="numero" maxlength="10" value="<?=$funcionario['numero']?>">
                    </div>

                    <div class="form-group">
                        <label for="formComplemento">Complemento</label>
                        <input type="text" id="formComplemento" name="complemento" maxlength="100" value="<?=$funcionario['complemento']?>">
                    </div>

                    <div class="form-group">
                        <label for="formEmail">Email</label>
                        <input type="email" id="formEmail" name="email" maxlength="150" value="<?=$funcionario['email']?>">
                    </div>

                    <div class="form-group">
                        <label for="formTelefone">Telefone</label>
                        <input type="text" id="formTelefone" name="telefone" maxlength="15" value="<?=$funcionario['telefone']?>">
                    </div>

                    <div class="form-group">
                        <label for="formCargo">Cargo</label>
                        <select name="cargo" id="formCargo" required>
                            <option value="">Selecione um cargo</option>
                            <?php if($cargos): ?>
                                <?php foreach($cargos as $cargo): ?>
                                    <option value='<?=$cargo["id"]?>' <?=$funcionario['cargo']==$cargo["id"]?"selected":"";?>><?=$cargo["nome"]?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn">Salvar</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="container-flex">
            <div class="container">
                <h1>Cargo não encontrado!</h1>
            </div>
        </div>
    <?php endif; ?>
    <script>
         $('#formCep').mask('00000000');
         $('#formTelefone').mask('(00) 00000-0000');
         $('#formCpf').mask('000.000.000-00');
         
    
        function limpa_formulário_cep() {
                //Limpa valores do formulário de cep.
                document.getElementById('formLogradouro').value=("");
                document.getElementById('formBairro').value=("");
                document.getElementById('formCidade').value=("");
                document.getElementById('formUf').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('formLogradouro').value=(conteudo.logradouro);
                document.getElementById('formBairro').value=(conteudo.bairro);
                document.getElementById('formCidade').value=(conteudo.localidade);
                document.getElementById('formUf').value=(conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }
            
        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('formLogradouro').value="...";
                    document.getElementById('formBairro').value="...";
                    document.getElementById('formCidade').value="...";
                    document.getElementById('formUf').value="...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };

    
    </script>
</body>
</html>

