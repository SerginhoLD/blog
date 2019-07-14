<?php
use UltraLite\Container\Container;
use Slim\Factory\AppFactory;

$projectDir = dirname(__DIR__);

require_once $projectDir . '/vendor/autoload.php';

$di = new Container();
require_once $projectDir . '/config/services.php';

$app = AppFactory::create(null, $di);

require_once $projectDir . '/config/middleware.php';
require_once $projectDir . '/config/routes.php';

$app->run();
