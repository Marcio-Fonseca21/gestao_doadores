<?php

class CampanhaController
{
    
    public function listarCampanhasActivas()
    {
        $campanhaModel = new Campanha();
        $campanhas = $campanhaModel->getCampanhasAtivas();

        require_once __DIR__ . '/../Views/Home.php';
        return $campanhas;
    }

    public function verDetalhes()
    {
        // 1. Pegamos o ID que vem da URL (ex: detalhes?id=5)
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id) {
            $campanhaModel = new Campanha();
            // Você precisará criar este método 'getCampanhaPorId' no seu Model
            $campanha = $campanhaModel->getCampanhaPorId($id);

            if ($campanha) {
                // 2. Carrega a página de detalhes passando os dados da campanha
                require_once __DIR__ . '/../Views/Dador/DetalheCampanha.php';
                exit;
            } else {
                echo "Campanha não encontrada.";
            }
        } else {
            echo "ID da campanha não fornecido.";
        }
    }

}

?>