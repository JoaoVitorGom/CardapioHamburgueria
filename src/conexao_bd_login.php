<?php
// Definição das informações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'bd_sistema_login';
$username = 'root';
$password = '';

try {
    // Construção da string de conexão (DSN)
    $dsn = "mysql:host=$host;dbname=$dbname";

    // Criação de uma nova conexão PDO com as credenciais fornecidas
    $conn = new PDO($dsn, $username, $password);

    // Define o modo de erro para lançar exceções em caso de erros no PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mensagem de depuração (opcional): indica que a conexão foi bem-sucedida
    // A linha abaixo deve ser removida ou comentada após confirmar que a conexão está funcionando corretamente
    // echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    // Em caso de falha na conexão, exibe a mensagem de erro e interrompe o script
    die("Connection failed: " . $e->getMessage());
}
?>









