<?php

namespace app\core;

class Router{

    public Request $request;
    public Response $response;

    protected array $routes = [];

    public function __construct (Request $request, Response $response){
        $this->request = $request;
        $this->response = $response;
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
        //Application::$app;
        /*var_dump($path);
        var_dump($method);*/

        if($callback == false){
            //Application::$app->response->setStatusCode(404); es lo mismo q lo de abajo
            $this->response->setStatusCode(404)
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
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function layoutContent(){
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view){
        ob_start();
        $layoutContent = $this->layoutContent();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}