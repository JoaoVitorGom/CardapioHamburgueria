<?php

$pdo = new PDO('mysql:host=localhost;dbname=bd_teste', 'root', '19e23za*');
?>
// Informações de conexão com o banco de dados
$host = 'localhost'; // Host do banco de dados
$dbname = 'bd_teste'; // Nome do banco de dados
$username = 'root'; // Nome de usuário do banco de dados
$password = '19e23za*'; // Senha do banco de dados

try {
    // Criação de uma nova conexão PDO com as credenciais fornecidas
    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);

    // Define o modo de erro para lançar exceções em caso de erros no PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mensagem de depuração (opcional): indica que a conexão foi bem-sucedida
    // A linha abaixo deve ser removida ou comentada após confirmar que a conexão está funcionando corretamente
    // echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    // Em caso de falha na conexão, exibe a mensagem de erro e interrompe o script
    die("Connection failed: " . $e->getMessage());
}
