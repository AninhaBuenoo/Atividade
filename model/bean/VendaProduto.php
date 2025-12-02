<?php
    class VendaProduto {
        // Atributos
        private $venda; // Associação com a classe venda
        private $produto; // Associação com a classe Produto
        private $quantidade;
        private $valorUnitario;

        // Métodos
        public function getVenda() {
            return $this->venda;
        }

        public function setVenda($venda) {
            $this->venda = $venda;
        }

        public function getProduto() {
            return $this->produto;
        }

        public function setProduto($produto) {
            $this->produto = $produto;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }

        public function getValorUnitario() {
            return $this->valorUnitario;
        }

        public function setValorUnitario($valorUnitario) {
            $this->valorUnitario = $valorUnitario;
        }
    }