<?php
require 'protecao.php';
require '../conexao.php';

$id = (int) ($_GET["id"] ?? $_POST["id"] ?? 0);

$stmt = $conn->prepare("SELECT id, nome, descricao, valor FROM servicos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$servico = $stmt->get_result()->fetch_assoc();

if (!$servico) {
    $_SESSION["msg"] = "Serviço não encontrado.";
    header("Location: listar.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $descricao = trim($_POST["descricao"]);
    $valor = str_replace(",", ".", trim($_POST["valor"]));

    if ($nome === "" || !is_numeric($valor) || $valor < 0) {
        $erro = "Preencha o nome e informe um valor válido.";
        $servico["nome"] = $nome;
        $servico["descricao"] = $descricao;
        $servico["valor"] = $valor;
    } else {
        $stmt = $conn->prepare("UPDATE servicos SET nome = ?, descricao = ?, valor = ? WHERE id = ?");
        $stmt->bind_param("ssdi", $nome, $descricao, $valor, $id);
        $stmt->execute();

        $_SESSION["msg"] = "Serviço atualizado com sucesso!";
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
    <title>Editar serviço - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="max-width: 600px; margin-top: 50px;">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="mb-4">Editar serviço</h3>

            <?php if ($erro): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="id" value="<?= $servico["id"] ?>">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" maxlength="100"
                           value="<?= htmlspecialchars($servico["nome"]) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <input type="text" name="descricao" class="form-control" maxlength="255"
                           value="<?= htmlspecialchars($servico["descricao"] ?? "") ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Valor (R$)</label>
                    <input type="text" name="valor" class="form-control"
                           value="<?= htmlspecialchars(str_replace(".", ",", $servico["valor"])) ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="listar.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>