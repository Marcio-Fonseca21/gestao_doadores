<?php

class UsuarioController
{
    public function listar()
    {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getUsuarios();

        require_once __DIR__ . '/../Views/Lista_usuarios.php';
    }

     public function getLoginPublico(){
         
        require_once __DIR__ . '/../Views/Dador/LoginDador.php';
        exit;
    }
    public function getCadastroPublico(){
        require_once __DIR__ . '/../Views/Dador/CadastroDador.php';
        exit;
    }
    
    public function registarDador(){
        $name = $_POST['nome_completo'];
        $dataNascimento = $_POST['data_nascimento'];
        $sexo = $_POST['sexo'];
        $tipoDocumento = $_POST['tipoDocumento'];
        $numeroDocumento = $_POST['documento'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $password = $_POST['senha'];
        $confirmPassword = $_POST['confirma_senha'];

        die($name);
        

    }
}
?>