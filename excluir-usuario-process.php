
require('src/conexao_bd_login.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    // Verifica se o ID do usuário foi fornecido
    if (empty($user_id)) {
        die("Nenhum usuário selecionado.");
    }

    try {
        // Prepara a consulta SQL para excluir o usuário
        $stmt = $conn->prepare("DELETE FROM usuario WHERE id = ?");
        $stmt->execute([$user_id]);

        if ($stmt->rowCount() > 0) {
            echo "Usuário excluído com sucesso!";
        } else {
            echo "Erro: Usuário não encontrado.";
        }
    } catch (PDOException $e) {
        die("Erro ao excluir usuário: " . $e->getMessage());
    }

    // Redireciona de volta para o formulário de exclusão
    header("Location: excluir-usuario-form.php");
    exit();
} else {
    die("Método de solicitação inválido.");
}

