<?php

declare(strict_types=1);

Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'])->load();

$app = Slim\Factory\AppFactory::create();

$setupMiddleware = require __DIR__ . '/middleware.php';
$setupMiddleware($app);

$setupRoutes = require __DIR__ . '/routes.php';
$setupRoutes($app);

return $app;
