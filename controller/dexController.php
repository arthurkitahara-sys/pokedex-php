<?php
require_once __DIR__ . '/../dao/dexDAO.php';
require_once __DIR__ . '/../model/dex.php';

class DexController {
    private $dao;

    public function __construct() {
        $this->dao = new DexDAO();
    }

    // Lista todos os Pokémon ou filtra por nome
    public function listar($filtro = '') {
        if ($filtro != '') {
            return $this->dao->pesquisarPorNome($filtro);
        } else {
            return $this->dao->listarTodos();
        }
    }

    // Retorna detalhes de um Pokémon
    public function getPokemon($numero) {
        return $this->dao->buscarPorNumero($numero);
    }

    // Inserir Pokémon
    public function inserirPokemon($dados) {
        $p = new Pokemon();
        $p->id = $dados['id'] ?? null; 
        $p->numero = $dados['numero'];
        $p->nome = $dados['nome'];
            $p->tipo1 = $dados['tipo1'];
        $p->tipo2 = $dados['tipo2'] ?? null;
        $p->altura_m = $dados['altura_m'] ?? 0;
        $p->peso_kg = $dados['peso_kg'] ?? 0;
        $p->descricao = $dados['descricao'] ?? '';
        $p->regiao = $dados['regiao'] ?? '';
        $p->imagem_url = $dados['imagem_url'] ?? '';
        $this->dao->inserir($p);
    }

    // Atualizar Pokémon
    public function atualizarPokemon($dados) {
        $p = new Pokemon();
        $p->id = $dados['id'] ?? null;
        $p->numero = $dados['numero'];
        $p->nome = $dados['nome'];
        $p->tipo1 = $dados['tipo1'];
        $p->tipo2 = $dados['tipo2'] ?? null;
        $p->altura_m = $dados['altura_m'] ?? 0;
        $p->peso_kg = $dados['peso_kg'] ?? 0;
        $p->descricao = $dados['descricao'] ?? '';
        $p->regiao = $dados['regiao'] ?? '';
        $p->imagem_url = $dados['imagem_url'] ?? '';
        $this->dao->atualizar($p);
    }

    // Deletar Pokémon
    public function deletarPokemon($numero) {
        $this->dao->deletar($numero);
    }
}
