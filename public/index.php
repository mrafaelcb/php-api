<?php

require_once '../vendor/autoload.php';

use App\Application;

$app = new Application();

echo $app->init()
    ->run();