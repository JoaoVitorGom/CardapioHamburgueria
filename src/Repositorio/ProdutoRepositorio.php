<?php
// Classe responsável por interagir com o banco de dados para manipulação dos produtos
class ProdutoRepositorio
{
    private PDO $pdo; // Objeto PDO para realizar as operações no banco de dados

    /**
     * Construtor da classe que recebe uma conexão PDO como parâmetro
     * @param PDO $pdo Conexão PDO previamente estabelecida
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Método privado para formar um objeto Produto a partir dos dados do banco de dados
     * @param array $dados Array associativo contendo os dados do produto
     * @return Produto Objeto Produto formado com os dados fornecidos
     */
    private function formarObjeto($dados)
    {
        return new Produto(
            $dados['id'],
            $dados['tipo'],
            $dados['nome'],
            $dados['descricao'],
            $dados['preco'],
            $dados['imagem']
        );
    }

    /**
     * Retorna todas as opções de burgers disponíveis ordenadas por preço
     * @return array Array de objetos Produto representando os burgers disponíveis
     */
    public function opcoesBurgers(): array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'BURGER' ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Mapeia os resultados para objetos Produto usando a função formarObjeto
        return array_map(function ($produto) {
            return $this->formarObjeto($produto);
        }, $produtos);
    }

    /**
     * Retorna todas as opções de batatas disponíveis ordenadas por preço
     * @return array Array de objetos Produto representando as batatas disponíveis
     */
    public function opcoesBatatas(): array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'BATATA' ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Mapeia os resultados para objetos Produto usando a função formarObjeto
        return array_map(function ($produto) {
            return $this->formarObjeto($produto);
        }, $produtos);
    }

    /**
     * Retorna todas as opções de sobremesas disponíveis ordenadas por preço
     * @return array Array de objetos Produto representando as sobremesas disponíveis
     */
    public function opcoesSobremesas(): array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'SOBREMESA' ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Mapeia os resultados para objetos Produto usando a função formarObjeto
        return array_map(function ($produto) {
            return $this->formarObjeto($produto);
        }, $produtos);
    }

    /**
     * Retorna todas as opções de bebidas disponíveis ordenadas por preço
     * @return array Array de objetos Produto representando as bebidas disponíveis
     */
    public function opcoesBebidas(): array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'BEBIDA' ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Mapeia os resultados para objetos Produto usando a função formarObjeto
        return array_map(function ($produto) {
            return $this->formarObjeto($produto);
        }, $produtos);
    }

    /**
     * Retorna todos os produtos disponíveis ordenados por preço
     * @return array Array de objetos Produto representando todos os produtos disponíveis
     */
    public function buscarTodos()
    {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Mapeia os resultados para objetos Produto usando a função formarObjeto
        return array_map(function ($produto) {
            return $this->formarObjeto($produto);
        }, $produtos);
    }

    /**
     * Deleta um produto do banco de dados pelo seu ID
     * @param int $id ID do produto a ser deletado
     */
    public function deletar(int $id)
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
    }

    /**
     * Salva um novo produto no banco de dados
     * @param Produto $produto Objeto Produto a ser salvo
     */
    public function salvar(Produto $produto)
    {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getPreco());
        $statement->bindValue(5, $produto->getImagem());
        $statement->execute();
    }

    /**
     * Busca um produto no banco de dados pelo seu ID
     * @param int $id ID do produto a ser buscado
     * @return Produto Objeto Produto encontrado
     */
    public function buscar(int $id)
    {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        // Retorna um objeto Produto formado com os dados encontrados
        return $this->formarObjeto($dados);
    }

    /**
     * Atualiza os dados de um produto no banco de dados
     * @param Produto $produto Objeto Produto com os novos dados a serem atualizados
     */
    public function atualizar(Produto $produto)
    {
        $sql = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getPreco());
        $statement->bindValue(5, $produto->getImagem());
        $statement->bindValue(6, $produto->getId());
        $statement->execute();
    }
}
