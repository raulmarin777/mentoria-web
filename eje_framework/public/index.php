<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DSN'],
        'user' => $_ENV['USERNAME'],
        'password' => $_ENV['PASSWORD'],
    ]
];

 /*  echo __DIR__;         /var/www/systems/mentoria-web/eje_framework/public */
/* echo dirname(__DIR__);  /var/www/systems/mentoria-web/eje_framework */

var_dump($config);

$app = new Application(dirname(__DIR__), $config);

/*$app->router->get('/eje_framework/', 'home');*/
/*$app->router->get('/', 'home');
$app->router->get('/contact', 'contact'); //se visita por URL
$app->router->post('/contact', function(){ // se activa por formulario
    return "Procesando informacion";
});*/

$app->router->get('/', [\app\controllers\SiteController::class, 'home']);
$app->router->get('/contact', [\app\controllers\SiteController::class, 'contact']);
$app->router->post('/contact', [\app\controllers\siteController::class, 'handleContact']);

$app->router->get('/register', [\app\controllers\AuthController::class, 'register']);
$app->router->post('/register', [\app\controllers\AuthController::class, 'register']);

$app->router->get('/login', [\app\controllers\AuthController::class, 'login']);
$app->router->post('/login', [\app\controllers\AuthController::class, 'login']);

$app->run();