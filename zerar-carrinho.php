<?php
session_start();

// Remove todos os itens do carrinho
unset($_SESSION['carrinho']);

// Opcional: Se desejar definir uma mensagem ou outro comportamento, adicione aqui

echo 'Carrinho limpo com sucesso.';
