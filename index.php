<?php
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

function getProducts($pdoConnection) {
    $stmt = $pdoConnection->query("SELECT * FROM produtos");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$pdoConnection = require "src/conexao-bd-cc.php";
$produtosRepositorio = new ProdutoRepositorio($pdoConnection);
$dadosBurgers = $produtosRepositorio->opcoesBurgers();
$dadosBatatas = $produtosRepositorio->opcoesBatatas();
$dadosSobremesas = $produtosRepositorio->opcoesSobremesas();
$dadosBebidas = $produtosRepositorio->opcoesBebidas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" href="img/Pioneiro-Photoroom.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>X-Burguer - Cardápio</title>
   <!-- Adicione o link para o Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .carrinho-container {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }
        .carrinho-container i {
            font-size: 120px; /* Tripliquei o tamanho do ícone */
            color: #e74c3c; /* Cor vermelha */
        }
        .carrinho-contador {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #c0392b; /* Cor de fundo do contador (vermelho escuro) */
            color: #fff; /* Cor do texto do contador */
            border-radius: 50%;
            padding: 10px 15px; /* Aumentei o padding para combinar com o tamanho maior do ícone */
            font-size: 24px; /* Tamanho do texto do contador */
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Adiciona uma sombra mais visível */
        }
        .mensagem-carrinho {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #28a745; /* Cor verde para a mensagem de sucesso */
            color: #fff; /* Cor do texto */
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra leve para destaque */
            font-size: 16px;
            font-weight: bold;
            z-index: 1000;
        }
    </style>
</head>
<body>
<main>
    <!-- Adicionando o ícone do carrinho de compras com contador -->
    <div class="carrinho-container">
        <a href="carrinho.php">
            <i class="fas fa-shopping-cart"></i>
            <div id="carrinho-contador" class="carrinho-contador">0</div>
        </a>
    </div>
    <section class="container-banner">
        <div class="container-texto-banner">
            <img src="img/Pioneiro-Photoroom.png" class="logo" alt="logo-serenatto">
        </div>
    </section>
    <h2>Cardápio Digital</h2>

    <!-- Seção de Burgers -->
    <section class="container-cafe-manha">
        <div class="container-cafe-manha-titulo">
            <h3>Burgers</h3>
        </div>
        <div class="container-cafe-manha-produtos">
            <?php foreach ($dadosBurgers as $burger): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $burger->getImagemDiretorio() ?>">
                    </div>
                    <p><?= $burger->getNome() ?></p>
                    <p><?= $burger->getDescricao() ?></p>
                    <p><?= $burger->getPrecoFormatado() ?></p>
                    <form class="adicionar-carrinho" data-id="<?= $burger->getId() ?>" data-nome="<?= htmlspecialchars($burger->getNome(), ENT_QUOTES) ?>">
                        <input type="hidden" name="acao" value="add">
                        <input type="hidden" name="id" value="<?= $burger->getId() ?>">
                        <input type="submit" class="botao-cadastrar" value="Adicionar ao Carrinho">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Seção de Batatas -->
    <section class="container-cafe-manha">
        <div class="container-cafe-manha-titulo">
            <h3>Batatas</h3>
        </div>
        <div class="container-cafe-manha-produtos">
            <?php foreach ($dadosBatatas as $batata): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $batata->getImagemDiretorio() ?>">
                    </div>
                    <p><?= $batata->getNome() ?></p>
                    <p><?= $batata->getDescricao() ?></p>
                    <p><?= $batata->getPrecoFormatado() ?></p>
                    <form class="adicionar-carrinho" data-id="<?= $batata->getId() ?>" data-nome="<?= htmlspecialchars($batata->getNome(), ENT_QUOTES) ?>">
                        <input type="hidden" name="acao" value="add">
                        <input type="hidden" name="id" value="<?= $batata->getId() ?>">
                        <input type="submit" class="botao-cadastrar" value="Adicionar ao Carrinho">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Seção de Sobremesas -->
    <section class="container-cafe-manha">
        <div class="container-cafe-manha-titulo">
            <h3>Sobremesas</h3>
        </div>
        <div class="container-cafe-manha-produtos">
            <?php foreach ($dadosSobremesas as $sobremesa): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $sobremesa->getImagemDiretorio() ?>">
                    </div>
                    <p><?= $sobremesa->getNome() ?></p>
                    <p><?= $sobremesa->getDescricao() ?></p>
                    <p><?= $sobremesa->getPrecoFormatado() ?></p>
                    <form class="adicionar-carrinho" data-id="<?= $sobremesa->getId() ?>" data-nome="<?= htmlspecialchars($sobremesa->getNome(), ENT_QUOTES) ?>">
                        <input type="hidden" name="acao" value="add">
                        <input type="hidden" name="id" value="<?= $sobremesa->getId() ?>">
                        <input type="submit" class="botao-cadastrar" value="Adicionar ao Carrinho">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Seção de Bebidas -->
    <section class="container-cafe-manha">
        <div class="container-cafe-manha-titulo">
            <h3>Bebidas</h3>
        </div>
        <div class="container-cafe-manha-produtos">
            <?php foreach ($dadosBebidas as $bebida): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $bebida->getImagemDiretorio() ?>">
                    </div>
                    <p><?= $bebida->getNome() ?></p>
                    <p><?= $bebida->getDescricao() ?></p>
                    <p><?= $bebida->getPrecoFormatado() ?></p>
                    <form class="adicionar-carrinho" data-id="<?= $bebida->getId() ?>" data-nome="<?= htmlspecialchars($bebida->getNome(), ENT_QUOTES) ?>">
                        <input type="hidden" name="acao" value="add">
                        <input type="hidden" name="id" value="<?= $bebida->getId() ?>">
                        <input type="submit" class="botao-cadastrar" value="Adicionar ao Carrinho">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Seção do Carrinho de Compras -->
    <section class="container-admin-banner">
        <form action="gerador-pdf.php" method="post">
            <input type="submit" class="botao-cadastrar" value="Baixar Cardápio PDF"/>
        </form>
        <input type="button" class="botao-cadastrar" value="Login Como Admin" onclick="window.location.href='login.php'">
        <br>
    </section>
</main>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Função para atualizar o contador de itens no carrinho
    function atualizarContadorCarrinho() {
        fetch('atualizar-carrinho.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('carrinho-contador').textContent = data.numeroDeItens;
            })
            .catch(error => console.error('Erro ao atualizar o contador do carrinho:', error));
    }

    // Atualiza o contador quando a página é carregada
    atualizarContadorCarrinho();

    // Adiciona um ouvinte de eventos para todos os formulários de adicionar ao carrinho
    document.querySelectorAll('.adicionar-carrinho').forEach(form => {
        form.addEventListener('submit', event => {
            event.preventDefault();  // Impede o envio padrão do formulário
            const id = form.getAttribute('data-id');
            const nome = form.getAttribute('data-nome');

            fetch('adicionar-ao-carrinho.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    acao: 'add',
                    id: id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                    atualizarContadorCarrinho();
                    // Mostra uma mensagem de sucesso com o nome do produto
                    const mensagem = `Produto "${nome}" adicionado ao carrinho!`;
                    const mensagemDiv = document.createElement('div');
                    mensagemDiv.className = 'mensagem-carrinho';
                    mensagemDiv.textContent = mensagem;
                    document.body.appendChild(mensagemDiv);

                    // Remove a mensagem após 3 segundos
                    setTimeout(() => {
                        mensagemDiv.remove();
                    }, 3000);
                } else {
                    console.error(data.mensagem);
                }
            })
            .catch(error => console.error('Erro ao adicionar ao carrinho:', error));
        });
    });
});
</script>

</body>
</html>
