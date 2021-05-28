<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller{

    public function home(){
        //return Application::$app->router->renderView('home');
        $params=[
            'name' => 'Raul',
            'surname' => 'Marin'
        ];
        return $this->render('home', $params);
    }

    public function contact(){
        //return Application::$app->router->renderView('contact');
        return $this->render('contact');
    }

    public function handleContact(){
        return "Procesando informacion";
    }
}
