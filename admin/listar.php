<?php
require 'protecao.php';
require '../conexao.php';

$msg = $_SESSION["msg"] ?? "";
unset($_SESSION["msg"]);

$resultado = $conn->query("SELECT id, nome, descricao, valor FROM servicos ORDER BY nome");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Serviços - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">Painel do Salão</span>
        <div>
            <span class="text-white me-3">Olá, <?= htmlspecialchars($_SESSION["usuario_nome"]) ?></span>
            <a href="../logout.php" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Serviços</h2>
        <a href="cadastrar.php" class="btn btn-success">+ Novo serviço</a>
    </div>

    <?php if ($msg): ?>
        <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered bg-white">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th style="width: 180px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($s = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($s["nome"]) ?></td>
                        <td><?= htmlspecialchars($s["descricao"] ?? "") ?></td>
                        <td>R$ <?= number_format($s["valor"], 2, ",", ".") ?></td>
                        <td>
                            <a href="editar.php?id=<?= $s["id"] ?>" class="btn btn-primary btn-sm">Editar</a>
                            <form action="excluir.php" method="POST" class="d-inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
                                <input type="hidden" name="id" value="<?= $s["id"] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>