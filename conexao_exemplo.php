<?php
$host = "localhost";
$usuario = "SEU_USUARIO";
$senha = "SUA_SENHA";
$banco = "NOME_DO_BANCO";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão.");
}

$conn->set_charset("utf8mb4");