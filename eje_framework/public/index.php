<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;

/var/www/systems/mentoria-web/eje_framework/public
/var/www/systems/mentoria-web/eje_framework
 /*  echo __DIR__;         /var/www/systems/mentoria-web/eje_framework/public */
echo "<br>";
/* echo dirname(__DIR__);  /var/www/systems/mentoria-web/eje_framework */

$app = new Application(dirname(__DIR__));

/*$app->router->get('/eje_framework/', 'home');*/
$app->router->get('/', 'home');

/*$app->router->get('/eje_framework/contact', 'contact');*/
$app->router->get('/contact', 'contact');

$app->run();