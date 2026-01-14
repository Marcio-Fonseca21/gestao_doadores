<?php

class UsuarioController
{
    public function listar()
    {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getUsuarios();

        require_once __DIR__ . '/../Views/Lista_usuarios.php';//Seguir modelo de nome
    }

    public function getLoginPublico()
    {
        require_once __DIR__ . '/../Views/Dador/LoginDador.php';
        exit;
    }
    public function getCadastroPublico()
    {
        require_once __DIR__ . '/../Views/Dador/CadastroDador.php';
        exit;
    }


    public function registarDador()
    {
        $usuario = new Usuario();
        $usuario->setNome($_POST['nomeCompleto']);
        $usuario->setDataNascimento($_POST['dataNascimento']);
        $usuario->setSexo($_POST['sexo']);
        $usuario->setTipoDocumento($_POST['tipoDocumento']);
        $usuario->setNumeroDocumento($_POST['documento']);
        $usuario->setTelefone($_POST['telefone']);
        $usuario->setEmail($_POST['email']);
        $usuario->setSenha($_POST['senha']);

        $usuario->addUsuario();


    }
    public function loginDador(): void
    {

        $numeroDocumento = $_POST['numeroDocumento'];
        $senha = $_POST['senha'];

        $usuario = new Usuario();
        $usuarioBancoDados = $usuario->logarDador($numeroDocumento);

        if (!$usuarioBancoDados || !password_verify($senha, $usuarioBancoDados['senha'])) {
            Flash::set('login_erro', 'Email ou senha inválidos');
            header('Location: /gestao_doadores/public/loginPublico');
        } else {
            $_SESSION['usuario'] = [
                'id_usuario' => $usuarioBancoDados['id_usuario'],
                'nome' => $usuarioBancoDados['nome'],
                'tipoUsuario' => $usuarioBancoDados['tipoUsuario']
            ];
            Flash::set('login_sucesso', 'Login efectuado com sucesso');
            header('Location: /gestao_doadores/public');
        }
    }

    public function sair()
    {
        session_destroy();
        header('Location: /gestao_doadores/public');
        exit();
    }

    public function dashboardDador()
    {
        //Se o user não tiver sessão ou se tiver e não for dador
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipoUsuario'] !== TipoUsuario::DADOR) {
            header('Location: /gestao_doadores/public');
        }

        $idUsuario = $_SESSION['usuario']['id_usuario'];

        $usuario = new Usuario();
        $usuarioLogado = $usuario->getUsuarioCompleto($idUsuario);

        $campanhaModel = new Campanha();
        $campanhas = $campanhaModel->getCampanhasAtivas();

        require_once BASE_PATH . '/app/Views/Dador/DashboardDador.php';
        exit();
    }














    //Apagar

    public function atualizarPerfil()
    {
        header('Content-Type: application/json');

        // Captura o JSON enviado pelo JS
        $json = file_get_contents('php://input');
        $dadosEntrada = json_decode($json, true);

        if (!$dadosEntrada || !isset($_SESSION['usuario'])) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos ou sessão expirada']);
            exit;
        }

        $id_usuario = $_SESSION['usuario']['id_usuario'];
        $secao = $dadosEntrada['secao'];
        $valores = $dadosEntrada['dados'];

        // Aqui usamos o seu Model Usuario que já tem a conexão
        $db = new Database();
        $conn = $db->getConexao();

        try {
            if ($secao === 'pessoais') {
                $sql = "UPDATE usuario SET nome = :nome, sexo = :sexo, email = :email, dataNascimento = :dataNascimento, tipoDocumento = :tipoDocumento, numeroDocumento = :numeroDocumento, telefone = :telefone WHERE id_usuario = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':nome' => $valores['nome'],
                    ':sexo' => $valores['sexo'],
                    ':email' => $valores['email'],
                    ':dataNascimento' => $valores['dataNascimento'],
                    ':tipoDocumento' => $valores['tipoDocumento'],
                    ':numeroDocumento' => $valores['numeroDocumento'],
                    ':telefone' => $valores['telefone'],
                    ':id' => $id_usuario,
                ]);
           /* } else {
                $sql = "UPDATE dador SET nacionalidade = :nacionalidade, peso = :peso, tipoSanguineo = :tipoSanguineo WHERE usuarioId = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':nacionalidade' => $valores['nacionalidade'],
                    ':peso' => $valores['peso'],
                    ':tipoSanguineo' => $valores['tipoSanguineo'],
                    ':id' => $id_usuario
                ]);
            }*/  } else {
               $sql = "UPDATE dador SET 
               nacionalidade = :nacionalidade,
               indicadorPais = :indicadorPais,
               peso = :peso, 
               tipoSanguineo = :tipoSanguineo,
               altura = :altura,
               doencaCronica = :doenca,
               historicoTransfusao = :historicoTransfusao
               WHERE usuarioId = :id";

               $stmt = $conn->prepare($sql);
               $stmt->execute([
               ':nacionalidade' => $valores['nacionalidade'],
               ':indicadorPais' => $valores['indicadorPais'],
               ':peso' => $valores['peso'],
               ':tipoSanguineo' => $valores['tipoSanguineo'],
               ':altura' => $valores['altura'],
               ':doencaCronica' => $valores['doenca'],
               ':historicoTransfusao' => $valores['historicoTransfusao'],
               ':id' => $id_usuario
               ]);
           }

            echo json_encode(['status' => 'sucesso']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'erro', 'mensagem' => $e->getMessage()]);
        }
        exit;
    }
    public function alterarSenha()
    {
        header('Content-Type: application/json');
        $json = file_get_contents('php://input');
        $dados = json_decode($json, true);

        if (!isset($_SESSION['usuario'])) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Sessão expirada']);
            exit;
        }

        $id_usuario = $_SESSION['usuario']['id_usuario'];
        $senhaAtual = $dados['senhaAtual'];
        $novaSenha = $dados['novaSenha'];

        $usuarioModel = new Usuario();

        // 1. Buscar a senha atual (hash) no banco
        $db = new Database();
        $conn = $db->getConexao();
        $stmt = $conn->prepare("SELECT senha FROM usuario WHERE id_usuario = :id");
        $stmt->execute([':id' => $id_usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Verificar se a senha atual coincide
        if (!password_verify($senhaAtual, $user['senha'])) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'A senha atual está incorreta']);
            exit;
        }

        // 3. Gerar novo hash e salvar
        $novoHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE usuario SET senha = :senha WHERE id_usuario = :id");
        $sucesso = $update->execute([':senha' => $novoHash, ':id' => $id_usuario]);

        echo json_encode(['status' => $sucesso ? 'sucesso' : 'erro']);
        exit;
    }

}
?>