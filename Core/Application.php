<?php
namespace Core;

use Core\db\Database;
use Core\db\DbModel;

class Application
{
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $responce;
    public Database $db;
    public Session $session;
    public static Application $app;
    public ?Controller $controller = null;
    public ?UserModel $user;
    public View $view;
    public Mailer $mail;
    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->responce = new Response();
        $this->session = new Session();
        $this->view = new View();
        $this->mail = new Mailer;
        $this->router = new Router($this->request, $this->responce);

        $this->db = new Database($config['db']);
        
    
        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
        
    }
    static public function isGuest()
    {
        return !self::$app->user;
    }
    public function run(){
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->responce->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }
    public function getController()
    {
        return $this->controller;
    }
    public function setController(\Core\Controller $controller): void
    {
        $this->controller = $controller;
    }
    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }
    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}