<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DoeVida</title>
    <link rel="stylesheet" href="<?= BASE_URL_PUBLIC ?>/css/HomeCss.css">
    <link rel="stylesheet" href="<?= BASE_URL_PUBLIC ?>/css/Dashboard.css">
</head>

<body>

    <nav class="navbar">
        <div class="logo">Doe<span>Vida</span></div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Início</a></li>
            <li><a href="#campanhas">Agendar</a></li>
            <li><a href="/gestao_doadores/public/historico">Meu Histórico</a></li>
            <li><a href="/gestao_doadores/public/perfil" class="btn-perfil">👤 Perfil</a></li>

            <?php if (isset($_SESSION['usuario'])): ?>
                <li><a href="/gestao_doadores/public/sair" class="btn-nav">Sair</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <header class="user-header">
        <div class="container">
            <h1>Bem-vindo, <?php echo $_SESSION['usuario_nome'] ?? 'Doador'; ?></h1>
            <p>Tipo Sanguíneo: <strong>O+</strong> | Doador Ativo</p>
        </div>
    </header>

    <main class="container">
        <section class="stats-panel">
            <div class="stat-card">
                <h3>Minhas Doações</h3>
                <p class="number">04</p>
            </div>
            <div class="stat-card">
                <h3>Vidas Salvas</h3>
                <p class="number">16</p>
            </div>
            <div class="stat-card highlight">
                <h3>Próxima Doação</h3>
                <p class="date">Disponível em: 12/04/2026</p>
            </div>
        </section>

        <section id="campanhas" class="section-content">
            <h2 class="title-red">Campanhas e Agendamentos</h2>
            <div class="campaigns-carousel">
                <?php
                if (!empty($campanhas)) {
                    foreach ($campanhas as $campanha) {
                        echo '<div class="campaign-card">';
                        echo '<h3>' . $campanha['nome_campanha'] . '</h3>';
                        echo '<p>' . $campanha['descricao'] . '</p>';
                        // Nome alterado conforme solicitado
                        echo '<button class="btn-agendar" onclick="agendar(' . $campanha['id'] . ')">Agendar Agora</button>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Não existem campanhas críticas no momento.</p>";
                }
                ?>
            </div>
        </section>

        <section class="grid-3">
            <div class="info-card">
                <h3>📍 Onde Doar?</h3>
                <p>Veja os centros de colheita mais próximos da sua localização atual em Luanda.</p>
                <a href="#">Ver Mapa</a>
            </div>
            <div class="info-card">
                <h3>📜 Certificados</h3>
                <p>Emita a sua declaração de doador para fins profissionais ou académicos.</p>
                <a href="#">Baixar Último</a>
            </div>
            <div class="info-card">
                <h3>⚠️ Requisitos</h3>
                <p>Lembre-se: Deve pesar mais de 50kg e estar bem alimentado antes de doar.</p>
                <a href="#">Ler Mais</a>
            </div>
        </section>
    </main>

    <script src="<?= BASE_URL_PUBLIC ?>/js/home.js"></script>
    <script src="<?= BASE_URL_PUBLIC ?>/js/dashboard.js"></script>
</body>

</html>