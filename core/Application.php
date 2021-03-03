<?php
namespace Core;

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $responce;
    public static Application $app;
    public Controller $controller;
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->responce = new Response();
        $this->router = new Router($this->request, $this->responce);
    }
    public function run(){
        echo $this->router->resolve();
    }
    public function getController()
    {
        return $this->controller;
    }
    public function setController(\Core\Controller $controller)
    {
        $this->controller = $controller;
    }
}