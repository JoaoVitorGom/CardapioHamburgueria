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
    $email = $_POST['email'];
    $data = $_POST['data'];

    // Verificar se a senha atende aos requisitos mínimos
    if (strlen($password) < 8 || !preg_match('/[0-9]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        // Se a senha não atender aos requisitos
        die("A senha deve ter pelo menos 8 caracteres, conter pelo menos um dígito, uma letra maiúscula e um caractere especial (!@#$%^&*(),.?\":{}|<>).");
    }

    // Hash da senha antes de inserir no banco de dados
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepara a consulta SQL para inserir o novo usuário
    $sql = "INSERT INTO usuario (username, password,email,data) VALUES (:username, :password,:email,:data)";
    $stmt = $conn->prepare($sql);

    // Verificação de depuração para a preparação da consulta
    if (!$stmt) {
        die("Falha na preparação da consulta: " . implode(" ", $conn->errorInfo()));
    }

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':data', $data);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
        header("Location: cadastroBemSucedido.php?username=" . urlencode($username));
        exit();
    } else {
        // Mensagem de erro se a consulta falhar
        echo "Erro ao cadastrar o usuário: " . implode(" ", $stmt->errorInfo());
    }
}
