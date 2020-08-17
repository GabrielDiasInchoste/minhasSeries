<?php
    require_once '../config/conexao.php';

    //genero/genero.php?acao=listar

    if(!isset($_GET['acao'])) $acao="listar";
    else $acao = $_GET['acao'];

    /**
    * Ação de listar
    */
    if($acao=="listar"){
       $sql   = "SELECT * FROM genero";
       $query = $con->query($sql);
       $registros = $query->fetchAll();

       require_once '../template/cabecalho.php';
       require_once 'lista_genero.php';
       require_once '../template/rodape.php';
    }
    /**
    * Ação Novo
    **/
    else if($acao == "novo"){
      require_once '../template/cabecalho.php';
      require_once 'form_genero.php';
      require_once '../template/rodape.php';
    }
    /**
    * Ação Gravar
    **/
    else if($acao == "gravar"){
        $registro = $_POST;

        // var_dump($registro);
        $sql = "INSERT INTO genero(nome) VALUES(:nome)";
        $query = $con->prepare($sql);
        $result = $query->execute($registro);
        if($result){
            header('Location: ./genero.php');
        }else{
            echo "Erro ao tentar inserir o registro";
        }
    }
    /**
    * Ação Excluir
    **/
    else if($acao == "excluir"){
        $id    = $_GET['id'];
        $sql   = "DELETE FROM genero WHERE id = :id";
        $query = $con->prepare($sql);

        $query->bindParam(':id', $id);

        $result = $query->execute();
        if($result){
            header('Location: ./genero.php');
        }else{
            echo "Erro ao tentar remover o resgitro de id: " . $id;
        }
    }
    /**
    * Ação Excluir
    **/
    else if($acao == "buscar"){
        $id    = $_GET['id'];
        $sql   = "SELECT * FROM genero WHERE id = :id";
        $query = $con->prepare($sql);
        $query->bindParam(':id', $id);

        $query->execute();
        $registro = $query->fetch();

        // var_dump($registro); exit;

        require_once '../template/cabecalho.php';
        require_once 'form_genero.php';
        require_once '../template/rodape.php';

    }
    /**
    * Ação Atualizar
    **/
    else if($acao == "atualizar"){
        $sql   = "UPDATE genero SET nome = :nome WHERE id = :id";
        $query = $con->prepare($sql);

        $query->bindParam(':id', $_GET['id']);
        $query->bindParam(':nome', $_POST['nome']);
        $result = $query->execute();

        // $registro = array('id'  =>$_GET['id'],
        //                   'nome'=>$_POST['nome']);
        // $result = $query->execute($registro);

        if($result){
            header('Location: ./genero.php');
        }else{
            echo "Erro ao tentar atualizar os dados";
        }
    }

 ?>
