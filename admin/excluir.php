<?php
require 'protecao.php';
require '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int) ($_POST["id"] ?? 0);

    $stmt = $conn->prepare("DELETE FROM servicos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $_SESSION["msg"] = "Serviço excluído com sucesso!";
}

header("Location: listar.php");
exit;