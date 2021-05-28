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

    public function post($path, $callback){
        $this->routes['post'][$path] = $callback;
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
            $this->response->setStatusCode(404);
            //return $this->renderContent("Not Found");
            return $this->renderView("_404");
        }
        /*print_r($this->routes);*/

        if (is_string($callback)){
            return $this->renderView($callback);
        }
        
        /*$callback = array(2) { 
            [0]=> string(30) "app\Controllers\SiteController" 
            [1]=> string(4) "home" }*/

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
            //esto transforma el string a objeto            
        }

        return call_user_func($callback, $this->request);
    }

    public function renderContent($viewContent){
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }    

    public function renderView($view, $params = []){
        //interpolacion
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function layoutContent(){
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, $params){
        foreach ($params as $key => $value){
            $$key = $value;
        }
        //deja en memoria cache
        ob_start();
        //$layoutContent = $this->layoutContent();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}