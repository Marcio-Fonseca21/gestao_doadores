<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-Vindo a gestão de Doadores</title>
    <link rel="stylesheet" href="css/homeCss.css">
</head>

<body>

    <nav class="navbar">
        <div class="logo">Doe<span>Vida</span></div>
        <ul class="nav-links">
            <li><a href="#sensibilizacao">Por que doar?</a></li>
            <li><a href="#como-doar">Como funciona</a></li>
            <li><a href="#campanhas">Campanhas</a></li>
            <li><a href="Dador/LoginDador.php" class="btn-nav">Entrar</a></li>
        </ul>
    </nav>

    <header class="topo">
        <div class="topo-content">
            <h1>Seu Sangue Pode Salvar uma Vida Hoje</h1>
            <p>
                Em Angola, milhares de pessoas precisam de doação todos os dias.
                Um gesto simples seu pode ser a diferença entre a vida e a morte.
            </p>
            <a href="#campanhas" class="btn-main">Quero Ajudar Agora</a>
        </div>
    </header>


    <section id="sensibilizacao" class="section sec-white">
        <div class="container">
            <div class="impacto-doacao">
                <h2 class="title-red">O impacto da sua doação</h2>

                <p>
                    A doação de sangue desempenha um papel fundamental no funcionamento dos serviços de saúde,
                    sendo indispensável para o atendimento de pacientes em situações de emergência, procedimentos
                    cirúrgicos, tratamentos oncológicos e cuidados materno-infantis. Cada unidade de sangue doada
                    contribui diretamente para a preservação da vida e para a melhoria da qualidade do atendimento
                    prestado nas unidades hospitalares.
                </p>

                <p>
                    A manutenção de reservas de sangue adequadas permite que os hospitais respondam de forma rápida
                    e eficaz às necessidades clínicas diárias e a situações imprevistas. A participação ativa de
                    doadores voluntários é essencial para garantir a continuidade dos serviços, reduzir riscos
                    assistenciais e assegurar que os tratamentos sejam realizados com segurança e eficiência.
                </p>

                <p>
                    Ao realizar a doação de sangue, o cidadão exerce um importante papel social, fortalecendo o
                    sistema de saúde e promovendo valores como solidariedade, responsabilidade e compromisso com a
                    vida. Trata-se de um ato seguro, regulado por normas clínicas, que contribui para o bem-estar
                    coletivo e para a sustentabilidade dos serviços hospitalares.
                </p>
            </div>
            <div class="grid-3">
                <div class="info-card">
                    <h3>4 Vidas</h3>
                    <p>Uma única bolsa de sangue pode ser fracionada e ajudar até quatro pacientes diferentes.</p>
                </div>
                <div class="info-card">
                    <h3>Reposição Natural</h3>
                    <p>Seu corpo repõe o plasma em 24h. O processo é seguro e monitorado por especialistas.</p>
                </div>
                <div class="info-card">
                    <h3>Solidariedade</h3>
                    <p>Muitas cirurgias e tratamentos de câncer dependem exclusivamente da disponibilidade de sangue.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="como-doar" class="section sec-red-light">
        <div class="container">
            <h2 class="title-dark">Como é o processo de doação?</h2>
            <div class="steps">
                <div class="step-item"><span>1</span>
                    <p>Identificação e Cadastro</p>
                </div>
                <div class="step-item"><span>2</span>
                    <p>Triagem Clínica e de Sinais Vitais</p>
                </div>
                <div class="step-item"><span>3</span>
                    <p>Coleta (aprox. 10 a 15 min)</p>
                </div>
                <div class="step-item"><span>4</span>
                    <p>Repouso e Lanche</p>
                </div>
            </div>
        </div>
    </section>

    <section id="campanhas" class="section sec-grey">
        <div class="container">
            <h2 class="title-red">Campanhas Ativas</h2>
            <div class="grid-3">

                <?php
                if (!empty($campanhas)) {

                    foreach ($campanhas as $campanha) {
                        echo '<div class="campaign-card">';

                        echo '<h3>' . $campanha['nome_campanha'] . '</h3>';

                        echo '<p>' . $campanha['descricao'] . '</p>';

                        echo ' <button onclick="agendar">Agendar</button>';

                        echo '</div>';
                    }

                } else {
                    echo "<p>Nenhuma Campanha encontrada.</p>";
                }
                ?>

            </div>
        </div>
    </section>
    <script src="/js/home.js"></script>
</body>

</html>