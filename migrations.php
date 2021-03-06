<?php

require __DIR__ . '/vendor/autoload.php';

use Core\Application;
use App\Controllers\SiteController;
use App\Controllers\AuthController;

$app = new Application(__DIR__);



$app->db->applyMigrations();