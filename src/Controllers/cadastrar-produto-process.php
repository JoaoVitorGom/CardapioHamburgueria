<?php
// Inclui arquivos necessários
require "../conexao-bd.php";
require "../Modelo/Produto.php";
require "../Repositorio/ProdutoRepositorio.php";

// Verifica se o formulário foi submetido
if (isset($_POST['cadastro'])) {
    // Cria um novo objeto Produto com base nos dados recebidos
    $produto = new Produto(null,
        $_POST['tipo'],
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco']
    );

    // Verifica se foi enviada uma imagem e a move para o diretório correto
    if (isset($_FILES['imagem'])) {
        $produto->setImagem(uniqid() . $_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $produto->getImagemDiretorio());
    }

    // Cria uma instância do repositório de produtos usando a conexão PDO
    $produtoRepositorio = new ProdutoRepositorio($pdo);
    
    // Salva o produto no banco de dados
    $produtoRepositorio->salvar($produto);

    // Redireciona de volta para a página admin.php após o cadastro
    header("Location: admin.php");
    exit(); // Encerra o script após o redirecionamento
}
?>
    
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/reset.css"> <!-- Estilos de reset para garantir consistência -->
    <link rel="stylesheet" href="../../public/css/index.css"> <!-- Estilos específicos para a página index -->
    <link rel="stylesheet" href="../../public/css/admin.css"> <!-- Estilos para a área administrativa -->
    <link rel="stylesheet" href="../../public/css/form.css"> <!-- Estilos para formulários -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Pré-conexão para carregamento de fontes -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Pré-conexão para carregamento de fontes -->
    <link rel="icon" href="../../public/img/Pioneiro-Photoroom.png" type="image/x-icon"> <!-- Ícone da página -->
    <title>Kingdom of Burguer - Cadastrar Produto</title> <!-- Título da página -->
</head>
<body>
<main>
    <section class="container-admin-banner">
        <img src="../../public/img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto"> <!-- Logo da empresa -->
        <h1>Cadastro de Produtos</h1> <!-- Título principal da página -->
    </section>
    <section class="container-form">
        <form method="post" enctype="multipart/form-data">

            <label for="nome">Nome</label>
            <input name="nome" type="text" id="nome" placeholder="Digite o nome do produto" required> <!-- Campo de entrada para o nome do produto -->

            <div class="container-radio">
                <div>
                    <label for="burguers">Burguer</label>
                    <input type="radio" id="burguers" name="tipo" value="BURGER" checked> <!-- Opção de tipo de produto -->
                </div>
                <div>
                    <label for="batatas">Batata</label>
                    <input type="radio" id="batatas" name="tipo" value="BATATA"> <!-- Opção de tipo de produto -->
                </div>
                <div>
                    <label for="sobremesas">Sobremesa</label>
                    <input type="radio" id="sobremesas" name="tipo" value="SOBREMESA"> <!-- Opção de tipo de produto -->
                </div>
                <div>
                    <label for="bebidas">Bebida</label>
                    <input type="radio" id="bebidas" name="tipo" value="BEBIDA"> <!-- Opção de tipo de produto -->
                </div>
            </div>

            <label for="descricao">Descrição</label>
            <input name="descricao" type="text" id="descricao" placeholder="Digite uma descrição" required> <!-- Campo de entrada para a descrição do produto -->

            <label for="preco">Preço</label>
            <input name="preco" type="text" id="preco" placeholder="Digite o preço" required> <!-- Campo de entrada para o preço do produto -->

            <label for="imagem">Envie uma imagem do produto</label>
            <input type="file" name="imagem" accept="image/*" id="imagem" placeholder="Envie uma imagem"> <!-- Campo de upload para a imagem do produto -->

            <input name="cadastro" type="submit" class="botao-cadastrar" value="Cadastrar produto"/> <!-- Botão para enviar o formulário de cadastro -->

            <br>
        </form>
    
    </section>
</main>

<!-- Scripts adicionais -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script> <!-- jQuery para funcionalidades JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> <!-- Plugin para formatação de dinheiro -->
<script src="../../public/js/script.js"></script> <!-- Script personalizado -->
</body>
</html>
