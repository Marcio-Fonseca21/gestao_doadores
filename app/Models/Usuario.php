<?php
//require_once __DIR__ . '/../Config/Database.php';

class Usuario
{
    private $conexao;
    private $tabela_usuario = "usuario";
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;
    private $bi;
    private $sexo;
    private $data_nascimento;
    private $endereco;
    private $tipo_usuario;
    private $pais;
    private $provincia;
    private $bairro;
    private $tipo_documento;
    private $is_active;
    private $numero_documento;

    public function __construct()
    {
        $database = new Database();
        $this->conexao = $database->getConnection();
    }

    public function getUsuarios()
    {
        $query = "SELECT * FROM " . $this->tabela_usuario;
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>