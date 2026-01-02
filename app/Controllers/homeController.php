<?php

class HomeController
{

    public function index()
    {
        $campanhaController = new CampanhaController();
        $campanhas = $campanhaController->listarCampanhasActivas();

        
        require_once __DIR__ . '/../Views/Home.php';
    }
}



?>