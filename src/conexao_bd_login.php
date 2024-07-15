<?php
$host = 'localhost';
$dbname = 'bd_sistema_login';
$username = 'root';
$password = '19e23za*';

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // A linha de depuração deve ser removida após a verificação
    // echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}









