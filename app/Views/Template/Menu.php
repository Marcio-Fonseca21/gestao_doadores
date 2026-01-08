<nav class="navbar">
    <a style="text-decoration: none;" href='/gestao_doadores/public/'>
        <div class="logo">Doe1<span>Salve4</span></div>
    </a>
    <ul class="nav-links">
        <li><a href="#sensibilizacao">Por que doar?</a></li>
        <li><a href="#como-doar">Como funciona</a></li>
        <li><a href="#campanhas">Campanhas</a></li>

        <?php
        // menu dashboard
        
        if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipoUsuario'] == 'DADOR') {
            echo "<li><a href='/gestao_doadores/public/dador/dashboard'>Dashboard</a></li>";
        }

        ?>

        <?php
        // menu sair
        if (isset($_SESSION['usuario'])) {
            echo "<li><a href='/gestao_doadores/public/sair' class='btn-nav'>Sair</a></li>";
        } else {
            echo "<li><a href='/gestao_doadores/public/loginPublico' class='btn-nav'>Entrar</a></li>";
        }

        ?>


    </ul>
</nav>