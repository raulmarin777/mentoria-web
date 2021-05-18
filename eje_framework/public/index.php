<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;

$app = new Application();

$app->router->get('/eje_framework/', function(){
    return "Hola Raúl";
});

$app->router->get('/eje_framework/contact', function(){
    return "Contact";
});

$app->run();