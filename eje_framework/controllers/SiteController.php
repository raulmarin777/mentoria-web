<?php

namespace app\Controllers;

use app\core\Application;

class SiteController{

    public function home(){
        Application::$app->router->renderView('home');
    }

    public function contact(){
        Application::$app->router->renderView('contact');
    }

    public function handleContact(){
        return "Procesando informacion";
    }
}
