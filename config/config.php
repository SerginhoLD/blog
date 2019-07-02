<?php
use Phalcon\Config;

$projectDir = realpath(__DIR__ . '/..');

return new Config([
    'projectDir' => $projectDir,
    'db' => [
        'blog' => [
            'dbname' => $projectDir . '/blog.db3',
        ],
    ],
]);
