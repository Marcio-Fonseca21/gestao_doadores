<?
require_once 'config.php';

class Database
{
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    public $conexao;

    public function getConnection()
    {
        $this->conexao = null;

        try {
            $this->conexao = new PDO(
                "mysql:host" . $this->host . ";dbname=" . $this->db_name,
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