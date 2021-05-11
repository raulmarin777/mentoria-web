<?php

namespace app\core;

class Application{
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->request = new Router();
        $this->router = new Router($this->request);
    }

    public function run(){
        $this->router->resolve();
    }
}