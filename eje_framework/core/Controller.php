<?php

namespace app\core;

use PhpOffice\PhpSpreadsheet\Chart\Layout;

class Controller{
    public string $layout = 'main';

    public function render($view, $params = []){
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout){
        $this->layout = $layout;
    }
}