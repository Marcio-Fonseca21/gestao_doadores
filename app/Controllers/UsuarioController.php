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
        require_once BASE_PATH . '/app/Views/Dador/DashboardDador.php';
        exit();
    }
}
?>