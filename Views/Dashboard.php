<div class="card">
  <div class="card">
    <div class="card-header">
      Clientes cadastrados
    </div>
    <div class="card-body" style="overflow-y: scroll; height:60vh;">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Sobrenome</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($v_clients as $client) { ?>
            <tr>
              <td scope="col"><?= $client->id ?></td>
              <td scope="col"><?= $client->nome ?></td>
              <td scope="col"><?= $client->sobrenome ?></td>
              <td scope="col">
                <form method="POST" action="?view=cliente&action=update&id=<?= $client->id ?>">
                  <button type="submit" class="btn btn-primary">Editar</button>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>