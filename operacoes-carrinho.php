<?php
session_start();

if(!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

function addCart($id, $quantity, $productName, $productPrice) {
    if(!isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id] = [
            'quantidade' => $quantity,
            'nome' => $productName,
            'preco' => $productPrice
        ];
    } else {
        $_SESSION['carrinho'][$id]['quantidade'] += $quantity;
    }
}

function deleteCart($id) {
    if(isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
    }
}

function updateCart($id, $quantity) {
    if(isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['quantidade'] = $quantity;
        if($quantity <= 0) {
            deleteCart($id);
        }
    }
}

function getContentCart($pdo) {
    $cart = $_SESSION['carrinho'] ?? [];
    $results = [];
    foreach ($cart as $productId => $product) {
        // Verifica se $product é um array antes de tentar acessar seus elementos
        if(is_array($product)) {
            $stmt = $pdo->prepare('SELECT nome, preco FROM produtos WHERE id = ?');
            $stmt->execute([$productId]);
            $productData = $stmt->fetch(PDO::FETCH_ASSOC);

            if($productData) {
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
                // dependendo dos requisitos do seu aplicativo.
            }
        } else {
            // Lidar com o caso em que $product não é um array
            // Aqui você pode adicionar algum tratamento de erro ou ignorar o produto
            // dependendo dos requisitos do seu aplicativo.
        }
    }

    return $results;
}

function getTotalCart($pdo) {
    $total = 0;

    foreach(getContentCart($pdo) as $product) {
        $total += $product['subtotal'];
    }

    return $total;
}
?>
