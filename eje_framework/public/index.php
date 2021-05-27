<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;

 /*  echo __DIR__;         /var/www/systems/mentoria-web/eje_framework/public */
/* echo dirname(__DIR__);  /var/www/systems/mentoria-web/eje_framework */

$app = new Application(dirname(__DIR__));

/*$app->router->get('/eje_framework/', 'home');*/
/*$app->router->get('/', 'home');
$app->router->get('/contact', 'contact'); //se visita por URL
$app->router->post('/contact', function(){ // se activa por formulario
    return "Procesando informacion";
});*/

$app->router->get('/', [\app\Controllers\SiteController::class, 'home']);
$app->router->get('/contact', [\app\Controllers\SiteController::class, 'contact']);
$app->router->post('/contact', [\app\Controllers\SiteController::class, 'handleContact']);

$app->run();