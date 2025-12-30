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



    }



}