<?php
define('BASE_URL_PUBLIC', '/gestao_doadores/public');

// caminho físico (para require)
define('BASE_PATH', dirname(__DIR__));

spl_autoload_register(function ($class_name) {

    $dirs = [
        '../app/Models/',
        '../app/Models/Enum/',
        '../Config/',
        '../app/Controllers/',
        '../app/Core/',
        '../app/Helpers/'
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