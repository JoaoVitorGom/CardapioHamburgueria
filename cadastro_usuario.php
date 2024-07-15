<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/Pioneiro-Photoroom.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Kingdom of Burguer - Cadastrar Administrador</title>
</head>
<body>
<section class="container-admin-banner">
        <img src="img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
        <h1>Cadastro de Administradores</h1>
</section>
  <sectio class="container-form">
     <form method="post" action="cadastro_usuario_process.php">
        <label for="username">Nome Completo:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="email">Nome de Usuário(e-mail):</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="data">Data de nascimento:</label>
        <input type="date" name="data" id="data" required>
        <br>
        <input type="submit" class="botao-cadastrar" value="Cadastrar">
        <br>
        <input type="button" class="botao-cadastrar" value="Página do Admin" onclick="window.location.href='pagina-funcoes.php'">
        <br>
        <input type="button" class="botao-cadastrar" value="Logout" onclick="window.location.href='logout.php'">
        <br>
    </form>
    </section>
</body>
</html>

