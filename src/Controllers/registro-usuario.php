<?php
require('db_connect.php'); // Inclui o arquivo de conexão com o banco de dados

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $data = $_POST['data'];

    // Verifica se os campos obrigatórios estão preenchidos
    if (empty($username) || empty($password) || empty($email) || empty($data)) {
        die("Nome de usuário, senha, e-mail e data são obrigatórios.");
    }

    // Hash da senha utilizando bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepara a consulta SQL utilizando placeholders (?)
    $sql = "INSERT INTO usuarios (username, password, email, data) VALUES (?, ?, ?, ?)";

    // Prepara a declaração SQL
    if ($stmt = $conn->prepare($sql)) {
        // Liga parâmetros à declaração preparada como strings ('ssss' indica que são todos strings)
        $stmt->bind_param("ssss", $username, $hashed_password, $email, $data);

        // Executa a consulta preparada
        if ($stmt->execute()) {
            echo "Registro bem-sucedido!";
            header("Location: login.php"); // Redireciona para a página de login após o registro bem-sucedido
            exit();
        } else {
            echo "Erro ao inserir usuário: " . $stmt->error; // Exibe mensagem de erro se a execução falhar
        }

        $stmt->close(); // Fecha a declaração preparada
    } else {
        echo "Erro na preparação da consulta: " . $conn->error; // Exibe mensagem de erro se a preparação falhar
    }

    $conn->close(); // Fecha a conexão com o banco de dados
} else {
    die("Método de solicitação inválido."); // Finaliza o script se o método de requisição não for POST
}
?>
