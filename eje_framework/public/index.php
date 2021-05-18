<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;

$app = new Application();

/*$app->router->get('/eje_framework/', 'home');*/
$app->router->get('/', 'home');

/*$app->router->get('/eje_framework/contact', 'contact');*/
$app->router->get('/', 'contact');

$app->run();