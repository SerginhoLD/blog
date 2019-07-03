<?php
use Phalcon\Config;

$projectDir = realpath(__DIR__ . '/..');

return new Config([
    'projectDir' => $projectDir,
    'cacheDir' => $projectDir . '/cache',
    'database' => [
        'adapter' => 'Sqlite',
        'dbname' => $projectDir . '/blog.sqlite',
    ],
]);
