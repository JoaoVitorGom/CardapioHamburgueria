<?php
require('src/conexao_bd_login.php');

// Verificação adicional para garantir que a conexão foi estabelecida corretamente
if (!isset($conn)) {
    die("Falha ao conectar ao banco de dados.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepara a consulta SQL
    $sql = "SELECT id, username, password FROM usuario WHERE username = :username";
    $stmt = $conn->prepare($sql);

    // Verificação de depuração para a preparação da consulta
    if (!$stmt) {
        die("Falha na preparação da consulta: " . implode(" ", $conn->errorInfo()));
    }

    $stmt->bindParam(':username', $username);

    // Verifique se a consulta foi preparada corretamente
    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $stored_hash = $user['password']; // Hash de senha armazenado no banco de dados

            // Verifica se a senha fornecida corresponde ao hash de senha armazenado
            if (password_verify($password, $stored_hash)) {
                // Login bem-sucedido
                echo "Login bem-sucedido! Redirecionando para loginBemSucedido.php...";
                // Redireciona o usuário para a página de sucesso com o nome de usuário na URL
                header("Location: loginBemSucedido.php?username=" . urlencode($username));
                exit();
            } else {
                // Senha incorreta
                echo "Senha incorreta.";
            }
        } else {
            // Nome de usuário não encontrado
            echo "Nome de usuário não encontrado.";
        }
    } else {
        // Mensagem de erro se a consulta falhar
        echo "Erro na execução da consulta: " . implode(" ", $stmt->errorInfo());
    }
} else {
    echo "Método de requisição inválido.";
}

