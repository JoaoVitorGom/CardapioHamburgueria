<?php

class ProdutoRepositorio
{
    private PDO $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados)
    {
        return new Produto($dados['id'],
            $dados['tipo'],
            $dados['nome'],
            $dados['descricao'],
            $dados['preco'],
            $dados['imagem']
        );
    }

    public function opcoesBurgers(): array
    {
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'BURGER' ORDER BY preco";
        $statement = $this->pdo->query($sql1);
        $produtosBurguers = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosBurguers = array_map(function ($burguer){
            return $this->formarObjeto($burguer);
        },$produtosBurguers);

        return $dadosBurguers;
    }
    public function opcoesBatatas(): array
    {
        $sql2 = "SELECT * FROM produtos WHERE tipo = 'BATATA' ORDER BY preco";
        $statement = $this->pdo->query($sql2);
        $produtosBatatas = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosBatatas = array_map(function ($batata){
            return $this->formarObjeto($batata);
        },$produtosBatatas);

        return  $dadosBatatas;
    }

    public function opcoesSobremesas(): array
    {
        $sql2 = "SELECT * FROM produtos WHERE tipo = 'SOBREMESA' ORDER BY preco";
        $statement = $this->pdo->query($sql2);
        $produtosSobremesas = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosSobremesas = array_map(function ($sobremesa){
            return $this->formarObjeto($sobremesa);
        },$produtosSobremesas);

        return  $dadosSobremesas;
    }

    public function opcoesBebidas(): array
    {
        $sql2 = "SELECT * FROM produtos WHERE tipo = 'BEBIDA' ORDER BY preco";
        $statement = $this->pdo->query($sql2);
        $produtosBebidas = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosBebidas = array_map(function ($bebida){
            return $this->formarObjeto($bebida);
        },$produtosBebidas);

        return  $dadosBebidas;
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($produto){
            return $this->formarObjeto($produto);
        },$dados);

        return $todosOsDados;
    }

    public function deletar(int $id)
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$id);
        $statement->execute();

    }

    public function salvar(Produto $produto)
    {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4,$produto->getPreco());
        $statement->bindValue(5, $produto->getImagem());
        $statement->execute();
    }

    public function buscar(int $id)
    {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

    public function atualizar(Produto $produto)
    {
        $sql = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4,$produto->getPreco());
        $statement->bindValue(5, $produto->getImagem());
        $statement->bindValue(6, $produto->getId());
        $statement->execute();
    }


}