<?php
require "buscar-produtos.php";
require "operacoes-carrinho.php";
require "../conexao-bd.php";
// Verifica se há uma ação válida na URL (add, del, up)
if (isset($_GET['acao']) && in_array($_GET['acao'], ['add', 'del', 'up'])) {
    // Se a ação for adicionar e o ID do produto for numérico
    if ($_GET['acao'] == 'add' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) {
        addCart($_GET['id'], 1); // Chama a função para adicionar 1 unidade do produto ao carrinho
    }

    // Se a ação for remover e o ID do produto for numérico
    if ($_GET['acao'] == 'del' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) {
        deleteCart($_GET['id']); // Chama a função para remover o produto do carrinho
    }

    // Se a ação for atualizar e os dados do produto estiverem no formato esperado
    if ($_GET['acao'] == 'up') {
        if (isset($_POST['prod']) && is_array($_POST['prod'])) {
            foreach ($_POST['prod'] as $id => $qtd) {
                // Atualiza a quantidade do produto no carrinho
                if (preg_match("/^[0-9]+$/", $id) && preg_match("/^[0-9]+$/", $qtd)) {
                    updateCart($id, $qtd);
                }
            }
        }
    }

    header('Location: carrinho.php'); // Redireciona para a página do carrinho após a ação
    exit; // Encerra o script após o redirecionamento
}

// Obtém os produtos no carrinho e o total
$resultsCarts = getContentCart($pdo); // Obtém os detalhes dos produtos no carrinho
$totalCarts = getTotalCart($pdo); // Calcula o total do valor dos produtos no carrinho
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kingdom of Burguer - Carrinho de Compras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../public/css/reset.css">
    <link rel="stylesheet" href="../../public/css/index.css">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="../../public/css/form.css">
    <link rel="icon" href="../../public/img/Pioneiro-Photoroom.png" type="image/x-icon">

</head>
<body>
<main>
    <section class="container-admin-banner">
        <img src="../../public/img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
        <h1>Carrinho De Compras</h1>
        <br>
        <h2>Tabela De Pedidos</h2>
        <br>
    </section>

    <?php if ($resultsCarts): ?>
        <!-- Se houver produtos no carrinho, exibe a tabela de pedidos -->
        <section class="container-form">
            <form action="carrinho.php?acao=up" method="post">
                <section class="container-table-carrinho">
                    <table class="table table-strip">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                                <th>Total</th>
                                <th>Ação</th>
                            </tr>				
                        </thead>
                        <tbody>
                            <?php foreach ($resultsCarts as $result): ?>
                                <!-- Loop pelos produtos no carrinho -->
                                <tr>
                                    <td><?php echo htmlspecialchars($result['name']) ?></td>
                                    <td>
                                        <!-- Campo de entrada para a quantidade do produto -->
                                        <input type="number" id="quantity-<?php echo $result['id'] ?>" 
                                               name="prod[<?php echo $result['id'] ?>]" 
                                               value="<?php echo htmlspecialchars($result['quantity']) ?>" 
                                               min="1" 
                                               onchange="updateCart(<?php echo $result['id'] ?>)" />
                                    </td>
                                    <td>R$ <?php echo number_format($result['price'], 2, ',', '.') ?></td>
                                    <td>R$ <?php echo number_format($result['subtotal'], 2, ',', '.') ?></td>
                                    <td>
                                        <!-- Link para remover o produto do carrinho -->
                                        <a href="carrinho.php?acao=del&id=<?php echo $result['id'] ?>" 
                                           class="btn btn-danger">Remover</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <!-- Linha para exibir o total do carrinho -->
                            <tr>
                                <td colspan="3" class="text-right"></td>
                                <td>R$ <?php echo number_format($totalCarts, 2, ',', '.') ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </form>
        </section>
        <!-- Botões para continuar comprando ou finalizar compra -->
        <section class="container-admin-banner">
            <input type="button" class="botao-cadastrar" value="Continuar Comprando" onclick="window.location.href='../../public/index.php'">
            <br>
            <input type="button" class="botao-cadastrar" value="Finalizar Compra" onclick="window.location.href='../View/compra-finalizada.php'">
            <br>
            <br>
        </section>
    <?php else: ?>
        <!-- Se o carrinho estiver vazio, exibe mensagem para começar a comprar -->
        <section class="container-admin-banner">
            <h2>Seu carrinho está vazio!</h2>
            <input type="button" class="botao-cadastrar" value="Começar a Comprar" onclick="window.location.href='../../public/index.php'">
            <br>
            <br>
        </section>
    <?php endif; ?>


</main>

<script src="../../public/js/script.js"></script>
</body>
</html>
