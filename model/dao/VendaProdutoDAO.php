<?php
    class VendaProdutoDAO {
        public function create($vendaProduto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO venda_produto(id_venda, id_produto, quantidade, valor_unitario_venda) 
                     VALUES (:c, :p, :q, :v)"
                );
                $query->bindValue(':q',$vendaProduto->getQuantidade(), PDO::PARAM_INT);
                $query->bindValue(':v',$vendaProduto->getValorUnitario(), PDO::PARAM_STR);
                
                // Bind para as chaves estrangeiras
                $query->bindValue(':c',$vendaProduto->getVenda()->getId(), PDO::PARAM_INT);
                $query->bindValue(':p',$vendaProduto->getProduto()->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        // Método read deverá filtrar produtos a partir de um id de venda
        public function read($idVenda) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM venda_produto WHERE id_venda = :c");
                $query->bindValue(':c',$idVenda, PDO::PARAM_INT);                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $vendaProdutos = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o Produto
                    $daoProduto = new ProdutoDAO();
                    $produto = $daoProduto->find($linha['id_produto']);  
                    $venda = new venda();
                    $venda->setId($idVenda);                  

                    // Construindo um objeto do venda
                    $vendaProduto = new vendaProduto();
                    $vendaProduto->setVenda($venda);                    
                    $vendaProduto->setProduto($produto);

                    $vendaProduto->setValorUnitario($linha['valor_unitario_venda']);
                    $vendaProduto->setQuantidade($linha['quantidade']);

                    array_push($vendaProdutos,$vendaProduto);
                }

                return $vendaProdutos;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        // Método destroy irá apagar um registro a partir da combinação das duas chaves primárias
        public function destroy($idVenda, $idProduto) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM venda_produto 
                     WHERE id_venda = :c and id_produto = :p"
                );
                $query->bindValue(':c',$idVenda, PDO::PARAM_INT);
                $query->bindValue(':p',$idProduto, PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }
        }
    }