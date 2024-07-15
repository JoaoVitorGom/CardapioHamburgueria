<?php
// Inicia a sessão para acessar e manipular as variáveis de sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
require_once "../conexao-bd.php";

// Recebe o ID do produto enviado via POST
$idProduto = $_POST['id'] ?? null;

// Verifica se o ID do produto é válido (não nulo e é um número)
if (!$idProduto || !is_numeric($idProduto)) {
    // Retorna uma mensagem de erro em JSON se o ID do produto for inválido
    echo json_encode(['sucesso' => false, 'mensagem' => 'ID do produto inválido.']);
    exit;
}

// Prepara e executa a consulta para obter as informações do produto do banco de dados
$stmt = $pdo->prepare('SELECT nome, preco FROM produtos WHERE id = ?');
$stmt->execute([$idProduto]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o produto foi encontrado no banco de dados
if (!$produto) {
    // Retorna uma mensagem de erro em JSON se o produto não foi encontrado
    echo json_encode(['sucesso' => false, 'mensagem' => 'Produto não encontrado.']);
    exit;
}

// Adiciona o produto ao carrinho de compras na sessão
if (!isset($_SESSION['carrinho'])) {
    // Se não houver nenhum carrinho na sessão, cria um array vazio para armazenar os produtos
    $_SESSION['carrinho'] = [];
}

if (isset($_SESSION['carrinho'][$idProduto])) {
    // Se o produto já estiver no carrinho, incrementa a quantidade
    $_SESSION['carrinho'][$idProduto]['quantidade']++;
} else {
    // Se o produto não estiver no carrinho, adiciona ele com quantidade inicial de 1
    $_SESSION['carrinho'][$idProduto] = [
        'id' => $idProduto,
        'quantidade' => 1
    ];
}

// Retorna uma resposta em JSON indicando sucesso e informações adicionais
echo json_encode([
    'sucesso' => true,
    'mensagem' => 'Produto adicionado ao carrinho com sucesso.',
    'nome' => $produto['nome']
]);