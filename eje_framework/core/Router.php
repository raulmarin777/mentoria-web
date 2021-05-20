<?php

namespace app\core;

class Router{

    public Request $request;
    protected array $routes = [];

    public function __construct (\app\core\Request $request){
        $this->request = $request;
    }

    public function get($path, $callback){
        $this->routes['get'][$path] = $callback;
    }

    public function resolve(){
        /*echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';*/
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;
        /*var_dump($path);
        var_dump($method);*/

        if($callback == false){
            return "Not Found";
        }
        /*print_r($this->routes);*/

        if (is_string($callback)){
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    public function renderView($view){
        //interpolacion
        $layoutContent = $this->layoutContent();
        include_once Application::$ROOT_DIR . "/../views/$view.php";
    }

    public function layoutContent(){
        include_once Application::$ROOT_DIR . "/../views/layouts/main.php";
    }
}