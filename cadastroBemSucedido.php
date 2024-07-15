<?php
require('src/conexao_bd_login.php');

// Verifica se o parâmetro 'username' está presente na URL
if (!isset($_GET['username'])) {
    // Se não estiver presente, redireciona para a página principal do admin
    header("Location: pagina-funcoes.php");
    exit();
}

// Obtém o nome de usuário da URL
$nome = $_GET['username'];
?>

<!doctype html>
<html lang="pt-br">
<head>
    <!-- Configurações gerais do documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Links para arquivos de estilos CSS -->
    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset para padronização de estilos -->
    <link rel="stylesheet" href="css/index.css"> <!-- Estilos gerais da aplicação -->
    <link rel="stylesheet" href="css/admin.css"> <!-- Estilos específicos para administração -->
    <link rel="stylesheet" href="css/form.css"> <!-- Estilos específicos para formulários -->
    
    <!-- Pré-conexão e carregamento de fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícone da página exibido na aba do navegador -->
    <link rel="icon" href="img/Pioneiro-Photoroom.png" type="image/x-icon">
    
    <!-- Título da página exibido na aba do navegador -->
    <title>Kingdom of Burguer - Boas Vindas</title>
</head>
<body>
    <!-- Início da seção principal da página -->
    <main>
        <!-- Container do banner de administração -->
        <section class="container-admin-banner">
            <!-- Logo da aplicação exibido no banner -->
            <img src="img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
            
            <!-- Título de boas-vindas personalizado com o nome do usuário -->
            <h1>Parabéns, <?php echo htmlspecialchars($nome); ?>!</h1>
            <br>
            
            <!-- Mensagem de sucesso -->
            <h2>Você foi cadastrado com sucesso</h2>
            <br>
            
            <!-- Botão para redirecionar à página principal do admin -->
            <input type="button" class="botao-cadastrar" value="Página do Admin" onclick="window.location.href='pagina-funcoes.php'">
            <br>
            
            <!-- Botão para realizar logout -->
            <input type="button" class="botao-cadastrar" value="Logout" onclick="window.location.href='logout.php'">
            <br>
        </section>
    </main>
</body>
</html>
