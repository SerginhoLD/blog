<?php
use Phalcon\Config;

$projectDir = realpath(__DIR__ . '/..');

return new Config([
    'projectDir' => $projectDir,
    'cacheDir' => $projectDir . '/cache',
    'usersFile' => $projectDir . '/.phalcon/users.json',
    'authFile' => $projectDir . '/.phalcon/auth.json',
    'database' => [
        'adapter' => 'Sqlite',
        'dbname' => $projectDir . '/blog.sqlite',
    ],
]);
