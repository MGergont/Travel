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

//route
$router->get('/route', 'RouteController@routeView', 'Controllers');
$router->post('/route-castom-start', 'RouteController@startRoute', 'Controllers');
$router->post('/route-castom-next', 'RouteController@startNextRoute', 'Controllers');
$router->get('/route-castom-stop', 'RouteController@stopRoute', 'Controllers');
$router->get('/route-castom-end', 'RouteController@endRoute', 'Controllers');

$router->get('/route-cost', 'RouteController@endRoute', 'Controllers');

//notes
$router->get('/notes', 'NoteController@noteView', 'Controllers');
$router->post('/notes', 'NoteController@addNote', 'Controllers');
$router->post('/notes-del', 'NoteController@dellNote', 'Controllers');
$router->post('/notes-edit', 'NoteController@editNote', 'Controllers');

//vehicle
$router->get('/vehicle', 'VehicleController@vehicleView', 'Controllers');
$router->post('/vehicle', 'VehicleController@addVehicle', 'Controllers');
$router->post('/vehicle-edit', 'VehicleController@editVehicle', 'Controllers');
$router->post('/vehicle-del', 'VehicleController@dellVehicle', 'Controllers');
$router->post('/vehicle-costs', 'VehicleController@addCostVehicle', 'Controllers');
$router->post('/vehicle-serv', 'VehicleController@serviceVehicle', 'Controllers');

//Error
$router->get('/403', 'ErrorController@Error403', 'Controllers');
$router->get('/404', 'ErrorController@Error404', 'Controllers');

//logout
$router->get('/logout', 'LoginController@logout', 'Controllers');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($uri);