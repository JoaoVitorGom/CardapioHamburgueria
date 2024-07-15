<?php
session_start();

function contarItensCarrinho() {
    $quantidadeTotal = 0;
    if (isset($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $produto) {
            $quantidadeTotal += $produto['quantidade'];
        }
    }
    return $quantidadeTotal;
}

echo json_encode(['numeroDeItens' => contarItensCarrinho()]);
