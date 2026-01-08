<?php
// detalhes.php
// 1. Conectar ao banco e buscar a campanha específica
// Exemplo genérico (ajuste para sua lógica de conexão):
/*
$id = $_GET['id'];
$campanha = buscarCampanhaPorId($id); 
*/

?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $campanha['nome_campanha']; ?> - DoeVida</title>
    <link rel="stylesheet" href="<?= BASE_URL_PUBLIC ?>/css/HomeCss.css">
    <style>
        .detalhe-container {
            padding: 100px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .campanha-header {
            border-bottom: 2px solid #e74c3c;
            margin-bottom: 20px;
        }

        .data-info {
            color: #666;
            font-style: italic;
        }
    </style>
</head>

<body>

    <?php
    require BASE_PATH . '/app/Views/Template/Menu.php';
    ?>

    <div class="detalhe-container">
        <div class="campanha-header">
            <h1><?php echo $campanha['nome_campanha']; ?></h1>
            <p class="data-info">Publicado em: <?php echo date('d/m/Y', strtotime($campanha['data_inicio'])); ?></p>
        </div>

        <div class="campanha-corpo">
            <p><?php echo nl2br(htmlspecialchars($campanha['descricao'])); ?></p>
        </div>

        <div style="margin-top: 40px;">
            <p class="facaLogin">
                * É necessário estar logado para agendar sua doação.
            </p>
        </div>
    </div>

</body>

</html>