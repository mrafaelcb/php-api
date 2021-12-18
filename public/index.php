<?php

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

use App\Application;

$app = new Application();

echo $app->init()
    ->run();