<?php
require '../conexao_bd_login.php';

// Verifica se o parâmetro de nome de usuário está presente na URL
if (!isset($_GET['username'])) {
    // Se o nome de usuário não estiver presente, redireciona para a página de login
    header("Location: login.php");
    exit(); // Encerra o script para garantir que o redirecionamento seja feito corretamente
}

// Obtém o nome de usuário da URL de forma segura
$username = htmlspecialchars($_GET['username']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../public/css/reset.css"> <!-- Inclui o reset de CSS para garantir estilos consistentes -->
  <link rel="stylesheet" href="../../public/css/index.css"> <!-- Estilos específicos da página index -->
  <link rel="stylesheet" href="../../public/css/admin.css"> <!-- Estilos para a área administrativa -->
  <link rel="stylesheet" href="../../public/css/form.css"> <!-- Estilos para formulários -->
  <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Pré-conexão para carregamento de fontes -->
  <link rel="icon" href="../../public/img/Pioneiro-Photoroom.png" type="image/x-icon"> <!-- Ícone da página -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Pré-conexão para carregamento de fontes -->
  <title>Kingdom of Burger - Boas Vindas</title> <!-- Título da página -->
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="../../public/img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto"> <!-- Logo da empresa -->
    <h1>Bem-vindo, <?php echo $username; ?>!</h1> <!-- Saudação personalizada com o nome de usuário -->
    <br>
    <h2>Você foi logado com sucesso</h2> <!-- Mensagem de sucesso -->
    <br>
    <input type="button" class="botao-cadastrar" value="Página de Produtos" onclick="window.location.href='../Controllers/admin.php'"> <!-- Botão para ir para a página de produtos -->
    <br>
    <input type="button" class="botao-cadastrar" value="Excluir Conta Admin" onclick="window.location.href='../Controllers/excluir-usuario-form.php'"> <!-- Botão para excluir conta de admin -->
    <br>
    <input type="button" class="botao-cadastrar" value="Cadastrar Admin" onclick="window.location.href='../Controllers/cadastro_usuario.php'"> <!-- Botão para cadastrar novo admin -->
    <br>
    <input type="button" class="botao-cadastrar" value="Logout" onclick="window.location.href='../Controllers/logout.php'"> <!-- Botão para logout -->
    <br>
    <br>
  </section>
</main>
</body>
</html>
