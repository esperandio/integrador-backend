<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$setupMiddleware = require __DIR__ . '/middleware.php';
$setupMiddleware($app);

$setupRoutes = require __DIR__ . '/routes.php';
$setupRoutes($app);

return $app;
