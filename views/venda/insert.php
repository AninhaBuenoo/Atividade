<?php
    require "../../autoload.php";

    // Construir o objeto da venda
    $venda = new Venda();
    $venda->setData($_POST['data']);
    
    // Construir um objeto do cliente
    $cliente = new Cliente();
    $cliente->setId($_POST['cliente']);
    
    // Construir um objeto do Usuário
    $usuario = new Usuario();
    $usuario->setId($_POST['usuario']);

    // Definir o cliente e Usuário (objetos das associações) na classe venda
    $venda->setCliente($cliente);
    $venda->setUsuario($usuario);

    // Inserir no Banco de Dados
    $dao = new VendaDAO();
    $dao->create($venda);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');