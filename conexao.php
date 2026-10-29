<?php
$host = "ip";
$senha = "senha";
$usuario = "usuario";
$banco = "nomedobanco";

$pdo = new PDO(
    "pgsql:host=$host;port=5432;dbname=$banco",
    $usuario,
    $senha
);
?>