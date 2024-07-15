<?php
session_start();

// Verifica se a sessão 'carrinho' não está inicializada e a inicializa como um array vazio
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

// Função para adicionar um produto ao carrinho
function addCart($id, $quantity, $productName, $productPrice) {
    // Se o produto não estiver no carrinho, adiciona-o; caso contrário, incrementa a quantidade
    if (!isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id] = [
            'quantidade' => $quantity,
            'nome' => $productName,
            'preco' => $productPrice
        ];
    } else {
        $_SESSION['carrinho'][$id]['quantidade'] += $quantity;
    }
}

// Função para excluir um produto do carrinho
function deleteCart($id) {
    // Verifica se o produto está no carrinho e o remove se estiver
    if (isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
    }
}

// Função para atualizar a quantidade de um produto no carrinho
function updateCart($id, $quantity) {
    // Verifica se o produto está no carrinho e atualiza a quantidade;
    // se a quantidade for <= 0, remove o produto do carrinho
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['quantidade'] = $quantity;
        if ($quantity <= 0) {
            deleteCart($id);
        }
    }
}

// Função para obter o conteúdo detalhado do carrinho com informações de produtos do banco de dados
function getContentCart($pdo) {
    $cart = $_SESSION['carrinho'] ?? [];
    $results = [];

    foreach ($cart as $productId => $product) {
        // Verifica se $product é um array antes de tentar acessar seus elementos
        if (is_array($product)) {
            // Prepara e executa uma consulta SQL para obter os detalhes do produto pelo ID
            $stmt = $pdo->prepare('SELECT nome, preco FROM produtos WHERE id = ?');
            $stmt->execute([$productId]);
            $productData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($productData) {
                // Calcula o subtotal e adiciona os detalhes do produto aos resultados
                $results[] = [
                    'id' => $productId,
                    'name' => $productData['nome'],
                    'price' => $productData['preco'],
                    'quantity' => $product['quantidade'],
                    'subtotal' => $product['quantidade'] * $productData['preco']
                ];
            } else {
                // Lidar com o caso em que o produto não é encontrado no banco de dados
                // Aqui você pode adicionar algum tratamento de erro ou ignorar o produto
            }
        } else {
            // Lidar com o caso em que $product não é um array válido
            // Aqui você pode adicionar algum tratamento de erro ou ignorar o produto
        }
    }

    return $results;
}

// Função para obter o total do carrinho somando os subtotais de todos os produtos
function getTotalCart($pdo) {
    $total = 0;

    // Itera sobre os produtos no carrinho e soma os subtotais
    foreach (getContentCart($pdo) as $product) {
        $total += $product['subtotal'];
    }

    return $total;
}


