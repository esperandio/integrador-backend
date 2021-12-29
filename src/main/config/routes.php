<?php

declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

$searchRoutesRecursively = function (App $app, string $path) use (&$searchRoutesRecursively) {
    $directoryFiles = scandir($path);

    if ($directoryFiles == false) {
        return;
    }

    $directoryFiles = array_filter($directoryFiles, function ($file) {
        return $file != '.' && $file != '..';
    });

    foreach ($directoryFiles as $file) {
        if (is_dir($path . $file)) {
            $searchRoutesRecursively($app, $path . $file . '/');
            continue;
        }

        if (!str_ends_with($file, '.php')) {
            continue;
        }

        $routeGroup = str_replace(__DIR__ . '/../routes/', '', $path);
        $routeGroup = substr($routeGroup, 0, -1);

        $routeGroup = !str_starts_with('/', $routeGroup) ? '/' . $routeGroup : $routeGroup;

        // Group example: /api/v1
        $app->group($routeGroup, function (RouteCollectorProxy $group) use ($path, $file) {
            $route = require_once $path . $file;
            $route($group);
        });
    }
};

return function (App $app) use ($searchRoutesRecursively) {
    $pathRoutesDirectory = __DIR__ . '/../routes/';
    $searchRoutesRecursively($app, $pathRoutesDirectory);
};
