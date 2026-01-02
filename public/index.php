<?php

spl_autoload_register(function ($class_name) {

    $dirs = [
        '../app/Models/',
        '../Config/',
        '../app/Controllers/',
        '../app/Core/'
    ];
    foreach ($dirs as $dir) {
        $file = __DIR__ . '/' . $dir . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

Router::run();

$homeController = new HomeController();
$homeController->index();
?>