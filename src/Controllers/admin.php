<?php
// Inclui arquivos necessários
require_once "../conexao-bd.php";
require_once "../Modelo/Produto.php";
require_once "../Repositorio/ProdutoRepositorio.php";

// Cria uma instância do repositório de produtos usando a conexão PDO
$produtoRepositorio = new ProdutoRepositorio($pdo);

// Busca todos os produtos no banco de dados
$produtos = $produtoRepositorio->buscarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../public/css/reset.css"> <!-- Estilos de reset para garantir consistência -->
  <link rel="stylesheet" href="../../public/css/index.css"> <!-- Estilos específicos para a página index -->
  <link rel="stylesheet" href="../../public/css/admin.css"> <!-- Estilos para a área administrativa -->
  <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Pré-conexão para carregamento de fontes -->
  <link rel="icon" href="../../public/img/Pioneiro-Photoroom.png" type="image/x-icon"> <!-- Ícone da página -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Pré-conexão para carregamento de fontes -->
  <title>Kingdom of Burguer - Admin</title> <!-- Título da página -->
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="../../public/img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto"> <!-- Logo da empresa -->
    <h1>Administração Kingdom of Burguer</h1> <!-- Título principal da página -->
  </section>
  <h2>Lista de Produtos</h2> <!-- Título da seção de lista de produtos -->


  <section class="container-table">
    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Tipo</th>
          <th>Descrição</th>
          <th>Valor</th>
          <th colspan="2">Ação</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($produtos as $produto): ?>
          <tr>
            <td><?= $produto->getNome() ?></td> <!-- Exibe o nome do produto -->
            <td><?= $produto->getTipo() ?></td> <!-- Exibe o tipo do produto -->
            <td><?= $produto->getDescricao() ?></td> <!-- Exibe a descrição do produto -->
            <td><?= $produto->getPrecoFormatado() ?></td> <!-- Exibe o preço formatado do produto -->
            <td><a class="botao-editar" href="editar-produto.php?id=<?= $produto->getId() ?>">Editar</a></td> <!-- Botão para editar o produto -->
            <td>
              <form action="excluir-produto.php" method="post">
                  <input type="hidden" name="id" value="<?= $produto->getId() ?>"> <!-- Campo oculto com o ID do produto a ser excluído -->
                <input type="submit" class="botao-excluir" value="Excluir"> <!-- Botão para excluir o produto -->
              </form>
            </td>
          </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <input type="button" class="botao-cadastrar" value="Cadastrar Produto" onclick="window.location.href='cadastrar-produto-process.php'"> <!-- Botão para cadastrar novo produto -->
    <input type="button" class="botao-cadastrar" value="Página do Admin" onclick="window.location.href='../View/pagina-funcoes.php'"> <!-- Botão para voltar à página de funções do admin -->
    <input type="button" class="botao-cadastrar" value="Logout" onclick="window.location.href='logout.php'"> <!-- Botão para logout -->
    <br>
  </section>
</main>
</body>
</html>
