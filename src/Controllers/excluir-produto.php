<?php

// Inclui o arquivo de conexão com o banco de dados
require "../conexao-bd.php";

// Inclui as classes necessárias: Modelo Produto e Repositório ProdutoRepositorio
require "../Modelo/Produto.php";
require "../Repositorio/ProdutoRepositorio.php";

// Cria uma instância do Repositório de Produto, passando a conexão PDO como parâmetro
$produtoRepositorio = new ProdutoRepositorio($pdo);

// Deleta o produto com base no ID recebido via POST
$produtoRepositorio->deletar($_POST['id']);

// Redireciona o usuário de volta para a página admin.php após deletar o produto
header("Location: admin.php");

// Encerra o script PHP
