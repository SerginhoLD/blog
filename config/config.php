<?php
/** @var string $projectDir */

return [
    'doctrine' => [
        'dev_mode' => true, // if true, metadata caching is forcefully disabled
        'metadata_paths' => [
            $projectDir . '/src/Entity',
        ],
        'proxy_dir' => $projectDir . '/src/Entity/Proxy',
        'connection' => [
            'driver' => 'pdo_sqlite',
            'path' => $projectDir . '/blog.sqlite',
        ],
    ],
];
