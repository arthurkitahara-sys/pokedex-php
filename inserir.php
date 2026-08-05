<?php
require_once 'controller/dexController.php';
$controller = new DexController();

$erro = '';
$dados = []; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dados = [
        'numero' => intval($_POST['numero'] ?? 0),
        'nome' => trim($_POST['nome'] ?? ''),
        'tipo1' => trim($_POST['tipo1'] ?? ''),
        'tipo2' => trim($_POST['tipo2'] ?? null),
        'altura_m' => floatval($_POST['altura_m'] ?? 0),
        'peso_kg' => floatval($_POST['peso_kg'] ?? 0),
        'descricao' => trim($_POST['descricao'] ?? ''),
        'regiao' => trim($_POST['regiao'] ?? ''),
        'imagem_url' => trim($_POST['imagem_url'] ?? '')
    ];

   
    if (!$dados['numero'] || !$dados['nome'] || !$dados['tipo1']) {
        $erro = "Campos obrigatórios: Número, Nome e Tipo 1";
    } else {
   
        try {
            $controller->inserirPokemon($dados);
            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            $erro = "Erro ao inserir Pokémon: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Inserir Novo Pokémon</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Inserir Novo Pokémon</h1>

<form method="post">
    <label>Número:</label><br>
    <input type="number" name="numero" required value="<?php echo $_POST['numero'] ?? ''; ?>"><br>

    <label>Nome:</label><br>
    <input type="text" name="nome" required value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>"><br>

    <label>Tipo 1:</label><br>
    <input type="text" name="tipo1" required value="<?php echo htmlspecialchars($_POST['tipo1'] ?? ''); ?>"><br>

    <label>Tipo 2:</label><br>
    <input type="text" name="tipo2" value="<?php echo htmlspecialchars($_POST['tipo2'] ?? ''); ?>"><br>

    <label>Altura (m):</label><br>
    <input type="number" step="0.01" name="altura_m" value="<?php echo $_POST['altura_m'] ?? ''; ?>"><br>

    <label>Peso (kg):</label><br>
    <input type="number" step="0.01" name="peso_kg" value="<?php echo $_POST['peso_kg'] ?? ''; ?>"><br>

    <label>Região:</label><br>
    <input type="text" name="regiao" value="<?php echo htmlspecialchars($_POST['regiao'] ?? ''); ?>"><br>

    <label>Descrição:</label><br>
    <textarea name="descricao"><?php echo htmlspecialchars($_POST['descricao'] ?? ''); ?></textarea><br>

    <label>URL da Imagem:</label><br>
    <input type="text" name="imagem_url" placeholder="Cole a URL da imagem aqui" value="<?php echo htmlspecialchars($_POST['imagem_url'] ?? ''); ?>"><br>

    <button type="submit">Inserir</button>
</form>

<a href="index.php">Voltar</a>
</body>
</html>
