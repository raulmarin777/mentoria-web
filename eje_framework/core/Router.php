<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;

    protected array $routes = [];    

    public function __construct(Request $request, Response $response)
    {
       $this->request = $request;
       $this->response = $response;
    }
    
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        /*echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';
        exit;*/

        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false){
            //Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
            //return $this->renderContent("Not Found");
            return $this->renderView("_404");            
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        
        /*array(2) { 
            [0]=> string(30) "app\controllers\SiteController" 
            [1]=> string(4) "home" 
        } */
        if (is_array($callback)) {
            $callback[0] = new $callback[0]();            
        }

        return call_user_func($callback);

    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);

        return str_replace('{{content}}', $viewContent, $layoutContent);

        //include_once Application::$ROOT_DIR . "/views/$view.php";
    }

    public function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}