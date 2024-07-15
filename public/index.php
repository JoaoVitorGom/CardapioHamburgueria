<?php
// Inclui os arquivos necessários para a conexão com o banco de dados e outras classes relevantes
require "../src/conexao-bd.php";
require "../src/Modelo/Produto.php";
require "../src/Repositorio/ProdutoRepositorio.php";

// Função para obter todos os produtos do banco de dados através da conexão PDO fornecida
function getProducts($pdoConnection) {
    $stmt = $pdoConnection->query("SELECT * FROM produtos");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Instância um objeto ProdutoRepositorio para acessar os métodos de consulta
$produtosRepositorio = new ProdutoRepositorio($pdo);

// Array associativo contendo as categorias de produtos e seus respectivos dados recuperados do banco de dados
$dadosCategorias = [
    'Burgers' => $produtosRepositorio->opcoesBurgers(),
    'Batatas' => $produtosRepositorio->opcoesBatatas(),
    'Sobremesas' => $produtosRepositorio->opcoesSobremesas(),
    'Bebidas' => $produtosRepositorio->opcoesBebidas(),
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inclusão de folhas de estilo -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <!-- Ícone da página -->
    <link rel="icon" href="/img/Pioneiro-Photoroom.png" type="image/x-icon">
    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Kingdom of Burger - Cardápio</title>
</head>
<body>
<main>
    <!-- Container do carrinho de compras -->
    <div class="carrinho-container">
        <a href="../src/Controllers/carrinho.php">
            <i class="fas fa-shopping-cart"></i>
            <!-- Contador do carrinho, inicialmente zero -->
            <div id="carrinho-contador" class="carrinho-contador">0</div>
        </a>
    </div>
    <!-- Banner da empresa -->
    <section class="container-banner">
        <div class="container-texto-banner">
            <img src="img/Pioneiro-Photoroom.png" class="logo" alt="logo-serenatto">
        </div>
    </section>
    <h2>Cardápio Digital</h2>

    <!-- Loop através das categorias de produtos -->
    <?php foreach ($dadosCategorias as $categoria => $produtos): ?>
        <section class="container-hamburgueria">
            <div class="container-hamburgueria-titulo">
                <!-- Título da categoria atual -->
                <h3><?= $categoria ?></h3>
            </div>
            <div class="container-hamburgueria-produtos">
                <!-- Loop através dos produtos da categoria -->
                <?php foreach ($produtos as $produto): ?>
                    <div class="container-produto">
                        <div class="container-foto">
                            <!-- Imagem do produto -->
                            <img src="<?= $produto->getImagemDiretorio() ?>">
                        </div>
                        <p><?= $produto->getNome() ?></p>
                        <p><?= $produto->getDescricao() ?></p>
                        <p><?= $produto->getPrecoFormatado() ?></p>
                        <!-- Formulário para adicionar o produto ao carrinho -->
                        <form class="adicionar-carrinho" data-id="<?= $produto->getId() ?>" data-nome="<?= htmlspecialchars($produto->getNome(), ENT_QUOTES) ?>">
                            <input type="hidden" name="acao" value="add">
                            <input type="hidden" name="id" value="<?= $produto->getId() ?>">
                            <input type="submit" class="botao-cadastrar" value="Adicionar ao Carrinho">
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>

    <!-- Seção para administradores -->
    <section class="container-admin-banner">
        <!-- Formulário para gerar um PDF do cardápio -->
        <form action="../../gerador-pdf.php" method="post">
            <input type="submit" class="botao-cadastrar" value="Baixar Cardápio PDF"/>
        </form>
        <!-- Botão para login como administrador -->
        <input type="button" class="botao-cadastrar" value="Login Como Admin" onclick="window.location.href='../src/Controllers/login.php'">
        <br>
        <br>
    </section>
</main>

<!-- Inclusão do script JavaScript -->
<script src="./js/script.js"></script>

</body>
</html>
