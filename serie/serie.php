<?php
    require_once '../config/conexao.php';

    //serie/serie.php?acao=listar

    if(!isset($_GET['acao'])) $acao="listar";
    else $acao = $_GET['acao'];

    /**
    * Ação de listar
    */
    if($acao=="listar"){
       $sql   = "SELECT s.id, s.nome, s.ano_lancamento, s.completa, g.nome as genero
                    FROM serie s
                    INNER JOIN genero g ON g.id=s.id_genero";
       $query = $con->query($sql);
       $registros = $query->fetchAll();

       // print_r($registros); exit;
       require_once '../template/cabecalho.php';
       require_once 'lista_serie.php';
       require_once '../template/rodape.php';
    }
    /**
    * Ação Novo
    **/
    else if($acao == "novo"){
      $lista_genero = getGeneros();

      // print_r($lista_genero); exit;
      require_once '../template/cabecalho.php';
      require_once 'form_serie.php';
      require_once '../template/rodape.php';
    }
    /**
    * Ação Gravar
    **/
    else if($acao == "gravar"){
        $registro = $_POST;

        $registro['completa'] = (isset($registro['completa']))? 1 : 0;
        // var_dump($registro);

        $sql = "INSERT INTO serie(nome, ano_lancamento, id_genero, completa)
                  VALUES(:nome, :ano_lancamento, :id_genero, :completa)";
        $query = $con->prepare($sql);
        $result = $query->execute($registro);
        if($result){
            header('Location: ./serie.php');
        }else{
            echo "Erro ao tentar inserir o registro, msg: " . print_r($query->errorInfo());
        }
    }
    /**
    * Ação Excluir
    **/
    else if($acao == "excluir"){
        $id    = $_GET['id'];
        $sql   = "DELETE FROM serie WHERE id = :id";
        $query = $con->prepare($sql);

        $query->bindParam(':id', $id);

        $result = $query->execute();
        if($result){
            header('Location: ./serie.php');
        }else{
            echo "Erro ao tentar remover o resgitro de id: " . $id;
        }
    }
    /**
    * Ação Excluir
    **/
    else if($acao == "buscar"){
        $id    = $_GET['id'];
        $sql   = "SELECT * FROM serie WHERE id = :id";
        $query = $con->prepare($sql);
        $query->bindParam(':id', $id);

        $query->execute();
        $registro = $query->fetch();

        // var_dump($registro); exit;
        $lista_genero = getGeneros();
        require_once '../template/cabecalho.php';
        require_once 'form_serie.php';
        require_once '../template/rodape.php';
    }
    /**
    * Ação Atualizar
    **/
    else if($acao == "atualizar"){
        $sql   = "UPDATE serie SET nome = :nome, ano_lancamento = :ano_lancamento,
                    id_genero = :id_genero, completa = :completa WHERE id = :id";
        $query = $con->prepare($sql);

        $_POST['completa'] = (isset($_POST['completa']))? 1 : 0;

        $query->bindParam(':id', $_GET['id']);
        $query->bindParam(':nome', $_POST['nome']);
        $query->bindParam(':ano_lancamento', $_POST['ano_lancamento']);
        $query->bindParam(':id_genero', $_POST['id_genero']);
        $query->bindParam(':completa', $_POST['completa']);
        $result = $query->execute();

        if($result){
            header('Location: ./serie.php');
        }else{
            echo "Erro ao tentar atualizar os dados" . print_r($query->errorInfo());
        }
    }

    //função que retorna a lista de gêneros cadastrados no banco
    function getGeneros(){
        $sql   = "SELECT * FROM genero";
        $query = $GLOBALS['con']->query($sql);
        $lista_genero = $query->fetchAll();
        return $lista_genero;
    }
 ?>
