<?php

namespace app\controllers;

use app\core\Request;
use app\core\Controller;
use app\models\RegisterModel;

class AuthController extends Controller{
    public function login(){
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request){
        $this->setLayout('auth');

        if ($request->isPost()){
            $registerModel = new RegisterModel();

            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->save()){
                return 'Success';
            }
            var_dump($registerModel);
            return 'Procesando datos del Formulario..';
        } 
        return $this->render('register');
    }
}