<?php
    if(isset($registro)) $acao = "epsodio.php?acao=atualizar&id=".$registro['id'];
    else $acao = "epsodio.php?acao=gravar";
 ?>
<div class="container">
  <form class="" action="<?php echo $acao; ?>" method="post">
    <div class="from-group">
      <label for="nome">Nome</label>
      <input id="nome" class="form-control" type="text" name="nome"
        value="<?php if(isset($registro)) echo $registro['nome']; ?>" required>
    </div>
    <div class="from-group">
      <label for="ano_lancamento">Resumo</label>
      <input id="ano_lancamento" class="form-control" type="text" name="resumo"
        value="<?php if(isset($registro)) echo $registro['resumo']; ?>" maxlength="500" required>
    </div>
    <div class="from-group">
      <label for="id_genero">Temporada</label>
      <select class="form-control" name="id_temporada" required>
        <option value="">Escolha um item na lista</option>
        <?php foreach ($lista_temporada as $item): ?>
          <option value="<?php echo $item['id']; ?>"
            <?php if(isset($registro) && $registro['id_temporada']==$item['id']) echo "selected";?>>
            <?php echo 'Série : ' . $item['serie'] . ' | temporada: ' . $item['numero']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-check">
      <input id="completa" class="form-check-input" type="checkbox" name="assistido"
        <?php if(isset($registro) && $registro['assistido']==1) echo "checked"; ?>>
      <label class="form-check-label" for="completa">  Completa </label>
    </div>
    <br>
    <button class="btn btn-info" type="submit">Enviar</button>
  </form>
</div>
