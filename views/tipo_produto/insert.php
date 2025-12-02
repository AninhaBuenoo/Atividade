<?php
    require "../../autoload.php";

    // Construir o objeto do tipoProduto
    $tipoProduto = new TipoProduto();
    $tipoProduto->setDescricao($_POST['descricao']);

    // Inserir no Banco de Dados
    $dao = new TipoProdutoDAO();
    $dao->create($tipoProduto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');