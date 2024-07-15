<?php

// Função para obter todos os produtos
function getProducts($pdo){
	$sql = "SELECT * FROM produtos"; // Consulta SQL para selecionar todos os produtos
	$stmt = $pdo->prepare($sql); // Prepara a consulta SQL
	$stmt->execute(); // Executa a consulta
	return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os produtos como um array associativo
}

// Função para obter produtos por IDs específicos
function getProductsByIds($pdo, $ids) {
	$sql = "SELECT * FROM produtos WHERE id IN (".$ids.")"; // Consulta SQL para selecionar produtos com IDs específicos
	$stmt = $pdo->prepare($sql); // Prepara a consulta SQL
	$stmt->execute(); // Executa a consulta
	return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna os produtos encontrados como um array associativo
}

?>

