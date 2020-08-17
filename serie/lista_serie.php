
<div class="container print">
  <h2>Séries</h2>
  <a class="btn btn-info" href="serie.php?acao=novo">Novo</a>
  <?php if (count($registros)==0): ?>
    <p>Nenhum registro encontrado.</p>
  <?php else: ?>
    <table class="table table-hover table-stripped">
      <thead>
          <th>#</th>
          <th>Nome</th>
          <th>Ano Lançamento</th>
          <th>Gênero</th>
          <th>Status</th>
          <th>Ações</th>
      </thead>
      <tbody>
        <?php foreach ($registros as $linha): ?>
          <tr>
            <td><?= $linha['id']; ?></td>
            <td><?= $linha['nome']; ?></td>
            <td><?= $linha['ano_lancamento']; ?></td>
            <td><?= $linha['genero']; ?></td>
            <td><?php if($linha['completa']==1) echo "Completa";
                      else echo "Incompleta"; ?></td>
            <td>
                <a class="btn btn-info btn-sm" href="../temporada/temporada.php?acao=listar&id_serie=<?php echo $linha['id']; ?>">Temporadas</a>
                <a class="btn btn-warning btn-sm" href="serie.php?acao=buscar&id=<?php echo $linha['id']; ?>">Editar</a>
                <a class="btn btn-danger btn-sm" href="serie.php?acao=excluir&id=<?php echo $linha['id']; ?>">Excluir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
