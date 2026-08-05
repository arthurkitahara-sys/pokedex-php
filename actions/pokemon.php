<?php
require_once '../controller/dexController.php';
$controller = new DexController();

$numero = $_GET['numero'] ?? 0;
$p = $controller->getPokemon($numero);

if (!$p) {
    echo "Pokémon não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title><?php echo htmlspecialchars($p->nome); ?> - Detalhes</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <img src="<?php echo $p->imagem_url; ?>" alt="<?php echo htmlspecialchars($p->nome); ?>">
    <table>
        <tr><th>Número:</th><td><?php echo $p->numero; ?></td></tr>
        <tr><th>Nome:</th><td><?php echo htmlspecialchars($p->nome); ?></td></tr>
        <tr><th>Tipo 1:</th><td><?php echo htmlspecialchars($p->tipo1); ?></td></tr>
        <tr><th>Tipo 2:</th><td><?php echo htmlspecialchars($p->tipo2); ?></td></tr>
        <tr><th>Altura:</th><td><?php echo $p->altura_m; ?> m</td></tr>
        <tr><th>Peso:</th><td><?php echo $p->peso_kg; ?> kg</td></tr>
        <tr><th>Região:</th><td><?php echo htmlspecialchars($p->regiao); ?></td></tr>
    </table>
    <div class="descricao"><?php echo htmlspecialchars($p->descricao); ?></div>
    <a href="../index.php">← Voltar à lista</a>
</div>
</body>
</html>
