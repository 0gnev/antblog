<?php

use App\Controllers\SiteController;
use App\Controllers\AuthController;

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/about', [SiteController::class, 'about']);
$app->router->post('/contact', [SiteController::class, 'contact']);
$app->router->get('/article1', [SiteController::class, 'article1']);
$app->router->get('/article2', [SiteController::class, 'article2']);
$app->router->get('/article3', [SiteController::class, 'article3']);
$app->router->get('/change_password', [SiteController::class, 'changePassword']);
$app->router->post('/change_password', [SiteController::class, 'changePassword']);
$app->router->get('/change_email', [SiteController::class, 'changeEmail']);
$app->router->post('/change_email', [SiteController::class, 'changeEmail']);
$app->router->get('/reset', [SiteController::class, 'reset']);
$app->router->post('/reset', [SiteController::class, 'reset']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);
