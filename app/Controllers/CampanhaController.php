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
}



?>