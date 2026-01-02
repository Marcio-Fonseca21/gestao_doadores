<?php

class Campanha
{
    private $id_campanha;
    private $tabela_campanha = "campanha";
    private $hospital_id;
    private $nome_campanha;
    private $descricao;
    private $organizador;
    private $data_inicio;
    private $data_fim ;
    private $conexao;

    public function __construct()
    {
        $database = new Database();
        $this->conexao = $database->getConnection();
    }
    public function getCampanhasAtivas()
    {
       $query = "SELECT * FROM " . $this->tabela_campanha . " WHERE data_fim >= CURDATE() and is_active = 1 ";

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>