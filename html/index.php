<?php
use UltraLite\Container\Container;
use Slim\Factory\AppFactory;

$projectDir = dirname(__DIR__);

require_once $projectDir . '/vendor/autoload.php';

$di = new Container();
require_once $projectDir . '/config/services.php';

$app = AppFactory::create(null, $di);

require_once $projectDir . '/config/routes.php';

$app->run();

/*
// Add error middleware
$responseFactory = $app->getResponseFactory();
$errorMiddleware = new ErrorMiddleware($app->getCallableResolver(), $responseFactory, true, true, true);
$app->add($errorMiddleware);
*/
