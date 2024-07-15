<?php 
// Inclui os arquivos necessários
require "../Controllers/buscar-produtos.php";
require "../Controllers/operacoes-carrinho.php";
require "../conexao-bd.php";

// Obtém os detalhes dos produtos no carrinho e o total
$resultsCarts = getContentCart($pdo); // Função para obter os produtos no carrinho
$totalCarts  = getTotalCart($pdo); // Função para calcular o total do carrinho
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kingdom of Burguer - Compra Realizada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../public/css/reset.css">
    <link rel="stylesheet" href="../../public/css/index.css">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="../../public/css/form.css">
    <link rel="icon" href="../../public/img/Pioneiro-Photoroom.png" type="image/x-icon">

   
</head>
<body>
    <div class="container">
        <section class="container-admin-banner">
            <img src="../../public/img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
            <h1>Compra Realizada Com Sucesso</h1>
            <br>
            <h2>Detalhes do Pedido</h2>
            <br>
        </section>

        <?php if($resultsCarts) : ?>
            <!-- Se houver produtos no carrinho, exibe a tabela -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultsCarts as $result) : ?>
                        <!-- Loop pelos produtos no carrinho -->
                        <tr>
                            <td><?php echo htmlspecialchars($result['name']) ?></td>
                            <td><?php echo htmlspecialchars($result['quantity']) ?></td>
                            <td>R$<?php echo number_format($result['price'], 2, ',', '.') ?></td>
                            <td>R$<?php echo number_format($result['subtotal'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"></td>
                        <td>R$<?php echo number_format($totalCarts, 2, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <!-- Se o carrinho estiver vazio, exibe mensagem de alerta -->
            <div class="alert alert-warning" role="alert">
                O carrinho está vazio.
            </div>
        <?php endif; ?>
    </div>

    <section class="container-admin-banner">
        <!-- Botão para retornar à página inicial -->
        <input type="button" class="botao-cadastrar" value="Página Inicial" onclick="window.location.href='../Controllers/logout.php'">
        <br>
    </section>
</body>
</html>
