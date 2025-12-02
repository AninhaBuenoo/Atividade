<?php
    require "../../autoload.php";

    // Construir o objeto da vendaProduto
    $vendaProduto = new VendaProduto();
    $vendaProduto->setQuantidade($_POST['quantidade']);
    $vendaProduto->setValorUnitario($_POST['valor_unitario']);
    
    // Construir um objeto da venda
    $venda = new Venda();
    $venda->setId($_POST['id']);
    
    // Construir um objeto do Produto
    $produto = new Produto();
    $produto->setId($_POST['produto']);

    // Definir o venda e Produto (objetos das associações) na classe vendaProduto
    $vendaProduto->setVenda($venda);
    $vendaProduto->setProduto($produto);

    // Inserir no Banco de Dados
    $dao = new VendaProdutoDAO();
    $dao->create($vendaProduto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: create.php?id=' . $venda->getId());