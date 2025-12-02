<?php
    require "../../autoload.php";

    // Construir o objeto do usuario
    $usuario = new Usuario();
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);

    // Inserir no Banco de Dados
    $dao = new UsuarioDAO();
    $dao->create($usuario);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');