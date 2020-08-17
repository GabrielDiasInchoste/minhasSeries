<?php
    require_once '../config/conexao.php';

    //temporada/temporada.php?acao=listar

    if(!isset($_GET['acao'])) $acao="listar";
    else $acao = $_GET['acao'];

    /**
    * Ação de listar
    */
    if($acao=="listar"){
       if(!isset($_GET['id_serie'])){
         $erro = "Nenhuma série informada";
         $registros = array();
       }else{
         $id_serie = $_GET['id_serie'];

         //buscando os dados da série para a view
         $sqlSerie   = "SELECT * FROM serie WHERE id = ".$id_serie;
         $querySerie = $con->query($sqlSerie);
         $serie      = $querySerie->fetch();


         $sql   = "SELECT t.id, t.numero, t.ano_lancamento, t.assistido, t.id_serie, s.nome as serie
                     FROM temporada t
                     INNER JOIN serie s ON s.id=t.id_serie
                     WHERE t.id_serie=".$id_serie;
         $query = $con->query($sql);
         if($query==false) print_r($con->errorInfo());
         $registros = $query->fetchAll();
       }

       // print_r($registros); exit;
       require_once '../template/cabecalho.php';
       require_once 'lista_temporada.php';
       require_once '../template/rodape.php';
    }
    /**
    * Ação Novo
    **/
    else if($acao == "novo"){
      // $lista_serie = getSeries();

      // print_r($lista_genero); exit;
      require_once '../template/cabecalho.php';
      require_once 'form_temporada.php';
      require_once '../template/rodape.php';
    }
    /**
    * Ação Gravar
    **/
    else if($acao == "gravar"){
        $registro = $_POST;

        $registro['assistido'] = (isset($registro['assistido']))? 1 : 0;
        // var_dump($registro);

        $sql = "INSERT INTO temporada(numero, ano_lancamento, id_serie, assistido)
                  VALUES(:numero, :ano_lancamento, :id_serie, :assistido)";
        $query = $con->prepare($sql);
        $result = $query->execute($registro);
        if($result){
            header('Location: ./temporada.php?acao=listar&id_serie='.$registro['id_serie']);
        }else{
            print_r($registro);
            echo "Erro ao tentar inserir o registro, msg: " . print_r($query->errorInfo());
        }
    }
    /**
    * Ação Excluir
    **/
    else if($acao == "excluir"){
        $id    = $_GET['id'];
        $sql   = "DELETE FROM temporada WHERE id = :id";
        $query = $con->prepare($sql);

        $query->bindParam(':id', $id);

        $result = $query->execute();
        if($result){
            header('Location: ./temporada.php?acao=listar&id_serie='.$_GET['id_serie']);
        }else{
            echo "Erro ao tentar remover o resgitro de id: " . $id;
        }
    }
    /**
    * Ação Excluir
    **/
    else if($acao == "buscar"){
        $id    = $_GET['id'];
        $sql   = "SELECT * FROM temporada WHERE id = :id";
        $query = $con->prepare($sql);
        $query->bindParam(':id', $id);

        $query->execute();
        $registro = $query->fetch();

        // var_dump($registro); exit;
        // $lista_serie = getSeries();
        require_once '../template/cabecalho.php';
        require_once 'form_temporada.php';
        require_once '../template/rodape.php';
    }
    /**
    * Ação Atualizar
    **/
    else if($acao == "atualizar"){
        $sql   = "UPDATE temporada SET numero = :numero, ano_lancamento = :ano_lancamento,
                    id_serie = :id_serie, assistido = :assistido WHERE id = :id";
        $query = $con->prepare($sql);

        $_POST['assistido'] = (isset($_POST['assistido']))? 1 : 0;

        $query->bindParam(':id', $_GET['id']);
        $query->bindParam(':numero', $_POST['numero']);
        $query->bindParam(':ano_lancamento', $_POST['ano_lancamento']);
        $query->bindParam(':id_serie', $_POST['id_serie']);
        $query->bindParam(':assistido', $_POST['assistido']);
        $result = $query->execute();

        if($result){
            header('Location: ./temporada.php?acao=listar&id_serie='.$_POST['id_serie']);
        }else{
            echo "Erro ao tentar atualizar os dados" . print_r($query->errorInfo());
        }
    }

    //função que retorna a lista de gêneros cadastrados no banco
    function getSeries(){
        $sql   = "SELECT * FROM serie";
        $query = $GLOBALS['con']->query($sql);
        $lista_serie = $query->fetchAll();
        return $lista_serie;
    }
 ?>
