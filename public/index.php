<?php

require __DIR__ . '/../vendor/autoload.php';

use Core\Application;
use App\Controllers\SiteController;
use App\Controllers\AuthController;

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'userClass' => App\Models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/about', [SiteController::class, 'about']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);
$app->router->get('/article1', [SiteController::class, 'article1']);
$app->router->get('/article2', [SiteController::class, 'article2']);
$app->router->get('/article3', [SiteController::class, 'article3']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);


$app->run();