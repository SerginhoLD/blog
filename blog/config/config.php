<?php
use Phalcon\Config;

return new Config([
    'blog' => [
        'projectDir' => realpath(__DIR__ . '/../..'),
    ],
]);
