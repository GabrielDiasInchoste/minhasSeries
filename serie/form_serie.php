<?php
    if(isset($registro)) $acao = "serie.php?acao=atualizar&id=".$registro['id'];
    else $acao = "serie.php?acao=gravar";
 ?>
<div class="container">
  <form class="" action="<?php echo $acao; ?>" method="post">
    <div class="from-group">
      <label for="nome">Nome</label>
      <input id="nome" class="form-control" type="text" name="nome"
        value="<?php if(isset($registro)) echo $registro['nome']; ?>" required>
    </div>
    <div class="from-group">
      <label for="ano_lancamento">Ano Lançamento</label>
      <input id="ano_lancamento" class="form-control" type="number" name="ano_lancamento"
        value="<?php if(isset($registro)) echo $registro['ano_lancamento']; ?>" required>
    </div>
    <div class="from-group">
      <label for="id_genero">Gênero</label>
      <select class="form-control" name="id_genero" required>
        <option value="">Escolha um item na lista</option>
        <?php foreach ($lista_genero as $item): ?>
          <option value="<?php echo $item['id']; ?>"
            <?php if(isset($registro) && $registro['id_genero']==$item['id']) echo "selected";?>>
            <?php echo $item['nome']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-check">
      <input id="completa" class="form-check-input" type="checkbox" name="completa"
        <?php if(isset($registro) && $registro['completa']==1) echo "checked"; ?>>
      <label class="form-check-label" for="completa">  Completa </label>
    </div>
    <br>
    <button class="btn btn-info" type="submit">Enviar</button>
  </form>
</div>
