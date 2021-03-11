<?php
namespace Core;

use App\Models\DbModel;

class Application
{
    public static string $ROOT_DIR;
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $responce;
    public Database $db;
    public Session $session;
    public static Application $app;
    public Controller $controller;
    public ?UserModel $user;
    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->responce = new Response();
        $this->session = new Session();
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
        echo $this->router->resolve();
    }
    public function getController()
    {
        return $this->controller;
    }
    public function setController(\Core\Controller $controller): void
    {
        $this->controller = $controller;
    }
    public function login(DbModel $user)
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