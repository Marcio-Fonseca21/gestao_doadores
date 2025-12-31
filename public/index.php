<?php
// public/index.php

spl_autoload_register(function ($class_name) {
    // Array de pastas onde suas classes podem estar
    $dirs = [
        '../app/Models/',
        '../Config/',
        '../app/Controllers/'
    ];

    foreach ($dirs as $dir) {
        $file = __DIR__ . '/' . $dir . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// if (class_exists('Config'))
//    echo 's';
// else 
//     echo 'n';

$controller = new UsuarioController();
$controller->listar();
?>