<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Reset CSS padrão e estilos específicos da aplicação -->
  <link rel="stylesheet" href="../../public/css/reset.css">
  <link rel="stylesheet" href="../../public/css/index.css">
  <link rel="stylesheet" href="../../public/css/admin.css">
  <link rel="stylesheet" href="../../public/css/form.css">
  <!-- Pré-conexão e carregamento de fontes Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- Ícone da página -->
  <link rel="icon" href="../../public/img/Pioneiro-Photoroom.png" type="image/x-icon">
  <title>Kingdom of Burguer - Boas Vindas</title>
</head>
<body>
    <main>
        <section class="container-admin-banner">
            <!-- Logo da aplicação -->
            <img src="../../public/img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
            <!-- Título da página -->
            <h2>Página de Operações do Administrador</h2>
            <br>
            <!-- Botões de navegação e operação -->
            <input type="button" class="botao-cadastrar" value="Página de Produtos" onclick="window.location.href='../Controllers/admin.php'">
            <br>
            <input type="button" class="botao-cadastrar" value="Excluir Conta Admin" onclick="window.location.href='../Controllers/excluir-usuario-form.php'">
            <br>
            <input type="button" class="botao-cadastrar" value="Cadastrar Admin" onclick="window.location.href='../Controllers/cadastro_usuario.php'">
            <br>
            <input type="button" class="botao-cadastrar" value="Logout" onclick="window.location.href='../Controllers/logout.php'">
            <br>
            <br>
        </section>
    </main>
</body>
</html>
