<?php
use Phalcon\Config;

$projectDir = realpath(__DIR__ . '/..');

return new Config([
    'projectDir' => $projectDir,
    'cacheDir' => $projectDir . '/cache',
    'usersFile' => $projectDir . '/.phalcon/users.json',
    'database' => [
        'adapter' => 'Sqlite',
        'dbname' => $projectDir . '/blog.sqlite',
    ],
]);
