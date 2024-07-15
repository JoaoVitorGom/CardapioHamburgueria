<?php
// Inclui os arquivos necessários: conexão com o banco de dados, classe Produto e Repositório ProdutoRepositorio
require "../conexao-bd.php";
require "../Modelo/Produto.php";
require "../Repositorio/ProdutoRepositorio.php";

// Cria uma instância do Repositório de Produto, passando a conexão PDO como parâmetro
$produtoRepositorio = new ProdutoRepositorio($pdo);

if (isset($_POST['editar'])) {
    // Se o formulário foi submetido para edição de produto
    $produto = new Produto($_POST['id'], $_POST['tipo'], $_POST['nome'], $_POST['descricao'], $_POST['preco']);

    // Verifica se uma nova imagem foi enviada e a move para o diretório adequado
    if (isset($_FILES['imagem'])) {
        $produto->setImagem(uniqid() . $_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $produto->getImagemDiretorio());
    }

    // Atualiza o produto no banco de dados através do ProdutoRepositorio
    $produtoRepositorio->atualizar($produto);

    // Redireciona para a página admin.php após a edição
    header("Location: admin.php");
    exit(); // Encerra o script após o redirecionamento
} else {
    // Se não houver dados submetidos para edição, busca o produto com base no ID enviado via GET
    $produto = $produtoRepositorio->buscar($_GET['id']);
}
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../public/css/reset.css">
  <link rel="stylesheet" href="../../public/css/index.css">
  <link rel="stylesheet" href="../../public/css/admin.css">
  <link rel="stylesheet" href="../../public/css/form.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="../../public/img/Pioneiro-Photoroom.png" type="image/x-icon">
 
  <title>Kingdom of Burguer - Editar Produto</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="../../public/img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
    <h1>Editar Produto</h1>
  </section>
  <section class="container-form">
    <form method="post" enctype="multipart/form-data">

      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" value="<?= $produto->getNome()?>" required>

      <!-- Radios para seleção do tipo de produto -->
      <div class="container-radio">
        <div>
            <label for="burguers">Burguer</label>
            <input type="radio" id="burgers" name="tipo" value="BURGER" <?= $produto->getTipo() == "Burgers" ? "checked" : "" ?>>
        </div>
        <div>
            <label for="batatas">Batata</label>
            <input type="radio" id="batatas" name="tipo" value="BATATA" <?= $produto->getTipo() == "Batatas" ? "checked" : "" ?>>
        </div>
        <div>
            <label for="sobremesas">Sobremesa</label>
            <input type="radio" id="sobremesas" name="tipo" value="SOBREMESA" <?= $produto->getTipo() == "Sobremesas" ? "checked" : "" ?>>
        </div>
        <div>
            <label for="bebidas">Bebida</label>
            <input type="radio" id="bebidas" name="tipo" value="BEBIDA" <?= $produto->getTipo() == "Bebidas" ? "checked" : "" ?>>
        </div>
      </div>

      <label for="descricao">Descrição</label>
      <input type="text" name="descricao" id="descricao" value="<?= $produto->getDescricao()?>" placeholder="Digite uma descrição" required>

      <label for="preco">Preço</label>
      <input type="text" name="preco" id="preco" value="<?= number_format($produto->getPreco(),2)?>" placeholder="Digite uma descrição" required>

      <!-- Input para envio de nova imagem do produto -->
      <label for="imagem">Envie uma imagem do produto</label>
      <input type="file" name="imagem" accept="image/*" id="imagem" placeholder="Envie uma imagem">

      <!-- Campo hidden para enviar o ID do produto -->
      <input type="hidden" name="id" value="<?= $produto->getId()?>">

      <!-- Botão para submeter o formulário de edição -->
      <input type="submit" name="editar" class="botao-cadastrar" value="Editar produto"/>
    </form>
  </section>
</main>

<!-- Scripts JavaScript necessários -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../../public/js/script.js"></script>
</body>
</html>
