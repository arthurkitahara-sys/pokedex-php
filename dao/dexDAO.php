<?php
require_once __DIR__ . '/../model/dex.php';
require_once __DIR__ . '/../util/Conexao.php';

class DexDAO {

    // Lista todos os Pokémon do banco de dados
    public function listarTodos() {
        $conn = Conexao::getConexao(); 
        $sql = "SELECT * FROM pokemon ORDER BY numero"; 
        $res = $conn->query($sql); 
        $pokemons = []; 
        while ($row = $res->fetch_assoc()) { 
            $pokemons[] = $this->mapearPokemon($row); 
        }
        $conn->close(); 
        return $pokemons; 
    }

    // Busca um Pokémon pelo seu número
    public function buscarPorNumero($numero) {
        $conn = Conexao::getConexao(); 
        $sql = "SELECT * FROM pokemon WHERE numero=?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("i", $numero); 
        $stmt->execute(); 
        $res = $stmt->get_result(); 
        $row = $res->fetch_assoc(); 
        $conn->close(); 
        return $row ? $this->mapearPokemon($row) : null; 
    }

    // Pesquisa Pokémon pelo nome (LIKE %nome%)
    public function pesquisarPorNome($nome) {
        $conn = Conexao::getConexao();
        $nome = "%$nome%"; 
        $sql = "SELECT * FROM pokemon WHERE nome LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nome); 
        $stmt->execute();
        $res = $stmt->get_result();
        $pokemons = [];
        while ($row = $res->fetch_assoc()) {
            $pokemons[] = $this->mapearPokemon($row); 
        }
        $conn->close();
        return $pokemons;
    }

    // Insere um novo Pokémon no banco
    public function inserir(Pokemon $p) {
        $conn = Conexao::getConexao();
        $sql = "INSERT INTO pokemon (nome, numero, tipo1, tipo2, altura_m, peso_kg, descricao, regiao, imagem_url) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sissddsss", 
            $p->nome, $p->numero, $p->tipo1, $p->tipo2,
            $p->altura_m, $p->peso_kg, $p->descricao, $p->regiao, $p->imagem_url
        );
        $stmt->execute(); 
        $conn->close();
    }

    // Atualiza um Pokémon existente usando o ID como referência
    public function atualizar(Pokemon $p) {
        $conn = Conexao::getConexao();
        
        $sql = "UPDATE pokemon SET nome=?, numero=?, tipo1=?, tipo2=?, altura_m=?, peso_kg=?, descricao=?, regiao=?, imagem_url=? 
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(
            "sisddssssi", 
            $p->nome, 
            $p->numero, 
            $p->tipo1, 
            $p->tipo2, 
            $p->altura_m,
            $p->peso_kg, 
            $p->descricao, 
            $p->regiao, 
            $p->imagem_url, 
            $p->id 
        );
        
        $stmt->execute();
        $conn->close();
    }

    // Deleta um Pokémon pelo número
    public function deletar($numero) {
        $conn = Conexao::getConexao();
        $sql = "DELETE FROM pokemon WHERE numero=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $numero); 
        $stmt->execute();
        $conn->close();
    }

    // Converte uma linha do banco em objeto Pokémon
    private function mapearPokemon($row) {
        $p = new Pokemon();
        $p->id = $row['id'];
        $p->nome = $row['nome'];
        $p->numero = $row['numero'];
        $p->tipo1 = $row['tipo1'];
        $p->tipo2 = $row['tipo2'];
        $p->altura_m = $row['altura_m'];
        $p->peso_kg = $row['peso_kg'];
        $p->descricao = $row['descricao'];
        $p->regiao = $row['regiao'];
        $p->imagem_url = $row['imagem_url'];
        return $p; 
    }
}