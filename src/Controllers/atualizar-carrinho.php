<?php
// Inicia a sessão para acessar as variáveis de sessão
session_start();

// Função para contar a quantidade total de itens no carrinho
function contarItensCarrinho() {
    $quantidadeTotal = 0;
    // Verifica se a variável de sessão 'carrinho' está definida e não vazia
    if (isset($_SESSION['carrinho'])) {
        // Percorre cada produto no carrinho
        foreach ($_SESSION['carrinho'] as $produto) {
            // Soma a quantidade de cada produto à quantidade total
            $quantidadeTotal += $produto['quantidade'];
        }
    }
    // Retorna o total de itens no carrinho
    return $quantidadeTotal;
}

// Retorna o resultado em formato JSON para ser consumido por outras partes da aplicação
echo json_encode(['numeroDeItens' => contarItensCarrinho()]);
