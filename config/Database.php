<?php
//require_once 'config.php';

class Database
{
    private $host = Config::DB_HOST;
    private $db_name = Config::DB_NAME;
    private $username = Config::DB_USER;
    private $password = Config::DB_PASS;
    public $conexao;

    public function getConnection()
    {
        $this->conexao = null;

        try {
            $this->conexao = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexao->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conexao;
    }
}