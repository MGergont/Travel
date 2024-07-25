<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

require_once 'app/utils/Feedback.php';

$router = new App\Utils\Router();

//Login
$router->get('/', 'LoginController@loginView', 'Controllers');
$router->post('/', 'LoginController@login', 'Controllers');

//register
$router->get('/register', 'RegistrationController@registrationView', 'Controllers');
$router->post('/register', 'RegistrationController@registration', 'Controllers');

//home
$router->get('/home', 'HomeController@homeView', 'Controllers');

//Error
$router->get('/403', 'ErrorController@Error403', 'Controllers');
$router->get('/404', 'ErrorController@Error404', 'Controllers');

//logout
$router->get('/logout', 'LoginController@logout', 'Controllers');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($uri);