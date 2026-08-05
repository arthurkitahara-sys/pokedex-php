<?php
require_once '../controller/dexController.php';
$controller = new DexController();

$numero = $_GET['numero'] ?? 0;
$pokemon = $controller->getPokemon($numero);

if (!$pokemon) {
    echo "Pokémon não encontrado!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST['id'] = $pokemon->id;
    $controller->atualizarPokemon($_POST);
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Pokémon</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>Editar Pokémon</h1>

<form method="post">
    <label>Número:</label><br>
    <input type="number" name="numero" required value="<?php echo $pokemon->numero; ?>"><br>

    <label>Nome:</label><br>
    <input type="text" name="nome" required value="<?php echo htmlspecialchars($pokemon->nome); ?>"><br>

    <label>Tipo 1:</label><br>
    <input type="text" name="tipo1" required value="<?php echo htmlspecialchars($pokemon->tipo1); ?>"><br>

    <label>Tipo 2:</label><br>
    <input type="text" name="tipo2" value="<?php echo htmlspecialchars($pokemon->tipo2); ?>"><br>

    <label>Altura (m):</label><br>
    <input type="number" step="0.01" name="altura_m" value="<?php echo $pokemon->altura_m; ?>"><br>

    <label>Peso (kg):</label><br>
    <input type="number" step="0.01" name="peso_kg" value="<?php echo $pokemon->peso_kg; ?>"><br>

    <label>Região:</label><br>
    <input type="text" name="regiao" value="<?php echo htmlspecialchars($pokemon->regiao); ?>"><br>

    <label>Descrição:</label><br>
    <textarea name="descricao"><?php echo htmlspecialchars($pokemon->descricao); ?></textarea><br>

    <label>URL da Imagem:</label><br>
    <input type="text" name="imagem_url" placeholder="Cole a URL da imagem aqui" value="<?php echo $pokemon->imagem_url; ?>"><br>

    <button type="submit">Atualizar</button>
</form>

<a href="../index.php">Voltar</a>
</body>
</html>
