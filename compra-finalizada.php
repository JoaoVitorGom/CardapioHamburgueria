<?php 
    require "buscar-produtos.php";
    require "operacoes-carrinho.php";

    $pdoConnection = require "src/conexao-bd-cc.php";

    $resultsCarts = getContentCart($pdoConnection);
    $totalCarts  = getTotalCart($pdoConnection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="icon" href="img/Pioneiro-Photoroom.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Kingdom of Burguer - Boas Vindas</title>
</head>
<body>
    <div class="container">
    <section class="container-admin-banner">
        <img src="img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
        <h1>Compra Realizada Com Sucesso </h1>
        <br>
        <h2>Detalhes do Pedido</h2>
        <br>
        </section>

        <?php if($resultsCarts) : ?>
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
                        <tr>
                            <td><?php echo htmlspecialchars($result['name']) ?></td>
                            <td><?php echo htmlspecialchars($result['quantity']) ?></td>
                            <td>R$<?php echo number_format($result['price'], 2, ',', '.') ?></td>
                            <td>R$<?php echo number_format($result['subtotal'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" ></td>
                        <td>R$<?php echo number_format($totalCarts, 2, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                O carrinho está vazio.
            </div>
        <?php endif; ?>
    </div>
      <section class="container-admin-banner">
        <input type="button" class="botao-cadastrar" value="Voltar ao Carrinho" onclick="window.location.href='carrinho.php'">
        <br>
        <input type="button" class="botao-cadastrar" value="Página Inicial" onclick="window.location.href='logout.php'">
        <br>
      </section>
</body>
</html>
