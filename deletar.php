<?php
require_once 'controller/dexController.php';
$controller = new DexController();

$numero = $_GET['numero'] ?? 0;

if ($numero) {
    $controller->deletarPokemon($numero);
    header("Location: index.php");
    exit;
} else {
    echo "Número inválido!";
}
