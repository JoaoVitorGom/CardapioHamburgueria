<?php
    // Início do bloco PHP para processamento do formulário de cadastro
    require('../conexao_bd_login.php');

    // Verificação adicional para garantir que a conexão foi estabelecida corretamente
    if (!isset($conn)) {
        die("Falha ao conectar ao banco de dados.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recebe os dados do formulário
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $data = $_POST['data'];
        $nivel_permissao = $_POST['nivel_permissao'];

        // Verificar se a senha atende aos requisitos mínimos
        if (strlen($password) < 8 || !preg_match('/[0-9]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            // Se a senha não atender aos requisitos, exibe mensagem de erro e interrompe o script
            die("A senha deve ter pelo menos 8 caracteres, conter pelo menos um dígito numérico, uma letra maiúscula e um caractere especial (!@#$%^&*(),.?\":{}|<>).");
        }

        // Hash da senha antes de inserir no banco de dados
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepara a consulta SQL para inserir o novo usuário
        $sql = "INSERT INTO usuario (nome, password, email, data_nascimento) VALUES (:nome, :password, :email, :data_nascimento)";
        $stmt = $conn->prepare($sql);

        // Verificação de depuração para a preparação da consulta
        if (!$stmt) {
            die("Falha na preparação da consulta: " . implode(" ", $conn->errorInfo()));
        }

        $stmt->bindParam(':nome', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':data_nascimento', $data);

        // Executa a consulta
        if ($stmt->execute()) {
            // Se a consulta for bem-sucedida, redireciona para página de sucesso com o username
            header("Location: ../View/cadastroBemSucedido.php?username=" . urlencode($username));
            exit();
        } else {
            // Mensagem de erro se a consulta falhar
            echo "Erro ao cadastrar o usuário: " . implode(" ", $stmt->errorInfo());
        }
    }
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Configurações gerais do documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Links para arquivos de estilos CSS -->
    <link rel="stylesheet" href="../../public/css/reset.css"> <!-- CSS reset para padronização de estilos -->
    <link rel="stylesheet" href="../../public/css/index.css"> <!-- Estilos gerais da aplicação -->
    <link rel="stylesheet" href="../../public/css/admin.css"> <!-- Estilos específicos para administração -->
    <link rel="stylesheet" href="../../public/css/form.css"> <!-- Estilos específicos para formulários -->
    
    <!-- Pré-conexão e carregamento de fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícone da página exibido na aba do navegador -->
    <link rel="icon" href="../../public/img/Pioneiro-Photoroom.png" type="image/x-icon">
    
    <!-- Título da página exibido na aba do navegador -->
    <title>Kingdom of Burguer - Cadastrar Administrador</title>
</head>
<body>
    <!-- Início da seção principal da página -->
    <section class="container-admin-banner">
        <!-- Banner de administração com logo -->
        <img src="../../public/img/Pioneiro-Photoroom.png" class="logo-admin" alt="logo-serenatto">
        <!-- Título principal da página -->
        <h1>Cadastro de Administradores</h1>
    </section>
    
    <!-- Início do formulário de cadastro de administradores -->
    <section class="container-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Campo para inserção do nome completo do administrador -->
            <label for="username">Nome Completo:</label>
            <input type="text" id="username" name="username" required>
            <br>
            
            <!-- Campo para inserção do e-mail do administrador -->
            <label for="email">Nome de Usuário (e-mail):</label>
            <input type="email" id="email" name="email" required>
            <br>
            
            <!-- Campo para inserção da senha do administrador -->
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <br>
            
            <!-- Campo para inserção da data de nascimento do administrador -->
            <label for="data">Data de Nascimento:</label>
            <input type="date" name="data" id="data" required>
            <br>
            <div class="container-radio">
                <div>
                    <label for="burguers">COMUM</label>
                    <input type="radio" id="comum" name="tipo" value="COMUM" checked> <!-- Opção de tipo de produto -->
                </div>
                <div>
                    <label for="batatas">INTERMEDIÁRIO</label>
                    <input type="radio" id="intermediário" name="tipo" value="INTERMEDIÁRIO"> <!-- Opção de tipo de produto -->
                </div>
                <div>
                    <label for="sobremesas">AVANÇADO</label>
                    <input type="radio" id="avançado" name="tipo" value="AVANÇADO"> <!-- Opção de tipo de produto -->
                </div>
            </div>
            <!-- Botão de submissão do formulário de cadastro -->
            <input type="submit" class="botao-cadastrar" value="Cadastrar">
            <br>
            
            <!-- Botão para redirecionamento à página principal do admin -->
            <input type="button" class="botao-cadastrar" value="Página do Admin" onclick="window.location.href='../View/pagina-funcoes.php'">
            <br>
            
            <!-- Botão para logout do administrador -->
            <input type="button" class="botao-cadastrar" value="Logout" onclick="window.location.href='logout.php'">
            <br>
        </form>
    </section>
</body>
</html>
