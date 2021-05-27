<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller{

    public function home(){
        //return Application::$app->router->renderView('home');
        return $this->render('home');
    }

    public function contact(){
        //return Application::$app->router->renderView('contact');
        return $this->render('contact');
    }

    public function handleContact(){
        return "Procesando informacion";
    }
}
