<?php
// Classe que representa um produto
class Produto
{
    private ?int $id; // ID do produto (pode ser nulo se ainda não foi definido)
    private string $tipo; // Tipo do produto (ex: BURGER, BATATA, SOBREMESA, BEBIDA)
    private string $nome; // Nome do produto
    private string $descricao; // Descrição do produto
    private string $imagem; // Nome do arquivo de imagem do produto (padrão inicial fornecido)
    private float $preco; // Preço do produto

    /**
     * Construtor da classe Produto
     * @param int|null $id ID do produto (opcional)
     * @param string $tipo Tipo do produto
     * @param string $nome Nome do produto
     * @param string $descricao Descrição do produto
     * @param float $preco Preço do produto
     * @param string $imagem Nome da imagem do produto (padrão inicial fornecido)
     */
    public function __construct(?int $id, string $tipo, string $nome, string $descricao, float $preco, string $imagem = "Pioneiro-Photoroom.png")
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->preco = $preco;
    }

    /**
     * Retorna o ID do produto
     * @return int|null ID do produto
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Define a imagem do produto
     * @param string $imagem Nome da imagem do produto
     */
    public function setImagem(string $imagem): void
    {
        $this->imagem = $imagem;
    }

    /**
     * Retorna o tipo do produto
     * @return string Tipo do produto
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * Retorna o nome do produto
     * @return string Nome do produto
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Retorna a descrição do produto
     * @return string Descrição do produto
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * Retorna o nome da imagem do produto
     * @return string Nome da imagem do produto
     */
    public function getImagem(): string
    {
        return $this->imagem;
    }

    /**
     * Retorna o caminho completo da imagem do produto
     * @return string Caminho completo da imagem do produto
     */
    public function getImagemDiretorio(): string
    {
        return "img/" . $this->imagem;
    }

    /**
     * Retorna o preço do produto
     * @return float Preço do produto
     */
    public function getPreco(): float
    {
        return $this->preco;
    }

    /**
     * Retorna o preço formatado do produto com o símbolo da moeda
     * @return string Preço formatado do produto
     */
    public function getPrecoFormatado(): string
    {
        return "R$ " . number_format($this->preco, 2);
    }
}
