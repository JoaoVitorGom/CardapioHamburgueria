<?php 
require "buscar-produtos.php";
require "operacoes-carrinho.php";

$pdoConnection = require "src/conexao-bd-cc.php";

if (isset($_GET['acao']) && in_array($_GET['acao'], array('add', 'del', 'up'))) {
    if ($_GET['acao'] == 'add' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) {
        addCart($_GET['id'], 1);
    }

    if ($_GET['acao'] == 'del' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) {
        deleteCart($_GET['id']);
    }

    if ($_GET['acao'] == 'up') {
        if (isset($_POST['prod']) && is_array($_POST['prod'])) {
            foreach ($_POST['prod'] as $id => $qtd) {
                updateCart($id, $qtd);
            }
        }
    }
    header('location: carrinho.php');
}

$resultsCarts = getContentCart($pdoConnection);
$totalCarts = getTotalCart($pdoConnection);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="icon" href="img/Pioneiro-Photoroom.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <title>Kingdom of Burguer - Carrinho de Compras</title>
    <script>
        function updateCart(id) {
            const quantity = document.getElementById('quantity-' + id).value;
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "carrinho.php?acao=up", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload(); // Atualiza a página após a resposta
                }
            };
            xhr.send("prod[" + id + "]=" + quantity);
        }
    </script>
    <style>
        .container-table {
            display: flex;
            justify-content: center; /* Center the table */
        }
        .table {
            width: auto; /* Table adjusts based on content */
            margin: 20px; /* Add some margin */
        }
    </style>
</head>
<body>
<main>
    <section class="container-admin-banner">
        <img src="img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
        <h1>Carrinho De Compras</h1>
        <br>
        <h2>Tabela De Pedidos</h2>
        <br>
    </section>
    <?php if ($resultsCarts): ?>
        <section class="container-form">
            <form action="carrinho.php?acao=up" method="post">
                <section class="container-table">
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
                            <tr>
                                <td><?php echo $result['name'] ?></td>
                                <td>
                                    <input type="text" id="quantity-<?php echo $result['id'] ?>" 
                                           name="prod[<?php echo $result['id'] ?>]" 
                                           value="<?php echo $result['quantity'] ?>" 
                                           size="1" 
                                           onchange="updateCart(<?php echo $result['id'] ?>)" />
                                </td>
                                <td>R$ <?php echo number_format($result['price'], 2, ',', '.') ?></td>
                                <td>R$ <?php echo number_format($result['subtotal'], 2, ',', '.') ?></td>
                                <td>
                                    <a href="carrinho.php?acao=del&id=<?php echo $result['id'] ?>" 
                                       class="btn btn-danger">Remover</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
		<section class="container-admin-banner">
                <input type="button" class="botao-cadastrar" value="Continuar Comprando" onclick="window.location.href='index.php'">
                <br>
                <input type="button" class="botao-cadastrar" value="Finalizar Compra" onclick="window.location.href='compra-finalizada.php'">
				<br>
				<br>
            </section>
    <?php else: ?>
        <section class="container-admin-banner">
            <h2>Seu carrinho está vazio!</h2>
            <input type="button" class="botao-cadastrar" value="Começar a Comprar" onclick="window.location.href='index.php'">
            <br>
            <br>
        </section>
    <?php endif; ?>
</main>
</body>
</html>
