<?php
use Phalcon\Loader;

require_once $config->projectDir . '/vendor/autoload.php';

$loader = new Loader();
$loader->registerNamespaces([
    'Blog' => $config->projectDir . '/src',
])->register();
