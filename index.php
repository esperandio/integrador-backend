<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/main/factories/autoload.php';
require __DIR__ . '/src/main/adapters/autoload.php';

use Slim\App;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * @var App $app
 */
$app = require __DIR__ . '/src/main/config/bootstrap.php';

$app->run();
