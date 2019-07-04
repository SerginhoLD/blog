<?php
error_reporting(E_ALL);

use Phalcon\DI;
use Phalcon\Mvc\Application;

try
{
    $config = require __DIR__ . '/../config/config.php';

    require_once $config->projectDir . '/config/loader.php';

    $di = new DI\FactoryDefault();
    require $config->projectDir . '/config/services.php';

    $application = new Application($di);
    $response = $application->handle();
    $response->send();
}
catch (\Exception $e)
{
    var_dump($e);
}
