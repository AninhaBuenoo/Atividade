<?php
    require "../../autoload.php";

    // Construir o objeto do tipoProduto
    $tipoProduto = new TipoProduto();
    $tipoProduto->setDescricao($_POST['descricao']);
    $tipoProduto->setId($_POST['id']);

    // Atualizar registro no Banco de Dados
    $dao = new TipoProdutoDAO();
    $dao->update($tipoProduto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');