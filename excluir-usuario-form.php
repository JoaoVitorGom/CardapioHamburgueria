<?php
require('src/conexao_bd_login.php');

// Obtém a lista de usuários usando PDO
try {
    $stmt = $conn->query("SELECT id, username FROM usuario");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao consultar usuários: " . $e->getMessage());
}
?>
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
  <title>Kingdom of Burguer - Excluir Conta Admin</title>
  <script>
        function confirmDelete() {
            return confirm("Você tem certeza que deseja excluir este usuário?");
        }
    </script>
</head>
<body>
    <section class="container-admin-banner">
        <img src="img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
        <h1>Exclusão De Contas</h1>
</section>
<section class="container-form">
    <form method="post" action="excluir-usuario-process.php">
        <select id="user_id" name="user_id" required>
            <option value="">Selecione um usuário</option>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo htmlspecialchars($usuario['id']); ?>"><?php echo htmlspecialchars($usuario['username']); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" class="botao-cadastrar" value="Excluir Conta Admin" onclick="window.location.href='excluir-usuario-process.php'">
         <br>
        <input type="button" class="botao-cadastrar" value="Página do Admin" onclick="window.location.href='pagina-funcoes.php'">
        <br>
        <input type="button" class="botao-cadastrar" value="Logout" onclick="window.location.href='logout.php'">
        <br>
    </form>
    </section>
</body>
</html>
