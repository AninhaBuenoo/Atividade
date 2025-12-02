<?php
    require "../../autoload.php";

    // Excluir do Banco de Dados
    $dao = new VendaProdutoDAO();
    $dao->destroy($_GET['idVenda'],$_GET['idProduto']);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: create.php?id=' . $_GET['idVenda']);