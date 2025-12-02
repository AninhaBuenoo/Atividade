<?php
    require "../../autoload.php";

    $dao = new VendaProdutoDAO();
?>

<h2>Tabela de Cadastrados</h2>
<table class="table table-hover">
    <tr>
        <th>ID da Venda</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor Unitário</th>
        <th>Ações</th>
    </tr>
    <?php foreach($dao->read($idVenda) as $vendaProduto) : ?>
        <tr>
            <td><?= $vendaProduto->getVenda()->getId() ?></td>
            <td><?= $vendaProduto->getProduto() ?></td>
            <td><?= $vendaProduto->getQuantidade() ?></td>
            <td><?= $vendaProduto->getValorUnitario() ?></td>
            <td>
                <a class="link link-danger" href="destroy.php?idvenda=<?= $idVenda ?>&idProduto=<?= $vendaProduto->getProduto()->getId() ?>" title="Excluir">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach ?>

</table>