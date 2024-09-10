<?php
// Definição da classe Produto
class Produto {
    private $id;
    private $nome;
    private $preco;

    public function __construct($id, $nome, $preco) {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    // Exibir detalhes do produto
    public function exibirDetalhes() {
        return "ID: " . $this->id . " | Nome: " . $this->nome . " | Preço: R$" . number_format($this->preco, 2);
    }
}

// Definição da classe Pedido
class Pedido {
    private $id;
    private $produtos = [];
    private $status;

    public function __construct($id) {
        $this->id = $id;
        $this->status = 'Pendente'; // Status inicial do pedido
    }

    // Adicionar produto ao pedido
    public function adicionarProduto(Produto $produto) {
        $this->produtos[] = $produto;
    }

    // Remover produto do pedido
    public function removerProduto($idProduto) {
        foreach ($this->produtos as $index => $produto) {
            if ($produto->getId() === $idProduto) {
                unset($this->produtos[$index]);
                return true;
            }
        }
        return false;
    }

    // Calcular o total do pedido
    public function calcularTotal() {
        $total = 0;
        foreach ($this->produtos as $produto) {
            $total += $produto->getPreco();
        }
        return $total;
    }

    // Exibir detalhes do pedido
    public function exibirPedido() {
        echo "Pedido ID: " . $this->id . "\n";
        echo "Status: " . $this->status . "\n";
        echo "Produtos no pedido:\n";
        foreach ($this->produtos as $produto) {
            echo $produto->exibirDetalhes() . "\n";
        }
        echo "Total do Pedido: R$" . number_format($this->calcularTotal(), 2) . "\n";
    }

    // Alterar status do pedido
    public function alterarStatus($novoStatus) {
        $this->status = $novoStatus;
    }
}

// Exemplo de uso
$produto1 = new Produto(1, "Notebook", 4500.00);
$produto2 = new Produto(2, "Mouse", 150.00);
$produto3 = new Produto(3, "Teclado", 250.00);

$pedido = new Pedido(1001);
$pedido->adicionarProduto($produto1);
$pedido->adicionarProduto($produto2);
$pedido->adicionarProduto($produto3);

// Exibir detalhes do pedido
$pedido->exibirPedido();

// Alterar status do pedido
$pedido->alterarStatus('Concluído');
echo "\nStatus atualizado do pedido:\n";
$pedido->exibirPedido();
