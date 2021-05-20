<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;

echo __DIR__;
echo "<br>";
echo dirname(__DIR__);

$app = new Application();

/*$app->router->get('/eje_framework/', 'home');*/
$app->router->get('/', 'home');

/*$app->router->get('/eje_framework/contact', 'contact');*/
$app->router->get('/contact', 'contact');

$app->run();