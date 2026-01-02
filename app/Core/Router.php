<?php

class Router
{
    public static function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // remove /gestao_doadores/public
        $basePath = '/gestao_doadores/public';
        $route = str_replace($basePath, '', $uri);
        $route = trim($route, '/');

        switch ($route) {
            case '':
                self::call('HomeController', 'index');
                break;

            case 'loginPublico':
                self::call('UsuarioController', 'getLoginPublico');
                break;

            case 'cadastroPublico':
                self::call('UsuarioController', 'getCadastroPublico');
                break;

            default:
                http_response_code(404);
                echo 'Página não encontrada';
        }
    }

    private static function call($controller, $action)
    {
        require_once "../app/Controllers/$controller.php";

        $obj = new $controller();

        if (!method_exists($obj, $action)) {
            die('Ação não encontrada');
        }

        $obj->$action();
    }
}