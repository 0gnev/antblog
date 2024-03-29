<?php

require __DIR__ . '/vendor/autoload.php';

use Core\Application;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$config = [
    'userClass' => App\Models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(__DIR__, $config);



$app->db->applyMigrations();