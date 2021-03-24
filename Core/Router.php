<?php

namespace Core;

use Core\exception\NotFoundException;

class Router
{
    public Request $request;
    protected array $routes = [];
    public Response $responce;


    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->responce = $response;
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
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            throw new NotFoundException();
        }
        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }
        if (is_array($callback)) {
            /** 
             * @var \Core\Controller $controller 
             */
            $controller = new $callback[0];
            $controller->action = $callback[1];
            Application::$app->controller = $controller;
            $middlewares = $controller->getMiddlewares();

            foreach ($middlewares as $middleware)
            {
                $middleware->execute();
            }
            $callback[0] = $controller;
        }
        return call_user_func($callback, $this->request, $this->responce);
    }
}
