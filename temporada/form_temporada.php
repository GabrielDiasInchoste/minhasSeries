<?php
    if(isset($registro)) $acao = "temporada.php?acao=atualizar&id=".$registro['id'];
    else $acao = "temporada.php?acao=gravar";
 ?>
<div class="container">
  <form class="" action="<?php echo $acao; ?>" method="post">
    <input type="hidden" name="id_serie"
      value="<?php if(isset($registro)) echo $registro['id_serie'];
                   else echo $_GET['id_serie']; ?>">
    <div class="from-group">
      <label for="nome">Número</label>
      <input id="nome" class="form-control" type="number" name="numero"
        value="<?php if(isset($registro)) echo $registro['numero']; ?>" required>
    </div>
    <div class="from-group">
      <label for="ano_lancamento">Ano Lançamento</label>
      <input id="ano_lancamento" class="form-control" type="number" name="ano_lancamento"
        value="<?php if(isset($registro)) echo $registro['ano_lancamento']; ?>" required>
    </div>
    <!-- <div class="from-group">
      <label for="id_genero">Série</label>
      <select class="form-control" name="id_serie" required>
        <option value="">Escolha um item na lista</option>
        <?php /*foreach ($lista_serie as $item): ?>
          <option value="<?php echo $item['id']; ?>"
            <?php if(isset($registro) && $registro['id_serie']==$item['id']) echo "selected";?>>
            <?php echo $item['nome']; ?>
          </option>
        <?php endforeach; */ ?>
      </select>
    </div> -->
    <div class="form-check">
      <input id="completa" class="form-check-input" type="checkbox" name="assistido"
        <?php if(isset($registro) && $registro['assistido']==1) echo "checked"; ?>>
      <label class="form-check-label" for="completa">  Completa </label>
    </div>
    <br>
    <button class="btn btn-info" type="submit">Enviar</button>
  </form>
</div>
