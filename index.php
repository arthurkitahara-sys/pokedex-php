<?php
require_once 'controller/dexController.php';
$controller = new DexController();
$pesquisa = $_GET['pesquisa'] ?? '';
$pokemons = $controller->listar($pesquisa);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Pokédex</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Pokédex</h1>

<form method="get">
    <input type="text" name="pesquisa" placeholder="Pesquisar Pokémon" value="<?php echo htmlspecialchars($pesquisa); ?>">
    <button type="submit">Pesquisar</button>
</form>

<form action="inserir.php" method="get" style="display:inline;">
    <button type="submit">+ Adicionar Pokémon</button>
</form>

<table>
    <tr>
        <th>Número</th>
        <th>Imagem</th>
        <th>Nome</th>
        <th>Tipo 1</th>
        <th>Tipo 2</th>
        <th>Altura (m)</th>
        <th>Peso (kg)</th>
        <th>Região</th>
        <th>Ações</th>
    </tr>
    <?php foreach($pokemons as $p): ?>
    <tr>
        <td><?php echo $p->numero; ?></td>
        <td><img src="<?php echo $p->imagem_url; ?>" alt="<?php echo htmlspecialchars($p->nome); ?>"></td>
        <td><a href="pokemon.php?numero=<?php echo $p->numero; ?>"><?php echo htmlspecialchars($p->nome); ?></a></td>
        <td><?php echo htmlspecialchars($p->tipo1); ?></td>
        <td><?php echo htmlspecialchars($p->tipo2); ?></td>
        <td><?php echo $p->altura_m; ?></td>
        <td><?php echo $p->peso_kg; ?></td>
        <td><?php echo htmlspecialchars($p->regiao); ?></td>
        <td>
            <a href="editar.php?numero=<?php echo $p->numero; ?>">Editar</a> |
            <a href="deletar.php?numero=<?php echo $p->numero; ?>" onclick="return confirm('Deseja realmente excluir?')">Deletar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


</body>
</html>
