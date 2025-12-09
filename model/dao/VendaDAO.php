<?php
    class VendaDAO {
        public function create($venda) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO venda(data,id_cliente,id_usuario) 
                     VALUES (:d, :f, :u)"
                );
                $query->bindValue(':d',$venda->getData(), PDO::PARAM_STR);
                // Bind para as chaves estrangeiras
                $query->bindValue(':f',$venda->getCliente()->getId(), PDO::PARAM_INT);
                $query->bindValue(':u',$venda->getUsuario()->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM venda");                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $vendas = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o cliente
                    $daoCliente = new ClienteDAO();
                    $cliente = $daoCliente->find($linha['id_cliente']);
                    
                    // Para a associação com o Usuário
                    $daoUsuario = new UsuarioDAO();
                    $usuario = $daoUsuario->find($linha['id_usuario']);

                    // Construindo um objeto do venda
                    $venda = new Venda();
                    $venda->setId($linha['id_venda']);
                    $venda->setData($linha['data']);
                    $venda->setCliente($cliente);
                    // Definir o atributo (objeto) cliente
                    $venda->setUsuario($usuario);

                    array_push($vendas,$venda);
                }

                return $vendas;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }
        
        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM venda WHERE id_venda = :i");
                $query->bindValue(':i', $id, PDO::PARAM_INT);             

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                
                // Para a associação com o cliente
                $daoCliente = new ClienteDAO();
                $cliente = $daoCliente->find($linha['id_cliente']);
                
                // Para a associação com o Usuário
                $daoUsuario = new UsuarioDAO();
                $usuario = $daoUsuario->find($linha['id_usuario']);

                // Construindo um objeto do venda
                $venda = new venda();
                $venda->setId($linha['id_venda']);
                $venda->setData($linha['data']);
                $venda->setCliente($cliente);
                
                // Definir o atributo (objeto) cliente
                $venda->setUsuario($usuario);

                return $venda;
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }

        public function update($venda) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE venda 
                     SET data = :d, id_cliente = :f, id_usuario = :u  
                     WHERE id_venda = :i"
                );
                $query->bindValue(':d',$venda->getData(), PDO::PARAM_STR);
                // Bind para as chaves estrangeiras
                $query->bindValue(':f',$venda->getCliente()->getId(), PDO::PARAM_INT);
                $query->bindValue(':u',$venda->getUsuario()->getId(), PDO::PARAM_INT);
                $query->bindValue(':i',$venda->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #4: " . $e->getMessage();
            }
        }

        public function destroy($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM venda 
                     WHERE id_venda = :i"
                );
                $query->bindValue(':i',$id, PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }
        }
    }
