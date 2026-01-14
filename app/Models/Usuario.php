<?php
require_once BASE_PATH . '/app/Models/Enum/TipoUsuario.php';

class Usuario
{
    private $conexao;
    private $tabela_usuario = "usuario";
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;
    private $sexo;
    private $dataNascimento;
    private $endereco;
    private $tipo_usuario;
    private $pais;
    private $provincia;
    private $bairro;
    private $tipoDocumento;
    private $is_active;
    private $numeroDocumento;
    private $telefone;
    private $indicadorPais;


    public function __construct()
    {
        $database = new Database();
        $this->conexao = $database->getConexao();
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }

    public function setTipoUsuario($tipo_usuario)
    {
        $this->tipo_usuario = $tipo_usuario;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function getIsActive()
    {
        return $this->is_active;
    }

    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;
    }

    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getIndicadorPais()
    {
        return $this->indicadorPais;
    }

    public function setIndicadorPais($indicadorPais)
    {
        $this->indicadorPais = $indicadorPais;
    }

    public function getUsuarios()
    {
        $query = "SELECT * FROM " . $this->tabela_usuario;
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addUsuario()
    {
        $query = "INSERT INTO usuario (
            nome,
            dataNascimento,
            sexo,
            tipoDocumento,
            numeroDocumento,
            telefone,
            indicadorPais,
            email,
            senha,
            tipoUsuario
        ) VALUES (
            :nome,
            :dataNascimento,
            :sexo,
            :tipoDocumento,
            :numeroDocumento,
            :telefone,
            :indicadorPais,
            :email,
            :senha,
            :tipoUsuario
        )";

        $stmt = $this->conexao->prepare($query);

        // add usuário
        $stmt->execute([
            ':nome' => $this->nome,
            ':dataNascimento' => $this->dataNascimento,
            ':sexo' => $this->sexo,
            ':tipoDocumento' => $this->tipoDocumento,
            ':numeroDocumento' => $this->numeroDocumento,
            ':telefone' => $this->telefone,
            ':indicadorPais' => $this->indicadorPais,
            ':email' => $this->email,
            ':senha' => $this->senha,
            ':tipoUsuario' => TipoUsuario::DADOR
        ]);

        $id_usuario = $this->conexao->lastInsertId();

        //add doador com usuário já cadastrado

        $query = "INSERT INTO dador (usuarioId) VALUES (:usuarioId)";
        $stmt = $this->conexao->prepare($query);
        $doadorRegistado = $stmt->execute([
            ':usuarioId' => $id_usuario
        ]);

        return $doadorRegistado;
    }

    public function logarDador($numeroDocumento)
    {
        $query = "SELECT * from usuario
        Where numeroDocumento = :numeroDocumento";

        $stmt = $this->conexao->prepare($query);
        $stmt->execute([':numeroDocumento' => $numeroDocumento]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    //Analisar 
    // public function atualizarPerfilCompleto($id_usuario, $dados)
    // {
    //     try {
    //         $this->conexao->beginTransaction();

    //         // 1. Atualiza a tabela 'usuario' (Dados Pessoais)
    //         $sqlUser = "UPDATE usuario SET nome = :nome, sexo = :sexo, email = :email, dataNascimento = :dataNascimento, tipoDocumento = :tipoDocumento, numeroDocumento = :numeroDocumento, telefone = :telefone WHERE id_usuario = :id";
    //         $stmtUser = $this->conexao->prepare($sqlUser);
    //         $stmtUser->execute([
    //             ':nome' => $dados['nome'],
    //             ':sexo' => $dados['sexo'],
    //             ':email' => $dados['email'],
    //             ':dataNascimento' => $dados['dataNascimento'],
    //             ':tipoDocumento' => $dados['tipoDocumento'],
    //             ':numeroDocumento' => $dados['numeroDocumento'],
    //             ':telefone' => $dados['telefone'],
    //             ':id' => $id_usuario,

    //         ]);

    //         // 2. Atualiza a tabela 'dador' (Dados Complementares)
    //         $sqlDador = "UPDATE dador SET 
    //             nacionalidade = :nacionalidade,
    //             indicadorPais = :indicadorPais,
    //             peso = :peso,
    //             tipoSanguineo = :tipoSanguineo,
    //             altura = :altura,
    //             doencaCronica = :doenca,
    //             historicoTransfusao = :historicoTransfusao
    //             WHERE usuarioId = :id";

    //         $stmtDador = $this->conexao->prepare($sqlDador);

    //         $stmtDador->execute([
    //             ':nacionalidade' => $dados['nacionalidade'],
    //             ':indicadorPais' => $dados['indicadorPais'],
    //             ':peso' => $dados['peso'],
    //             ':tipoSanguineo' => $dados['tipoSanguineo'],
    //             ':altura' => $dados['altura'],
    //             ':doenca' => $dados['doenca'],
    //             ':historicoTransfusao' => $dados['historicoTransfusao'],
    //             ':id' => $id_usuario
    //         ]);


    //         $this->conexao->commit();
    //         return true;
    //     } catch (Exception $e) {
    //         $this->conexao->rollBack();
    //         return false;
    //     }
    // }

    public function getUsuarioCompleto($id)
    {
        $query = "SELECT u.*, d.* FROM usuario u 
              LEFT JOIN dador d ON u.id_usuario = d.usuarioId 
              WHERE u.id_usuario = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsuarioByNumeroDocumento($numeroDocumento)
    {
        $query = "SELECT * FROM usuario u 
              WHERE u.numeroDocumento = :numeroDocumento";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute([':numeroDocumento' => $numeroDocumento]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsuarioByEmail($email)
    {
        $query = "SELECT * FROM usuario u 
              WHERE u.email = :email";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}




?>