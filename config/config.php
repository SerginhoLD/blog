<?php
use Phalcon\Config;

$projectDir = realpath(__DIR__ . '/..');

return new Config([
    'projectDir' => $projectDir,
    'database' => [
        'adapter' => 'Sqlite',
        'dbname' => $projectDir . '/blog.sqlite',
    ],
]);
