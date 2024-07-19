<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../public/css/reset.css"> <!-- Reset CSS para garantir estilos consistentes -->
  <link rel="stylesheet" href="../../public/css/index.css"> <!-- Estilos específicos da página index -->
  <link rel="stylesheet" href="../../public/css/admin.css"> <!-- Estilos para a área administrativa -->
  <link rel="stylesheet" href="../../public/css/form.css"> <!-- Estilos para formulários -->
  <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Pré-conexão para carregamento de fontes -->
  <link rel="icon" href="../../public/img/Pioneiro-Photoroom.png" type="image/x-icon"> <!-- Ícone da página -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Pré-conexão para carregamento de fontes -->
  <title>Kingdom of Burger - Login</title> <!-- Título da página -->
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="../../public/img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto"> <!-- Logo da empresa -->
    <h1>Login Kingdom of Burger</h1> <!-- Título da seção de login -->
  </section>
  <section class="container-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <!-- Formulário de login enviando para a mesma página -->
      <label for="email">Nome de Usuário:</label> <!-- Campo para inserir nome de usuário -->
      <input type="text" id="email" name="email" required><br> <!-- Input para inserção do nome de usuário -->
      <label for="password">Senha:</label> <!-- Campo para inserir senha -->
      <input type="password" id="password" name="password" required><br> <!-- Input para inserção da senha -->
      <input type="submit" class="botao-cadastrar" value="Entrar"/> <!-- Botão para submeter o formulário -->
      <br>
      <br>
    </form>
  </section>
</main>
<?php
// Verificação e processamento do formulário de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('../conexao_bd_login.php');

    // Verificação adicional para garantir que a conexão foi estabelecida corretamente
    if (!isset($conn)) {
        die("Falha ao conectar ao banco de dados.");
    }

    // Recebe os dados do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepara a consulta SQL
    $sql = "SELECT id, email, password FROM usuario WHERE email = :email";
    $stmt = $conn->prepare($sql);

    // Verificação de depuração para a preparação da consulta
    if (!$stmt) {
        die("Falha na preparação da consulta: " . implode(" ", $conn->errorInfo()));
    }

    $stmt->bindParam(':email', $email);

    // Verifique se a consulta foi preparada corretamente
    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $stored_hash = $user['password']; // Hash de senha armazenado no banco de dados

            // Verifica se a senha fornecida corresponde ao hash de senha armazenado
            if (password_verify($password, $stored_hash)) {
                // Login bem-sucedido
                echo "<script>window.location.href='../View/loginBemSucedido.php?username=" . urlencode($username) . "';</script>";
                exit();
            } else {
                // Senha incorreta
                echo "<script>alert('Senha incorreta.');</script>";
            }
        } else {
            // Nome de usuário não encontrado
            echo "<script>alert('Nome de usuário não encontrado.');</script>";
        }
    } else {
        // Mensagem de erro se a consulta falhar
        echo "<script>alert('Erro na execução da consulta: " . implode(" ", $stmt->errorInfo()) . "');</script>";
    }
}
?>
</body>
</html>
