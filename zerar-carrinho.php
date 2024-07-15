<?php
session_start();

// Remove todos os itens do carrinho
unset($_SESSION['carrinho']);



echo 'Carrinho limpo com sucesso.';
