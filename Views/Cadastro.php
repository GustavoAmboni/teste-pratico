<form class="card" method="POST" action="?view=cliente&action=<?= ($v_action) ?>">
    <div class="card-header">
        <?= $v_box_title ?>
    </div>
    <div class="card-body">
        <div class="mb-3 row">
            <div class="col-6">
                <label for="inputNome">Nome</label>
                <input type="text" class="form-control" name="inputNome" placeholder="Nome" value="<?= (isset($v_cliente)) ? $v_cliente->nome : "" ?>">
            </div>
            <div class="col-6">
                <label for="inputSobrenome">Sobrenome</label>
                <input type="Sobrenome" class="form-control" name="inputSobrenome" placeholder="Sobrenome" value="<?= (isset($v_cliente)) ? $v_cliente->sobrenome : "" ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-12">
                <label for="inputCNPJ">CNPJ</label>
                <input type="text" class="form-control" name="inputCnpj" placeholder="Apenas numeros" value="<?= (isset($v_cliente)) ? $v_cliente->cnpj : "" ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-12">
                <label for="inputRua">Rua</label>
                <input type="text" class="form-control" name="inputRua" placeholder="Rua Exemplo" value="<?= (isset($v_cliente)) ? $v_cliente->endereco->rua : "" ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-4">
                <label for="inputCidade">Cidade</label>
                <input type="text" class="form-control" name="inputCidade" placeholder="Cidade" value="<?= (isset($v_cliente)) ? $v_cliente->endereco->cidade : "" ?>">
            </div>
            <div class="col-4">
                <label for="inputEstado">Estado</label>
                <input type="text" class="form-control" name="inputEstado" placeholder="Estado" value="<?= (isset($v_cliente)) ? $v_cliente->endereco->estado : "" ?>">
            </div>
            <div class="col-4">
                <label for="inputCEP">CEP</label>
                <input type="text" class="form-control" name="inputCep" placeholder="Apenas numeros" value="<?= (isset($v_cliente)) ? $v_cliente->endereco->cep : "" ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-6">
                <label for="inputBairro">Bairro</label>
                <input type="text" class="form-control" name="inputBairro" placeholder="Bairro" value="<?= (isset($v_cliente)) ? $v_cliente->endereco->bairro : "" ?>">
            </div>
            <div class="col-2">
                <label for="inputNumero">Numero</label>
                <input type="number" class="form-control" name="inputNumero" value="<?= (isset($v_cliente)) ? $v_cliente->endereco->numero : "" ?>">
            </div>
            <div class="col-4">
                <label for="inputTelefone">Telefone</label>
                <input type="text" class="form-control" name="inputTelefone" placeholder="Apenas numeros" value="<?= (isset($v_cliente)) ? $v_cliente->telefone : "" ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            <div class="col-1"></div>
            <?php if ($v_action == "update") { ?>
                <div class="col-2">
                    <a href="/" class="btn btn-dark">Cancelar</a>
                </div>
            <?php } ?>
            <div class="col-4"></div>
            <?php if ($v_action == "update") { ?>
                <input name="save" value="<?= $v_cliente->id ?>" hidden>
                <div class="col-2">
                    <a href="?view=cliente&action=delete&id=<?= $v_cliente->id ?>" class="btn btn-danger">Delete</a>
                </div>
            <?php } ?>
        </div>
    </div>
</form>