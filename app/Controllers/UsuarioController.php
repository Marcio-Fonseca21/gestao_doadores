<?php

class UsuarioController
{
    public function listar()
    {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getUsuarios();

        require_once __DIR__ . '/../Views/Lista_usuarios.php';
    }
}
?>