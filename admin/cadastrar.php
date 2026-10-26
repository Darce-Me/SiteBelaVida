<?php
require 'protecao.php';
require '../conexao.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $descricao = trim($_POST["descricao"]);
    $valor = str_replace(",", ".", trim($_POST["valor"]));

    if ($nome === "" || !is_numeric($valor) || $valor < 0) {
        $erro = "Preencha o nome e informe um valor válido.";
    } else {
        $stmt = $conn->prepare("INSERT INTO servicos (nome, descricao, valor) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $nome, $descricao, $valor);
        $stmt->execute();

        $_SESSION["msg"] = "Serviço cadastrado com sucesso!";
        header("Location: listar.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novo serviço - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="max-width: 600px; margin-top: 50px;">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="mb-4">Novo serviço</h3>

            <?php if ($erro): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" maxlength="100" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <input type="text" name="descricao" class="form-control" maxlength="255">
                </div>
                <div class="mb-3">
                    <label class="form-label">Valor (R$)</label>
                    <input type="text" name="valor" class="form-control" placeholder="80,00" required>
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="listar.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>