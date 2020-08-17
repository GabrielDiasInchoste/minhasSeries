<?php
    require_once '../config/conexao.php';

    //epsodio/epsodio.php?acao=listar

    if(!isset($_GET['acao'])) $acao="listar";
    else $acao = $_GET['acao'];

    /**
    * Ação de listar
    */
    if($acao=="listar"){
       $sql   = "SELECT e.id, e.nome, e.resumo, e.assistido, t.numero as temporada
                    FROM epsodio e
                    INNER JOIN temporada t ON t.id=e.id_temporada";
       $query = $con->query($sql);
       if($query==false) print_r($con->errorInfo());
       $registros = $query->fetchAll();

       // print_r($registros); exit;
       require_once '../template/cabecalho.php';
       require_once 'lista_epsodio.php';
       require_once '../template/rodape.php';
    }
    /**
    * Ação Novo
    **/
    else if($acao == "novo"){
      $lista_temporada = getTemporadas();

      // print_r($lista_genero); exit;
      require_once '../template/cabecalho.php';
      require_once 'form_epsodio.php';
      require_once '../template/rodape.php';
    }
    /**
    * Ação Gravar
    **/
    else if($acao == "gravar"){
        $registro = $_POST;

        $registro['assistido'] = (isset($registro['assistido']))? 1 : 0;
        // var_dump($registro);

        $sql = "INSERT INTO epsodio(nome, resumo, id_temporada, assistido)
                  VALUES(:nome, :resumo, :id_temporada, :assistido)";
        $query = $con->prepare($sql);
        $result = $query->execute($registro);
        if($result){
            header('Location: ./epsodio.php');
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
        $sql   = "DELETE FROM epsodio WHERE id = :id";
        $query = $con->prepare($sql);

        $query->bindParam(':id', $id);

        $result = $query->execute();
        if($result){
            header('Location: ./epsodio.php');
        }else{
            echo "Erro ao tentar remover o resgitro de id: " . $id;
        }
    }
    /**
    * Ação Excluir
    **/
    else if($acao == "buscar"){
        $id    = $_GET['id'];
        $sql   = "SELECT * FROM epsodio WHERE id = :id";
        $query = $con->prepare($sql);
        $query->bindParam(':id', $id);

        $query->execute();
        $registro = $query->fetch();

        // var_dump($registro); exit;
        $lista_temporada = getTemporadas();
        require_once '../template/cabecalho.php';
        require_once 'form_epsodio.php';
        require_once '../template/rodape.php';
    }
    /**
    * Ação Atualizar
    **/
    else if($acao == "atualizar"){
        $sql   = "UPDATE epsodio SET nome = :nome, resumo = :resumo,
                    id_temporada = :id_temporada, assistido = :assistido WHERE id = :id";
        $query = $con->prepare($sql);

        $_POST['assistido'] = (isset($_POST['assistido']))? 1 : 0;

        $query->bindParam(':id', $_GET['id']);
        $query->bindParam(':nome', $_POST['nome']);
        $query->bindParam(':resumo', $_POST['resumo']);
        $query->bindParam(':id_temporada', $_POST['id_temporada']);
        $query->bindParam(':assistido', $_POST['assistido']);
        $result = $query->execute();

        if($result){
            header('Location: ./epsodio.php');
        }else{
            echo "Erro ao tentar atualizar os dados" . print_r($query->errorInfo());
        }
    }

    //função que retorna a lista de gêneros cadastrados no banco
    function getTemporadas(){
        $sql   = "SELECT t.id, t.numero, t.ano_lancamento, t.assistido, s.nome as serie
                     FROM temporada t
                     INNER JOIN serie s ON s.id=t.id_serie";
        $query = $GLOBALS['con']->query($sql);
        $lista_serie = $query->fetchAll();
        return $lista_serie;
    }
 ?>
