<?php

require __DIR__ . '/../vendor/autoload.php';

use Core\Application;
require_once '../Config/Config.php';
$app = new Application(dirname(__DIR__), $config);
require_once '../Config/Routes.php';
$app->run();