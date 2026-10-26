<?php
require 'conexao.php';

$servicos = $conn->query("SELECT nome, descricao, valor FROM servicos ORDER BY nome");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Studio Bela Vida - Salão de Beleza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<!-- Menu -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-salao sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#inicio">Studio Bela Vida</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#inicio">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="#sobre">Sobre</a></li>
                <li class="nav-item"><a class="nav-link" href="#servicos">Serviços</a></li>
                <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Área do admin</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Apresentação -->
<section id="inicio" class="hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Realce a sua beleza</h1>
        <p class="lead mb-4">Cuidado, estilo e bem-estar em um só lugar.</p>
        <a href="#servicos" class="btn btn-light btn-lg">Conheça nossos serviços</a>
    </div>
</section>

<!-- Sobre -->
<section id="sobre" class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mb-4">Sobre o salão</h2>
                <p>
                    O Studio Bela Vida nasceu para oferecer um atendimento acolhedor e profissional.
                    Nossa equipe trabalha com produtos de qualidade para que você saia daqui
                    se sentindo ainda mais bonita e confiante.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Serviços (vêm do banco de dados) -->
<section id="servicos" class="py-5 secao-clara">
    <div class="container">
        <h2 class="text-center mb-5">Nossos serviços</h2>
        <div class="row g-4">
            <?php while ($s = $servicos->fetch_assoc()): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-servico h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($s["nome"]) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($s["descricao"] ?? "") ?></p>
                            <p class="preco mb-0">R$ <?= number_format($s["valor"], 2, ",", ".") ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- Contato -->
<section id="contato" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Contato</h2>
        <div class="row justify-content-center text-center">
            <div class="col-md-4 mb-3">
                <h5>Endereço</h5>
                <p>Rua das Flores, 123<br>Centro</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Telefone</h5>
                <p>(00) 00000-0000</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Horário</h5>
                <p>Seg a Sex: 9h às 19h<br>Sáb: 9h às 16h</p>
            </div>
        </div>
    </div>
</section>

<footer class="text-center py-3">
    <small>&copy; <?= date("Y") ?> Studio Bela Vida. Todos os direitos reservados.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>