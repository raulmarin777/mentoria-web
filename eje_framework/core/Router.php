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
            echo "Not Found";
            exit;
        }
        /*print_r($this->routes);*/

        echo call_user_func($callback);
    }
}