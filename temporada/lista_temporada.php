<?php if (isset($erro)): ?>
  <div class="container">
    <?php  echo $erro;   ?>
  </div>
<?php else: ?>
  <div class="container print">
  <h2><?php echo $serie['nome']; ?> | Temporadas</h2>
  <a class="btn btn-info" href="temporada.php?acao=novo&id_serie=<?php echo $id_serie;  ?>">Novo</a>
  <?php if (count($registros)==0): ?>
    <p>Nenhum registro encontrado.</p>
  <?php else: ?>
    <table class="table table-hover table-stripped">
      <thead>
          <th>#</th>
          <th>Número</th>
          <th>Ano Lançamento</th>
          <th>Completa</th>
          <th>Ações</th>
      </thead>
      <tbody>
        <?php foreach ($registros as $linha): ?>
          <tr>
            <td><?= $linha['id']; ?></td>
            <td><?= $linha['numero']; ?></td>
            <td><?= $linha['ano_lancamento']; ?></td>
            <td><?php if($linha['assistido']==1) echo "Completa";
                      else echo "Incompleta"; ?></td>
            <td>
                <a class="btn btn-warning btn-sm" href="temporada.php?acao=buscar&id=<?php echo $linha['id']; ?>">Editar</a>
                <a class="btn btn-danger btn-sm" href="temporada.php?acao=excluir&id=<?php echo $linha['id']; ?>&id_serie=<?php echo $linha['id_serie']; ?>">Excluir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<?php endif; ?>
