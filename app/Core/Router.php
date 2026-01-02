<?php

class Router
{
    public static function load()
    {
        $controller = $_GET['c'] ?? 'home';
        $action     = $_GET['a'] ?? 'index';

        $controllerName = ucfirst($controller) . 'Controller';
        $controllerFile = __DIR__ . "/../Controllers/$controllerName.php";

        if (!file_exists($controllerFile)) {
            die("Controller '$controllerName' não encontrado");
        }

        //require_once $controllerFile;

        $obj = new $controllerName();

        if (!method_exists($obj, $action)) {
            die("Ação '$action' não encontrada no controller '$controllerName'");
        }

        $obj->$action();
        
    }
}