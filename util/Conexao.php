<?php
class Conexao {
public static function getConexao(){

$hostname = 'localhost';
$dbusername = 'root';
$password = 'usbw';
$database = 'dex';
$conn = new mysqli($hostname, $dbusername, $password, $database);
if ($conn->connect_error) {
die("Conexão falhou: " . $conn->connect_error);
}
$conn->set_charset("utf8");
return $conn;
}
}