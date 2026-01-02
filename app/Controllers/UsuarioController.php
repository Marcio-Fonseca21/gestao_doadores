<?php

class UsuarioController
{
    public function listar()
    {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getUsuarios();

        require_once __DIR__ . '/../Views/Lista_usuarios.php';
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
        $nome = $_POST['nomeCompleto'];
        $dataNascimento = $_POST['dataNascimento'];
        $sexo = $_POST['sexo'];
        $tipoDocumento = $_POST['tipoDocumento'];
        $numeroDocumento = $_POST['documento'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

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

        die('Dador registado com sucesso!');


    }
}
?>