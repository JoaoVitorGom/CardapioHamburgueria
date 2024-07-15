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
  <link rel="icon" href="img/Pioneiro-Photoroom.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Kingdom of Burger - Login</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
    <h1>Login Kingdom of Burger</h1>
  </section>
  <section class="container-form">
  <form method="post" action="login_process.php">
        <label for="username">Nome de Usuário:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" class="botao-cadastrar" value="Entrar"/>
        <br>
        <br>
    </form>

  </section>
</main>
</body>
</html>

