<?php

declare(strict_types=1);

$directoryFiles = scandir(__DIR__);

if ($directoryFiles == false) {
    return;
}

$directoryFiles = array_filter($directoryFiles, function ($file) {
    return $file != '.' && $file != '..' && $file != 'autoload.php';
});

foreach ($directoryFiles as $file) {
    require_once __DIR__ . '/' . $file;
}
