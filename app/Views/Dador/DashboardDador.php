<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DoeVida</title>
    <link rel="stylesheet" href="<?= BASE_URL_PUBLIC ?>/css/Dashboard.css">
</head>

<body>

    <!-- ===== HEADER / NAVBAR ===== -->
    <header class="navbar">
        <a href="/gestao_doadores/public/" class="logo-link">
            <div class="logo">Doe1<span>Salve4</span></div>
        </a>
        <!-- Nome do usuário no header -->
        <?php if (isset($_SESSION['usuario'])):
            $primeiroNome = explode(' ', $_SESSION['usuario']['nome'])[0];
            ?>
            <div class="bem-vindo-header">Bem-vindo, <?= htmlspecialchars($primeiroNome) ?></div>
        <?php endif; ?>

        <ul class="nav-links">

            <?php if (isset($_SESSION['usuario'])): ?>
                <li><a href="/gestao_doadores/public/sair" class="btn-nav">Sair</a></li>
            <?php else: ?>
                <li><a href="/gestao_doadores/public/loginPublico" class="btn-nav">Entrar</a></li>
            <?php endif; ?>
        </ul>
    </header>

    <!-- ===== MENU LATERAL ===== -->
    <aside class="menu-lateral" id="menuLateral">
        <nav class="menu-opcoes">
            <a href="#" class="opcao-menu" data-alvo="inicio">🏠 <span>Início</span></a>
            <a href="#" class="opcao-menu" data-alvo="perfil">👤 <span>Perfil</span></a>
            <a href="#" class="opcao-menu" data-alvo="campanhas">🩸 <span>Ver Campanhas</span></a>
            <a href="#" class="opcao-menu" data-alvo="agendadas">📅 <span>Campanhas Agendadas</span></a>
            <a href="#" class="opcao-menu" data-alvo="voluntaria">❤️ <span>Doação Voluntária</span></a>
        </nav>
    </aside>

    <!-- ===== CONTEÚDO PRINCIPAL ===== -->
    <div class="conteudo-principal" id="conteudoPrincipal">
        <header class="topo-dashboard">
            <button class="btn-menu" onclick="alternarMenu()">☰</button>
        </header>

        <main class="area-dashboard">

            <!-- INÍCIO -->
            <section id="painel-inicio" class="painel-conteudo">

                <!-- HERO / IMAGEM PRINCIPAL -->
                <div class="hero-doacao">
                    <div class="hero-overlay">
                        <h2>Doe Sangue, Salve Vidas</h2>
                        <p class="hero-dinamico">
                            Cada doação pode salvar até <strong>4 vidas</strong>.
                        </p>
                    </div>
                </div>

                <!-- INDICADORES PRINCIPAIS -->
                <div class="grid-3 indicadores">
                    <div class="info-card">
                        <h3>Total de Doações</h3>
                        <p>05</p>
                    </div>

                    <div class="info-card">
                        <h3>Vidas Salvas</h3>
                        <p>15+</p>
                    </div>

                    <div class="info-card">
                        <h3>Última Doação</h3>
                        <p>12/01/2026</p>
                    </div>
                </div>

                <!-- 4 SEÇÕES INTELIGENTES -->
                <div class="grid-4 secoes-inteligentes">

                    <div class="bloco-inteligente">
                        <h4>🩸 Impacto Real</h4>
                        <p>
                            O sangue doado é separado em componentes e ajuda pacientes
                            com anemia, cirurgias e emergências.
                        </p>
                    </div>

                    <div class="bloco-inteligente">
                        <h4>⏱️ Tempo Médio</h4>
                        <p>
                            Uma doação leva cerca de <strong>30 minutos</strong>,
                            mas o impacto dura uma vida inteira.
                        </p>
                    </div>

                    <div class="bloco-inteligente">
                        <h4>📍 Onde Doar</h4>
                        <p>
                            Consulte campanhas ativas e agende no local mais próximo
                            de si com apenas um clique.
                        </p>
                    </div>

                    <div class="bloco-inteligente">
                        <h4>❤️ Quem Pode Doar</h4>
                        <p>
                            Pessoas saudáveis entre 18 e 60 anos, com mais de 50kg,
                            podem ser doadoras.
                        </p>
                    </div>

                </div>

            </section>


            <!-- PERFIL -->
            <section id="painel-perfil" class="painel-conteudo" style="display:none">
                <h2>Meu Perfil</h2>

                <div class="grid-perfil">

                    <!-- Dados Pessoais -->
                    <div class="perfil-bloco">
                        <h3>Dados Pessoais</h3>
                        <div class="conteudo-bloco">
                            <p><strong>Nome completo:</strong>
                                <span id="nomeExibido"><?php echo $usuarioLogado['nome']; ?></span>
                            </p>
                            <p><strong>Data de nascimento:</strong>
                                <span id="dataNascimentoExibido"><?php echo $usuarioLogado['dataNascimento']; ?></span>
                            </p>
                            <p><strong>Sexo:</strong>
                                <span id="sexoExibido"><?php echo $usuarioLogado['sexo']; ?></span>
                            </p>
                            <p><strong>Tipo de documento:</strong>
                                <span id="tipoDocumentoExibido"><?php echo $usuarioLogado['tipoDocumento']; ?></span>
                            </p>
                            <p><strong>Nº do documento:</strong>
                                <span
                                    id="numeroDocumentoExibido"><?php echo $usuarioLogado['numeroDocumento']; ?></span>
                            </p>
                            <p><strong>Indicador do país:</strong>
                                <span id="indicadorPaisExibido"><?php echo ($usuarioLogado['indicadorPais']) ?></span>
                            </p>
                            <p><strong>Telefone:</strong>
                                <span id="telefoneExibido"><?php echo $usuarioLogado['telefone']; ?></span>
                            </p>
                            <p><strong>Email:</strong>
                                <span id="emailExibido"><?php echo $usuarioLogado['email']; ?></span>
                            </p>
                        </div>

                        <button class="btn-editar" onclick="editarDados('pessoais', this)">Editar</button>
                        <button class="btn-guardar" onclick="guardarDados('pessoais')">Guardar dados</button>
                        <p class="msg-sucesso" id="msgSucessoPessoais"></p>
                    </div>

                    <!-- Informações Complementares -->
                    <div class="perfil-bloco">
                        <h3>Informações Complementares</h3>
                        <div class="conteudo-bloco">
                            <p><strong>Nacionalidade:</strong>
                                <span id="nacionalidadeExibido"><?php echo ($usuarioLogado['nacionalidade']) ?></span>
                            </p>
                            <p><strong>Peso:</strong>
                                <span id="pesoExibido"><?php echo ($usuarioLogado['peso']) ?></span>
                            </p>
                            <p><strong>Altura:</strong>
                                <span id="alturaExibido"><?php echo ($usuarioLogado['altura']) ?></span>
                            </p>
                            <p><strong>Tipo sanguíneo:</strong>
                                <span id="tipoSanguineoExibido"><?php echo ($usuarioLogado['tipoSanguineo']) ?></span>
                            </p>
                            <p><strong>Doença crónica:</strong>
                                <span id="doencaExibido"><?php echo ($usuarioLogado['doencaCronica']) ?></span>
                            </p>
                            <p><strong>Histórico de transfusão:</strong>
                                <span
                                    id="historicoTransfusaoExibido"><?php echo ($usuarioLogado['historicoTransfusao']) ?></span>
                            </p>
                        </div>
                        <button type="button" class="btn-editar"
                            onclick="editarDados('complementares', this)">Editar</button>
                        <button class="btn-guardar" onclick="guardarDados('complementares')">Guardar
                            informações</button>
                        <p class="msg-sucesso" id="msgSucessoComplementares"></p>
                    </div>

                    <!-- Alterar Senha -->
                    <div class="perfil-bloco">
                        <h3>Alterar Senha</h3>
                        <div class="conteudo-bloco">
                            <input type="password" placeholder="Senha atual" id="senhaAtual">
                            <input type="password" placeholder="Nova senha" id="novaSenha">
                            <input type="password" placeholder="Confirmar nova senha" id="confirmarSenha">
                        </div>
                        <button class="btn-guardar" onclick="alterarSenha()">Alterar senha</button>
                        <p class="msg-sucesso" id="msgSucessoSenha"></p>
                    </div>

                </div>
            </section>

            <!-- CAMPANHAS -->
            <section id="painel-campanhas" class="painel-conteudo" style="display:none">
                <div class="container">
                    <h2 class="title-red">Campanhas Ativas</h2>

                    <div class="campaigns-carousel">
                        <?php
                        if (!empty($campanhas)) {
                            foreach ($campanhas as $campanha) {

                                echo '<div class="campaign-card">';

                                /* TÍTULO */
                                echo '<h3>' . htmlspecialchars($campanha['nome_campanha']) . '</h3>';

                                /* RESUMO DA DESCRIÇÃO */
                                $resumo = mb_strimwidth($campanha['descricao'], 0, 100, "...");
                                echo '<p>' . htmlspecialchars($resumo) . '</p>';

                                /* AÇÕES */
                                echo '<div class="campaign-actions">';

                                echo '<a href="/gestao_doadores/public/campanha/detalhes?id='
                                    . $campanha['id_campanha'] . '" class="btn-ver">
                                Ver mais
                            </a>';

                                echo '<button class="btn-agendar" data-campanha="'
                                    . $campanha['id_campanha'] . '">Agendar</button>';


                                echo '</div>';

                                echo '</div>';
                            }
                        } else {
                            echo '<p>Nenhuma campanha encontrada no momento.</p>';
                        }
                        ?>
                    </div>
                </div>
            </section>


            <!-- AGENDADAS -->
            <section id="painel-agendadas" class="painel-conteudo" style="display:none">
                <h2 class="title-red">Minhas Campanhas Agendadas</h2>

                <div class="container-tabela">
                    <table class="tabela-dashboard">
                        <thead>
                            <tr>
                                <th>Campanha</th>
                                <th>Local / Hospital</th>
                                <th>Data Marcada</th>
                                <th>Status</th>
                                <th>Observações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($agendamentos as $ag): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($ag['nome_campanha']) ?></strong></td>
                                    <td><?= htmlspecialchars($ag['nome_hospital']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($ag['data_marcacao'])) ?></td>
                                    <td>
                                        <span class="badge-status <?= strtolower($ag['status_doacao']) ?>">
                                            <?= htmlspecialchars($ag['status_doacao']) ?>
                                        </span>
                                    </td>
                                    <td><span
                                            class="motivo-texto"><?= htmlspecialchars($ag['motivo'] ?? 'Nenhuma') ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- DOAÇÃO VOLUNTÁRIA -->
            <section id="painel-voluntaria" class="painel-conteudo" style="display:none">
                <div class="card-voluntario">
                    <h2 class="title-red">Agendar Doação Voluntária</h2>
                    <p class="instrucao">Escolha o hospital e o horário que melhor se adaptam à sua rotina.</p>

                    <form id="formVoluntario" class="form-grid">
                        <div class="input-group">
                            <label>Onde deseja doar?</label>
                            <select id="voluntario_hospital" required>
                                <option value="">Selecione um hospital...</option>
                                <?php foreach ($hospitais as $h): ?>
                                    <option value="<?= $h['id_hospital'] ?>"><?= htmlspecialchars($h['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label>Data e Hora</label>
                            <input type="datetime-local" id="voluntario_data" required>
                        </div>

                        <button type="submit" class="btn-confirmar-voluntario">
                            Confirmar Agendamento Voluntário
                        </button>
                    </form>
                </div>
            </section>

        </main>
    </div>

    <script src="<?= BASE_URL_PUBLIC ?>/js/painelDador.js"></script>
</body>

</html>