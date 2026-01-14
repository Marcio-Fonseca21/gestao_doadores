 <section id="campanhas" class="section sec-grey">
        <div class="container">
            <h2 class="title-red">Campanhas Ativas</h2>
            <div class="campaigns-carousel">
                <?php
                if (!empty($campanhas)) {
                    foreach ($campanhas as $campanha) {
                        echo '<div class="campaign-card">';
                        // Usando htmlspecialchars para segurança
                        echo '<h3>' . htmlspecialchars($campanha['nome_campanha']) . '</h3>';

                        // Resumo da descrição
                        $resumo = mb_strimwidth($campanha['descricao'], 0, 100, "...");
                        echo '<p>' . htmlspecialchars($resumo) . '</p>';

                        // CORREÇÃO AQUI: Alterado de ['id'] para ['campanha_id']
                        echo '<a href="/gestao_doadores/public/campanha/detalhes?id=' . $campanha['id_campanha'] . '" class="btn-main">Ver mais</a>';

                        echo '</div>';
                    }
                } else {
                    echo "<p>Nenhuma Campanha encontrada no momento.</p>";
                }
                ?>
            </div>
        </div>
    </section>