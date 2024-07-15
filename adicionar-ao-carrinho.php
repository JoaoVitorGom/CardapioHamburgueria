<?php
session_start();
require "src/conexao-bd.php";

// Recebe o ID do produto a ser adicionado ao carrinho
$idProduto = $_POST['id'] ?? null;

if (!$idProduto || !is_numeric($idProduto)) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'ID do produto inválido.']);
    exit;
}

// Obtém as informações do produto do banco de dados
$stmt = $pdo->prepare('SELECT nome, preco FROM produtos WHERE id = ?');
$stmt->execute([$idProduto]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Produto não encontrado.']);
    exit;
}

// Adiciona o produto ao carrinho
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_SESSION['carrinho'][$idProduto])) {
    $_SESSION['carrinho'][$idProduto]['quantidade']++;
} else {
    $_SESSION['carrinho'][$idProduto] = [
        'id' => $idProduto,
        'quantidade' => 1
    ];
}

echo json_encode([
    'sucesso' => true,
    'mensagem' => 'Produto adicionado ao carrinho com sucesso.',
    'nome' => $produto['nome']
]);
