<?php

declare(strict_types=1);

namespace App\Utils;

class Router {
    protected array $routes = [];
    protected array $params = [];
    protected Request $request;

    public function __construct()
     {
         $this->request = new Request($_GET, $_POST, $_SERVER);
     }

    public function get(string $uri,string $callback,string $param): void {
        $this->routes['GET'][$uri] = $callback;
        $this->params['namespace'][$uri] = $param;
    }

    public function post(string $uri,string $callback,string $param): void {
        $this->routes['POST'][$uri] = $callback;
        $this->params['namespace'][$uri] = $param;
    }

    public function dispatch(string $uri): void {
        $method = $_SERVER['REQUEST_METHOD'];
        if (isset($this->routes[$method][$uri])) {
            $callback = $this->routes[$method][$uri];
            if (is_callable($callback)) {
                call_user_func($callback);
            } elseif (is_string($callback)) {
                $this->callController($callback, $uri);
            }
        } else {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/404', true, 303);
        }
    }

    protected function getNamespace(string $uri): string
    {
        $namespace = 'App\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'][$uri] . '\\';
        }

        return $namespace;
    }

    protected function callController(string $callback, string $uri): void {
        list($controller, $method) = explode('@', $callback);
        $controller = $this->getNamespace($uri) . "$controller";

        if (class_exists($controller) && method_exists($controller, $method)) {
            $controllerInstance = new $controller($this->request);
            $controllerInstance->$method();
        } else {
            echo "Controller or method not found";
        }
    }
}