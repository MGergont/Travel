<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

if(!isset($_SESSION)){
    session_start();
}

$router = new App\Utils\Router();

//Login
$router->get('/', 'LoginController@loginView', 'Controllers');

//register
$router->get('/register', 'RegisterController@loginView', 'Controllers');

//Error
$router->get('/403', 'ErrorController@Error403', 'Controllers');
$router->get('/404', 'ErrorController@Error404', 'Controllers');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($uri);